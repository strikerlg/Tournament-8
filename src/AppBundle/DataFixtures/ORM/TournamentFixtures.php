<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\League;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class TournamentFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $tournament = new League();
        $tournament
            ->setPointsForWin(3)
            ->setPointsForDraw(1)
            ->setPointsForLose(0)
            ->setName("Top Clubs' League")
            ->setSeason('2016/2017')
            ->setRankPointsForWin(2)
            ->setRankPointsForDraw(1)
            ->setRankPointsForLose(0);
        
        $manager->persist($tournament);
        $this->addReference('league-1', $tournament);
        $manager->flush();
    }
    
    public function getOrder() {
        return 2;
    }
}
