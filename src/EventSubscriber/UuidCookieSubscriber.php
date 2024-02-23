<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\Uid\Uuid;

class UuidCookieSubscriber implements EventSubscriberInterface
{
    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();

        if (!$request->cookies->has('UUID')) {
            $uuid = Uuid::v4()->toRfc4122();

            $cookie = new Cookie('UUID', $uuid, time() + 365*24*60*60); // Expires in 1 year

            $response = $event->getResponse() ?? new Response();
            $response->headers->setCookie($cookie);

            if (null === $event->getResponse()) {
                $event->setResponse($response);
            }
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            RequestEvent::class => 'onKernelRequest',
        ];
    }
}
