<?php

namespace Pstryk82\LeagueBundle\Domain\Aggregate;

use Pstryk82\LeagueBundle\Domain\Exception\GameLogicException;
use Pstryk82\LeagueBundle\Domain\Logic\GameOutcomeResolver;
use Pstryk82\LeagueBundle\Event\GameWasPlanned;
use Pstryk82\LeagueBundle\Event\GameWasPlayed;
use Pstryk82\LeagueBundle\Event\ParticipantHasWon;
use Pstryk82\LeagueBundle\EventEngine\EventSourced;
use Pstryk82\LeagueBundle\Generator\IdGenerator;

class Game implements AggregateInterface
{
    use EventSourced;

    /**
     * @var string
     */
    private $aggregateId;

    /**
     * @var bool
     */
    private $played = false;

    /**
     * @var AbstractParticipant
     */
    private $homeParticipant;

    /**
     * @var AbstractParticipant
     */
    private $awayParticipant;

    /**
     * @var int
     */
    private $homeScore;

    /**
     * @var int
     */
    private $awayScore;

    /**
     * @var AbstractParticipant
     */
    private $winner;

    /**
     * @var Competition
     */
    private $competition;

    /**
     * @var bool
     */
    private $onNeutralGround = false;

    /**
     * @var \DateTime
     */
    private $beginningTime;

    /**
     * @param string $aggregateId
     */
    public function __construct($aggregateId)
    {
        $this->aggregateId = $aggregateId;
    }

    /**
     *
     * @param AbstractParticipant $homeParticipant
     * @param AbstractParticipant $awayParticipant
     * @param Competition $competition
     * @param \DateTime $beginningTime
     * @param bool $onNeutralGround
     *
     * @return $this
     *
     * @throws GameLogicException
     */
    public static function create(
        AbstractParticipant $homeParticipant,
        AbstractParticipant $awayParticipant,
        Competition $competition,
        \DateTime $beginningTime,
        $onNeutralGround = false
    )
    {
        if ($homeParticipant->getAggregateId() == $awayParticipant->getAggregateId()) {
            throw new GameLogicException(
                'A team cannot play against itself: aggregateId = ' . $homeParticipant->getAggregateId()
            );
        }
        $game = new self($aggregateId = IdGenerator::generate());
        $game
            ->setHomeParticipant($homeParticipant)
            ->setAwayParticipant($awayParticipant)
            ->setCompetition($competition)
            ->setBeginningTime($beginningTime)
            ->setOnNeutralGround($onNeutralGround);

        $gameWasPlannedEvent = new GameWasPlanned(
            $aggregateId,
            $homeParticipant,
            $awayParticipant,
            $competition,
            $beginningTime,
            new \DateTime(),
            $onNeutralGround
        );

        $game->recordThat($gameWasPlannedEvent);

        return $game;
    }

    private function applyGameWasPlanned(GameWasPlanned $event)
    {
        $this
            ->setHomeParticipant($event->getHomeParticipant())
            ->setAwayParticipant($event->getAwayParticipant())
            ->setCompetition($event->getCompetition())
            ->setBeginningTime($event->getBeginningTime())
            ->setOnNeutralGround($event->getOnNeutralGround())
        ;
    }


    public function recordResult($homeScore, $awayScore)
    {

        $gameWasPlayedEvent = new GameWasPlayed($this->aggregateId, $homeScore, $awayScore, new \DateTime());
        $this->recordThat($gameWasPlayedEvent);
        $this->apply($gameWasPlayedEvent);

        $gameOutcomeResolver = new GameOutcomeResolver();
        $gameOutcomeResolver->determine($this);
        if ($gameOutcomeResolver->isDraw()) {
//            $participantHasDrawnEvent = new ParticipantHasDrawn();
//            $participantHasDrawnEvent = new ParticipantHasDrawn();
        } else {
            $winner = $gameOutcomeResolver->getWinner();
            $winner->recordPointsForWin($this, $gameOutcomeResolver);

//            $participantHasLostEvent = new ParticipantHasLost()
        }
    }

    private function applyGameWasPlayed(GameWasPlayed $event)
    {
        $this
            ->setHomeScore($event->getHomeScore())
            ->setAwayScore($event->getAwayScore())
            ->setPlayed($event->getPlayed());
    }
    
    public function getAggregateId()
    {
        return $this->aggregateId;
    }

    /**
     * Set played.
     *
     * @param bool $played
     *
     * @return Game
     */
    public function setPlayed($played)
    {
        $this->played = $played;

        return $this;
    }

    /**
     * Get played.
     *
     * @return bool
     */
    public function getPlayed()
    {
        return $this->played;
    }

    /**
     * Set homeTeam.
     *
     * @param AbstractParticipant $homeParticipant
     *
     * @return Game
     */
    public function setHomeParticipant(AbstractParticipant $homeParticipant)
    {
        $this->homeParticipant = $homeParticipant;

        return $this;
    }

    /**
     * Get homeTeam.
     *
     * @return AbstractParticipant
     */
    public function getHomeParticipant()
    {
        return $this->homeParticipant;
    }

    /**
     * Set awayTeam.
     *
     * @param AbstractParticipant $awayParticipant
     *
     * @return Game
     */
    public function setAwayParticipant(AbstractParticipant $awayParticipant)
    {
        $this->awayParticipant = $awayParticipant;

        return $this;
    }

    /**
     * Get awayTeam.
     *
     * @return AbstractParticipant
     */
    public function getAwayParticipant()
    {
        return $this->awayParticipant;
    }

    /**
     * Set homeTeamScore.
     *
     * @param int $homeScore
     *
     * @return Game
     */
    public function setHomeScore($homeScore)
    {
        $this->homeScore = $homeScore;

        return $this;
    }

    /**
     * Get homeTeamScore.
     *
     * @return int
     */
    public function getHomeScore()
    {
        return $this->homeScore;
    }

    /**
     * Set awayTeamScore.
     *
     * @param int $awayScore
     *
     * @return Game
     */
    public function setAwayScore($awayScore)
    {
        $this->awayScore = $awayScore;

        return $this;
    }

    /**
     * Get awayTeamScore.
     *
     * @return int
     */
    public function getAwayScore()
    {
        return $this->awayScore;
    }

    /**
     * Set winner.
     *
     * @param AbstractParticipant $winner
     *
     * @return Game
     */
    public function setWinner(AbstractParticipant $winner)
    {
        $this->winner = $winner;

        return $this;
    }

    /**
     * Get winner.
     *
     * @return string
     */
    public function getWinner()
    {
        return $this->winner;
    }

    /**
     * Set competition.
     *
     * @param Competition $competition
     *
     * @return Game
     */
    public function setCompetition(Competition $competition)
    {
        $this->competition = $competition;

        return $this;
    }

    /**
     * Get competition.
     *
     * @return Competition
     */
    public function getCompetition()
    {
        return $this->competition;
    }

    /**
     * Set onNeutralGround.
     *
     * @param bool $onNeutralGround
     *
     * @return Game
     */
    public function setOnNeutralGround($onNeutralGround)
    {
        $this->onNeutralGround = $onNeutralGround;

        return $this;
    }

    /**
     * Get onNeutralGround.
     *
     * @return bool
     */
    public function getOnNeutralGround()
    {
        return $this->onNeutralGround;
    }

    /**
     * Set beginningTime.
     *
     * @param \DateTime $beginningTime
     *
     * @return Game
     */
    public function setBeginningTime($beginningTime)
    {
        $this->beginningTime = $beginningTime;

        return $this;
    }

    /**
     * Get beginningTime.
     *
     * @return \DateTime
     */
    public function getBeginningTime()
    {
        return $this->beginningTime;
    }
}
