<?php

namespace Pstryk82\LeagueBundle\Storage;

use Doctrine\ORM\EntityManager;
use Pstryk82\LeagueBundle\Entity\StoredEvent;
use Pstryk82\LeagueBundle\Event\AbstractEvent;
use Pstryk82\LeagueBundle\Generator\IdGenerator;
use Pstryk82\LeagueBundle\Repository\StoredEventRepository;

class EventStorage
{
    /**
     * @var StoredEventRepository 
     */
    private $repository;

    /**
     * @var EntityManager
     */
    private $entityManager;
    
    public function __construct(StoredEventRepository $repository, EntityManager $entityManager)
    {
        $this->repository = $repository;
        $this->entityManager = $entityManager;
    }

    /**
     * @param string $aggregateId
     * 
     * @return AbstractEvent[]
     */
    public function find($aggregateId)
    {
        $storedEvents = $this->repository->findBy(
            ['aggregateId' => $aggregateId]
        );
        
        $events = [];
        /* @var $storedEvent StoredEvent */
        foreach ($storedEvents as $storedEvent) {
            $event = $storedEvent->getEvent();
            $events[] = $event;
        }
        
        return $events;
    }

    public function add(AbstractEvent $event, $aggregateClass)
    {
        $storedEvent = new StoredEvent();
        $storedEvent
            ->setAggregateId($event->getLeagueId())
            ->setAggregateClass($aggregateClass)
            ->setEvent($event)
            ->setHappenedAt($event->getHappenedAt());
        $this->entityManager->persist($storedEvent);
        $this->entityManager->flush();
    }
}
