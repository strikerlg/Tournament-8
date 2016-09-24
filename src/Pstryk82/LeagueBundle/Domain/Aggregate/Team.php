<?php

namespace Pstryk82\LeagueBundle\Domain\Aggregate;

use Doctrine\Common\Collections\ArrayCollection;
use Pstryk82\LeagueBundle\Event\TeamWasCreated;
use Pstryk82\LeagueBundle\EventEngine\EventSourced;

class Team implements AggregateInterface
{
    use EventSourced;

    /**
     * @var int
     */
    private $aggregateId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $rank;

    /**
     * @var string
     */
    private $stadium;

    /**
     * @var ArrayCollection
     */
    private $participants;

    public function __construct($aggregateId)
    {
        $this->aggregateId = $aggregateId;
    }

    public function getAggregateId()
    {
        return $this->aggregateId;
    }

    public function create($name, $rank, $stadium)
    {
        $teamWasCreatedEvent = new TeamWasCreated(
            $this->aggregateId, $name, $rank, $stadium, new \DateTime()
        );

        $this->recordThat($teamWasCreatedEvent);
        $this->apply($teamWasCreatedEvent);
    }

    private function applyTeamWasCreated(TeamWasCreated $event)
    {
        $this
            ->setName($event->getName())
            ->setRank($event->getRank())
            ->setStadium($event->getStadium());
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function setRank($rank)
    {
        $this->rank = $rank;
        return $this;
    }

    public function setStadium($stadium)
    {
        $this->stadium = $stadium;
        return $this;
    }

    public function setParticipants(ArrayCollection $participants)
    {
        $this->participants = $participants;
        return $this;
    }


}
