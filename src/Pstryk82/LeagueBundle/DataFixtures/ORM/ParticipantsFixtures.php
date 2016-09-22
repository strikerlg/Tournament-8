<?php

namespace Pstryk82\LeagueBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Pstryk82\LeagueBundle\Domain\Aggregate\History\LeagueHistory;
use Pstryk82\LeagueBundle\Domain\Aggregate\League;
use Pstryk82\LeagueBundle\Entity\StoredEvent;
use Pstryk82\LeagueBundle\Storage\EventStorage;

class ParticipantsFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $leagueId = '57df175c79222';
        $eventStorage = new EventStorage(
            $manager->getRepository(StoredEvent::class),
            $manager
        );
        $leagueHistory = new LeagueHistory($leagueId, $eventStorage);
        
        $league = League::reconstituteFrom($leagueHistory);
        
        var_dump($league);
        
//        $teamWasAdded = new TeamWasRegisteredAsParticipantInLeague(
//            // reconstiturte League and Team to get them here...
//        );
    }
    
    public function getOrder()
    {
        return 3;
    }
}
