<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Game;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class GamesFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @var array
     */
    private $games;

    public function load(ObjectManager $manager)
    {
        $league = $this->getReference('league-1');
        $gamesData = [
            [
                'homeTeam' => $this->getReference('participant-1'),
                'awayTeam' => $this->getReference('participant-8'),
                'competition' => $league,
            ],
            [
                'homeTeam' => $this->getReference('participant-2'),
                'awayTeam' => $this->getReference('participant-7'),
                'competition' => $league,
            ],
            [
                'homeTeam' => $this->getReference('participant-3'),
                'awayTeam' => $this->getReference('participant-6'),
                'competition' => $league,
            ],
            [
                'homeTeam' => $this->getReference('participant-4'),
                'awayTeam' => $this->getReference('participant-5'),
                'competition' => $league,
            ],
            [
                'homeTeam' => $this->getReference('participant-5'),
                'awayTeam' => $this->getReference('participant-1'),
                'competition' => $league,
            ],
            [
                'homeTeam' => $this->getReference('participant-6'),
                'awayTeam' => $this->getReference('participant-2'),
                'competition' => $league,
            ],
            [
                'homeTeam' => $this->getReference('participant-7'),
                'awayTeam' => $this->getReference('participant-3'),
                'competition' => $league,
            ],
            [
                'homeTeam' => $this->getReference('participant-8'),
                'awayTeam' => $this->getReference('participant-4'),
                'competition' => $league,
            ],
        ];

        $index = 0;
        foreach ($gamesData as $gameData) {
            $game = new Game();
            $game
                ->setHomeParticipant($gameData['homeTeam'])
                ->setAwayParticipant($gameData['awayTeam'])
                ->setCompetition($gameData['competition']);
            $this->addReference('game-'.++$index, $game);
            $this->games[] = $game;
            $manager->persist($game);
        }
        $manager->flush();
        $this->generateResults($manager);
    }

    private function generateResults(ObjectManager $manager)
    {
        foreach ($this->games as $game) {
            $homeScore = mt_rand(0, 3);
            $awayScore = mt_rand(0, 3);
            if ($homeScore > $awayScore) {
                $winner = $game->getHomeParticipant();
            } elseif ($homeScore < $awayScore) {
                $winner = $game->getAwayParticipant();
            } else {
                $winner = null;
            }

            $game
                ->setHomeTeamScore($homeScore)
                ->setAwayTeamScore($awayScore)
                ->setPlayed(true);
            if (!is_null($winner)) {
                $game->setWinner($winner);
            }
            $manager->merge($game);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 4;
    }
}
