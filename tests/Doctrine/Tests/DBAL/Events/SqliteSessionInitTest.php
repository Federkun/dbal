<?php

namespace Doctrine\Tests\DBAL\Events;

use Doctrine\DBAL\Event\ConnectionEventArgs;
use Doctrine\DBAL\Event\Listeners\SqliteSessionInit;
use Doctrine\DBAL\Events;
use Doctrine\Tests\DbalTestCase;

class SqliteSessionInitTest extends DbalTestCase
{
    public function testPostConnect(): void
    {
        $connectionMock = $this->createMock('Doctrine\DBAL\Connection');
        $connectionMock->expects($this->once())
                       ->method('exec')
                       ->with($this->equalTo('PRAGMA foreign_keys = on'));

        $eventArgs = new ConnectionEventArgs($connectionMock);

        $listener = new SqliteSessionInit();
        $listener->postConnect($eventArgs);
    }

    public function testGetSubscribedEvents(): void
    {
        $listener = new SqliteSessionInit();
        self::assertEquals(array(Events::postConnect), $listener->getSubscribedEvents());
    }
}
