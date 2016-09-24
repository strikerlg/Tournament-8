<?php

namespace Pstryk82\LeagueBundle\Command;

use Pstryk82\LeagueBundle\Domain\Aggregate\History\LeagueHistory;
use Pstryk82\LeagueBundle\Domain\Aggregate\History\TeamHistory;
use Pstryk82\LeagueBundle\Domain\Aggregate\League;
use Pstryk82\LeagueBundle\Domain\Aggregate\Team;
use Pstryk82\LeagueBundle\EventEngine\EventBus;
use Pstryk82\LeagueBundle\Generator\IdGenerator;
use Pstryk82\LeagueBundle\Storage\EventStorage;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class LoadFixturesCommand extends ContainerAwareCommand
{
    /**
     * @var EventStorage
     */
    private $eventStorage;

    /**
     * @var EventBus
     */
    private $eventBus;

    protected function configure()
    {
        $this
            ->setName('league:fixtures:load')
            ->setDescription('Load defined fixtures for league');

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->eventStorage = $this->getContainer()->get('pstryk82.league.event_storage');
        $this->eventBus = $this->getContainer()->get('pstryk82.league.event_bus');

        $this->executeLeagueFixtures();
        $this->executeTeamsFixtures();
        $this->executeParticipantsFixtures();

        $output->writeln(
            sprintf(
                'Fixtures have been loaded.'
            )
        );
    }

    private function executeLeagueFixtures()
    {
        $leagueId = '57df175c79222';

        $leagueHistory = new LeagueHistory($leagueId, $this->eventStorage);
        $league = League::reconstituteFrom($leagueHistory);

        $league->create(
            "Top Clubs' League",
            '2016/2017',
            5,
            2,
            0,
            3,
            1,
            0,
            2
        );

        
        $this->eventBus->dispatch($league->getEvents());
        $this->eventStorage->add($league);
    }


    public function executeTeamsFixtures()
    {
            $teamData = [
            [
                'id' => '57e6f4c610796',
                'name' => 'Real Madrid CF',
                'rank' => 144428,
                'stadium' => 'Santiago Bernabeu',
            ],
            [
                'id' => '57e6f4c6107d7',
                'name' => 'FC Bayern Muenchen',
                'rank' => 134528,
                'stadium' => 'Allianz Arena',
            ],
            [
                'id' => '57e6f4c610813',
                'name' => 'FC Barcelona',
                'rank' => 129428,
                'stadium' => 'Camp Nou',
            ],
            [
                'id' => '57e6f4c61084e',
                'name' => 'Club Atletico de Madrid',
                'rank' => 114428,
                'stadium' => 'Vicente Calderon',
            ],
            [
                'id' => '57e6f4c610889',
                'name' => 'Juventus',
                'rank' => 109199,
                'stadium' => 'Juventus Stadium',
            ],
            [
                'id' => '57e6f4c6108c5',
                'name' => 'Paris Saint-Germain',
                'rank' => 108066,
                'stadium' => 'Parc des Princes',
            ],
            [
                'id' => '57e6f4c610901',
                'name' => 'Borussia Dortmund',
                'rank' => 104528,
                'stadium' => 'Signal Iduna Park',
            ],
            [
                'id' => '57e6f4c61093d',
                'name' => 'Chelsea FC',
                'rank' => 103763,
                'stadium' => 'Stamford Bridge',
            ],
        ];

        foreach ($teamData as $teamRecord) {
            $teamHistory = new TeamHistory($teamRecord['id'], $this->eventStorage);
            /** @var Team $team */
            $team = Team::reconstituteFrom($teamHistory);

            $team->create(
                $teamRecord['name'],
                $teamRecord['rank'],
                $teamRecord['stadium']
            );
            
            $this->eventBus->dispatch($team->getEvents());
            $this->eventStorage->add($team);
        }
    }

    private function executeParticipantsFixtures()
    {

    }


}
