<?php

namespace Pstryk82\LeagueBundle\EventEngine;

use Exception;
use Pstryk82\LeagueBundle\Event\AbstractEvent;

trait EventSourced
{
    /**
     * @var $events AbstractEvent[]
     */
    protected $events = [];
    /**
     * @return AbstractEvent[]
     */
    public function getEvents()
    {
        return $this->events;
    }
    /**
     * @param AbstractEvent $event
     */
    protected function recordThat(AbstractEvent $event)
    {
        $this->events[] = $event;
    }
    /**
     * @param AbstractEvent $event
     */
    private function apply(AbstractEvent $event)
    {
        $method = explode('\\', get_class($event));
        $method = 'apply' . end($method);
        $this->$method($event);
    }
    /**
     * @return string
     */
    abstract public function getAggregateId();

    public static function create()
    {
        throw new Exception('Method create was not implemented in class: '.self::class);
    }

    public static function reconstituteFrom()
    {
        throw new Exception('Method reconstituteFrom was not implemented in class: '.self::class);
    }
}
