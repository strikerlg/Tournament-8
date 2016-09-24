<?php

namespace Pstryk82\LeagueBundle\EventEngine;

class EventBus
{
    /**
     * @var $listeners AbstractEventListener[]
     */
    private $listeners = [];

    public function registerListener(AbstractEventListener $domainEventListener)
    {
        $this->listeners[] = $domainEventListener;
    }
    /**
     * @param $events AbstractEvent[]
     */
    public function dispatch(array $events)
    {
        /** @var AbstractEvent $event */
        foreach ($events as $event) {
            /** @var AbstractEventListener $listener */
            foreach ($this->listeners as $listener) {
                $listener->when($event);
            }
        }
    }
}
