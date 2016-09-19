<?php

namespace Pstryk82\LeagueBundle\DataFixtures\ORM;

use DateTime;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Pstryk82\LeagueBundle\Entity\StoredEvent;
use Pstryk82\LeagueBundle\Event\LeagueWasCreated;
use Pstryk82\LeagueBundle\Generator\IdGenerator;

class LeagueFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
//        $leagueId = IdGenerator::generate();
        $leagueId = '57df175c79222';
        $leagueCreatedEvent = new LeagueWasCreated(
            $leagueId,
            "Top Clubs' League",
            '2016/2017',
            5,
            2,
            0,
            3,
            1,
            0,
            2,
            new DateTime()
        );
        
        $storedEvent = new StoredEvent();
        $storedEvent
            ->setId(IdGenerator::generate())
            ->setAggregateId($leagueCreatedEvent->getLeagueId())
            ->setAggregateClass(get_class($leagueCreatedEvent))
            ->setEvent(serialize($leagueCreatedEvent))
            ->setHappenedAt($leagueCreatedEvent->getHappenedAt());
        $manager->persist($storedEvent);
        $manager->flush();
    }
    
    public function getOrder()
    {
        return 1;
    }
}
