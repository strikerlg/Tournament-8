<?php

namespace Pstryk82\LeagueBundle\Domain\Aggregate;

use Doctrine\Common\Collections\ArrayCollection;
use Pstryk82\LeagueBundle\Event\TeamWasCreated;
use Pstryk82\LeagueBundle\EventEngine\EventSourced;
use Pstryk82\LeagueBundle\Generator\IdGenerator;

class Team implements AggregateInterface
{
    use EventSourced;

    /**
     * @var int
     */
    private $aggregateId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $rank;

    /**
     * @var string
     */
    private $stadium;

    public function __construct($aggregateId)
    {
        $this->aggregateId = $aggregateId;
    }

    public function getAggregateId()
    {
        return $this->aggregateId;
    }

    /**
     *
     * @param type $name
     * @param type $rank
     * @param type $stadium
     * 
     * @return $this
     */
    public static function create($name, $rank, $stadium)
    {
        $team = new self($aggregateId = IdGenerator::generate());
        $team
            ->setName($name)
            ->setRank($rank)
            ->setStadium($stadium);

        $teamWasCreatedEvent = new TeamWasCreated(
            $aggregateId, $name, $rank, $stadium, new \DateTime()
        );

        $team->recordThat($teamWasCreatedEvent);

        return $team;
    }

    private function applyTeamWasCreated(TeamWasCreated $event)
    {
        $this
            ->setName($event->getName())
            ->setRank($event->getRank())
            ->setStadium($event->getStadium());
    }

    /**
     * @param Competition $league
     *
     * @return AbstractParticipant
     */
    public function registerInLeague($league)
    {
        $participantId = IdGenerator::generate();
        $participant = LeagueParticipant::create($participantId, $league->getAggregateId());

        return $participant;
    }

    public function setName($name)
    {
        $this->name = $name;
        
        return $this;
    }

    public function setRank($rank)
    {
        $this->rank = $rank;

        return $this;
    }

    public function setStadium($stadium)
    {
        $this->stadium = $stadium;

        return $this;
    }
}
