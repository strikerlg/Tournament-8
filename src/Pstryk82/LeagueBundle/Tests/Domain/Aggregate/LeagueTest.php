<?php

namespace Pstryk82\LeagueBundle\Tests\Domain\Aggregate;

use Pstryk82\LeagueBundle\Domain\Aggregate\League;
use Pstryk82\LeagueBundle\Event\LeagueWasCreated;
use Pstryk82\LeagueBundle\Event\LeagueWasFinished;

class LeagueTest extends AbstractDomainObjectTest
{
    private $league;

    public function setUp()
    {
        $this->league = new League('league name');
    }

    public function tearDown()
    {
        unset($this->league);
    }

    public function testCreate()
    {
        $this->league = League::create(
            'name', '2016', 7, 3, -1, 3, 1, 0, 4
        );

        $this->assertEventOnDomainObjectWasCreated($this->league, LeagueWasCreated::class);
    }

    public function testFinish()
    {
        $this->league->finish();

        $this->assertEventOnDomainObjectWasCreated($this->league, LeagueWasFinished::class);
    }
}
