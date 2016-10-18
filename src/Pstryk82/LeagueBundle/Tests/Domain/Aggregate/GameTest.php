<?php

namespace Pstryk82\LeagueBundle\Tests\Domain\Aggregate;

use Pstryk82\LeagueBundle\Domain\Aggregate\Competition;
use Pstryk82\LeagueBundle\Domain\Aggregate\Game;
use Pstryk82\LeagueBundle\Domain\Aggregate\LeagueParticipant;
use Pstryk82\LeagueBundle\Domain\Exception\GameLogicException;
use Pstryk82\LeagueBundle\Event\GameWasPlayed;

class GameTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Game
     */
    private $game;

    /**
     * @var LeagueParticipant
     */
    private $homeParticipant;

    /**
     * @var LeagueParticipant
     */
    private $awayParticipant;

    public function setUp()
    {
        $this->homeParticipant =
            $this->getMockBuilder(LeagueParticipant::class)->disableOriginalConstructor()->getMock();
        $this->homeParticipant->method('getAggregateId')->willReturn('home participant id');
        $this->awayParticipant =
            $this->getMockBuilder(LeagueParticipant::class)->disableOriginalConstructor()->getMock();
        $this->awayParticipant->method('getAggregateId')->willReturn('away participant id');
        $this->game = new Game('gameId');
        $this->game
            ->setHomeParticipant($this->homeParticipant)
            ->setAwayParticipant($this->awayParticipant);
    }

    public function tearDown()
    {
        unset($this->game);
    }

    public function testCreate()
    {
        $competition = $this->getMockBuilder(Competition::class)->disableOriginalConstructor()->getMock();
        $now = new \DateTIme();
        $game = Game::create($this->homeParticipant, $this->awayParticipant, $competition, $now);

        $this->assertEquals($this->homeParticipant, $game->getHomeParticipant());
        $this->assertEquals($this->awayParticipant, $game->getAwayParticipant());
        $this->assertEquals($competition, $game->getCompetition());
        $this->assertEquals($now, $game->getBeginningTime());
        $this->assertFalse($game->getOnNeutralGround());
    }

    public function testCreateShouldFail()
    {
        $competition = $this->getMockBuilder(Competition::class)->disableOriginalConstructor()->getMock();
        $now = new \DateTIme();

        $this->setExpectedException(GameLogicException::class);
        Game::create($this->homeParticipant, $this->homeParticipant, $competition, $now);
    }

    public function testRecordResultDraw()
    {
        $this->homeParticipant->expects($this->once())->method('recordPointsForDraw');
        $this->awayParticipant->expects($this->once())->method('recordPointsForDraw');
        $this->game->recordResult(1, 1);

        $this->assertEquals(1, $this->game->getHomeScore());
        $this->assertEquals(1, $this->game->getAwayScore());
        $this->assertTrue($this->game->getPlayed());
        $events = $this->game->getEvents();
        $this->assertInstanceOf(GameWasPlayed::class, reset($events));
        $this->assertEquals($this->game->getAggregateId(), reset($events)->getAggregateId());
    }

    public function testRecordResultNotDraw()
    {
        $this->homeParticipant->expects($this->once())->method('recordPointsForWin');
        $this->awayParticipant->expects($this->once())->method('recordPointsForLose');
        $this->game->recordResult(2, 0);

        $this->assertEquals(2, $this->game->getHomeScore());
        $this->assertEquals(0, $this->game->getAwayScore());
        $this->assertTrue($this->game->getPlayed());
        $events = $this->game->getEvents();
        $this->assertInstanceOf(GameWasPlayed::class, reset($events));
        $this->assertEquals('gameId', reset($events)->getAggregateId());
    }

}
