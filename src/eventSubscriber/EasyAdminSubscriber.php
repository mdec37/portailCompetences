<?php
namespace App\eventSubscriber;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
class EasyAdminSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['setUserAddedDate'],
            BeforeEntityUpdatedEvent::class => ['setUpdateUserAddedDate'],
        ];
    }
    // pour retourner une date qui correspond à maintenant
        public function setUserAddedDate(BeforeEntityPersistedEvent $event){
            $entity = $event->getEntityInstance();
            if(!($entity instanceof User)){
                return;
            }
            $now = new \DateTime('now');
            $entity->setCreateAt($now);
        }

    public function setUpdateUserAddedDate(BeforeEntityUpdatedEvent $event){
        $entity = $event->getEntityInstance();
        if(!($entity instanceof User)){
            return;
        }
        $now = new \DateTime('now');
        $entity->setModifiedAt($now);
    }
}