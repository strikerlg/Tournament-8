<?php

namespace Pstryk82\LeagueBundle\DataFixtures\ORM;

use DateTime;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Pstryk82\LeagueBundle\Entity\StoredEvent;
use Pstryk82\LeagueBundle\Event\TeamWasCreated;
use Pstryk82\LeagueBundle\Generator\IdGenerator;

class TeamFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
                $teamData = [
            [
                'name' => 'Real Madrid CF',
                'rank' => 144428,
                'stadium' => 'Santiago Bernabeu',
            ],
            [
                'name' => 'FC Bayern Muenchen',
                'rank' => 134528,
                'stadium' => 'Allianz Arena',
            ],
            [
                'name' => 'FC Barcelona',
                'rank' => 129428,
                'stadium' => 'Camp Nou',
            ],
            [
                'name' => 'Club Atletico de Madrid',
                'rank' => 114428,
                'stadium' => 'Vicente Calderon',
            ],
            [
                'name' => 'Juventus',
                'rank' => 109199,
                'stadium' => 'Juventus Stadium',
            ],
            [
                'name' => 'Paris Saint-Germain',
                'rank' => 108066,
                'stadium' => 'Parc des Princes',
            ],
            [
                'name' => 'Borussia Dortmund',
                'rank' => 104528,
                'stadium' => 'Signal Iduna Park',
            ],
            [
                'name' => 'Chelsea FC',
                'rank' => 103763,
                'stadium' => 'Stamford Bridge',
            ],
        ];

        foreach ($teamData as $teamRecord) {
            $teamCreatedEvent = new TeamWasCreated(
            IdGenerator::generate(),
                $teamRecord['name'],
                $teamRecord['rank'],
                $teamRecord['stadium'],
                new DateTime()
            );
            
            $storedEvent = new StoredEvent();
            $storedEvent
                ->setId(IdGenerator::generate())
                ->setAggregateId($teamCreatedEvent->getTeamId())
                ->setAggregateClass(get_class($teamCreatedEvent))
                ->setEvent(serialize($teamCreatedEvent))
                ->setHappenedAt($teamCreatedEvent->getHappenedAt());
            
            $manager->persist($storedEvent);
        }
        $manager->flush();
    }
    
    public function getOrder()
    {
        return 2;
    }
}
