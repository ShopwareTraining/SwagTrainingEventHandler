<?php declare(strict_types=1);

namespace SwagTraining\EventHandler\Event;

use Shopware\Core\System\SystemConfig\SystemConfigService;
use Shopware\Storefront\Event\StorefrontRenderEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class StorefrontSubscriber implements EventSubscriberInterface
{
    private SystemConfigService $systemConfigService;

    public function __construct(SystemConfigService $systemConfigService)
    {
        $this->systemConfigService = $systemConfigService;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            StorefrontRenderEvent::class => 'onStorefrontRender'
        ];
    }

    public function onStorefrontRender(StorefrontRenderEvent $event)
    {
        $request = $event->getRequest();
        $route = $request->attributes->get('_route');
        if ($route !== 'frontend.home.page') {
            return;
        }

        // Debug this by adding `dump()` to Twig
        $event->setParameter(
            'swagExample',
            ['example' => $this->systemConfigService->get('SwagTrainingEventHandler.config.example')]
        );
    }
}
