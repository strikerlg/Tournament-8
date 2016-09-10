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
                'homeTeam' => $this->getReference('team-1'),
                'awayTeam' => $this->getReference('team-8'),
                'competition' => $league,
            ],
            [
                'homeTeam' => $this->getReference('team-2'),
                'awayTeam' => $this->getReference('team-7'),
                'competition' => $league,
            ],
            [
                'homeTeam' => $this->getReference('team-3'),
                'awayTeam' => $this->getReference('team-6'),
                'competition' => $league,
            ],
            [
                'homeTeam' => $this->getReference('team-4'),
                'awayTeam' => $this->getReference('team-5'),
                'competition' => $league,
            ],
            [
                'homeTeam' => $this->getReference('team-5'),
                'awayTeam' => $this->getReference('team-1'),
                'competition' => $league,
            ],
            [
                'homeTeam' => $this->getReference('team-6'),
                'awayTeam' => $this->getReference('team-2'),
                'competition' => $league,
            ],
            [
                'homeTeam' => $this->getReference('team-7'),
                'awayTeam' => $this->getReference('team-3'),
                'competition' => $league,
            ],
            [
                'homeTeam' => $this->getReference('team-8'),
                'awayTeam' => $this->getReference('team-4'),
                'competition' => $league,
            ],
        ];

        $index = 0;
        foreach ($gamesData as $gameData) {
            $game = new Game();
            $game
                ->setHomeTeam($gameData['homeTeam'])
                ->setAwayTeam($gameData['awayTeam'])
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
                $winner = Game::WINNER_HOME;
            } elseif ($homeScore < $awayScore) {
                $winner = Game::WINNER_AWAY;
            } else {
                $winner = Game::WINNER_DRAW;
            }

            $game
                ->setHomeTeamScore($homeScore)
                ->setAwayTeamScore($awayScore)
                ->setPlayed(true)
                ->setWinner($winner);
            $manager->merge($game);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 4;
    }
}
