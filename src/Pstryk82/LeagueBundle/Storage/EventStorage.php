<?php

namespace Pstryk82\LeagueBundle\Storage;

use Pstryk82\LeagueBundle\Entity\StoredEvent;
use Pstryk82\LeagueBundle\Repository\StoredEventRepository;

class EventStorage
{
    /**
     * @var StoredEventRepository 
     */
    private $repository;
    
    public function __construct(StoredEventRepository $repository)
    {
        $this->repository = $repository;
    }

    public function find($aggregateId)
    {
        $storedEvents = $this->repository->findBy(
            ['aggregateId' => $aggregateId]
        );
        
        $events = [];
        /* @var $storedEvent StoredEvent */
        foreach ($storedEvents as $storedEvent) {
            $event = unserialize($storedEvent->getEvent());
            $events[] = $event;
        }
        
        return $events;
    }
}
