<?php

namespace Doctrine\DBAL\Event\Listeners;

use Doctrine\DBAL\Event\ConnectionEventArgs;
use Doctrine\DBAL\Events;
use Doctrine\Common\EventSubscriber;

/**
 * Sqlite session init event subscriber enable foreign key constraints.
 */
class SqliteSessionInit implements EventSubscriber
{
    /**
     * @param \Doctrine\DBAL\Event\ConnectionEventArgs $args
     *
     * @return void
     */
    public function postConnect(ConnectionEventArgs $args)
    {
        $conn = $args->getConnection();
        $conn->exec('PRAGMA foreign_keys = on');
    }

    /**
     * {@inheritdoc}
     */
    public function getSubscribedEvents()
    {
        return [Events::postConnect];
    }
}
