<?php

use Pstryk82\LeagueBundle\Entity\StoredEvent;
use Pstryk82\LeagueBundle\Event\LeagueWasFinished;
use Pstryk82\LeagueBundle\Repository\StoredEventRepository;
use Pstryk82\LeagueBundle\Storage\EventStorage;

class StorageTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var EventStorage
     */
    private $storage;

    /**
     *
     * @var StoredEventRepository
     */
    private $storedEventRepositoryMock;

    public function setUp()
    {
        $this->storedEventRepositoryMock = $this->getMockBuilder(StoredEventRepository::class)
                ->disableOriginalConstructor()->getMock();
        $this->storage = new EventStorage($this->storedEventRepositoryMock);
    }

    public function tearDown()
    {
        unset($this->storedEventRepositoryMock, $this->storage);
    }

    public function testFind()
    {
        $aggregateId = '17f';
        $now = new \DateTime();
        $storedEvent = new StoredEvent();
        $storedEvent
            ->setAggregateId($aggregateId)
            ->setAggregateClass('LeagueWasFinished')
            ->setEvent(serialize(new LeagueWasFinished($aggregateId, $now)))
            ->setHappenedAt(new DateTime())
            ->setId(1235);

        $this->storedEventRepositoryMock->method('findBy')
            ->with(['aggregateId' => '17f'])
            ->willReturn([$storedEvent]);

        $result = $this->storage->find($aggregateId);

        $this->assertCount(1, $result);
        $this->assertInstanceOf(LeagueWasFinished::class, reset($result));
    }
}
