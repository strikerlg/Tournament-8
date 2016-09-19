<?php

namespace Pstryk82\LeagueBundle\Event;

abstract class AbstractEvent
{
    /**
     * @var \DateTime
     */
    protected $happenedAt;

    /**
     * @return \DateTime
     */
    public function getHappenedAt()
    {
        return $this->happenedAt;
    }
}
