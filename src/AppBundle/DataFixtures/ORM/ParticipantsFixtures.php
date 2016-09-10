<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\League\Participant;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ParticipantsFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $league = $this->getReference('league-1');
        $repo = $manager->getRepository('AppBundle:Team');
        $numberOfTeams = sizeof($repo->findAll());
        for ($i = 1; $i <= $numberOfTeams; $i++) {
            $participant = new Participant();
            $participant
                ->setTeam($this->getReference('team-'.$i))
                ->setCompetition($league)
            ;
            $manager->persist($participant);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }
}
