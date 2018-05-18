<?php

namespace App\EventListener;

use App\Entity\Job;
use Doctrine\ORM\Event\LifecycleEventArgs;

class JobTokenListener
{
    /**
     * @param LifecycleEventArgs $args
     * @throws \Exception
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof Job) {
            return;
        }

        if (!$entity->getToken()) {
            $entity->setToken(\bin2hex(\random_bytes(10)));
        }
    }
}
