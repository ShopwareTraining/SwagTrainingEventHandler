<?php declare(strict_types=1);

namespace SwagTraining\EventHandler\Event;

use Psr\Log\LoggerInterface;
use Shopware\Core\Content\Product\ProductEvents;
use Shopware\Core\Content\Product\SalesChannel\SalesChannelProductEntity;
use Shopware\Core\Framework\DataAbstractionLayer\Event\EntityLoadedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ProductSubscriber implements EventSubscriberInterface
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            ProductEvents::PRODUCT_LOADED_EVENT => 'onProductLoad'
        ];
    }

    public function onProductLoad(EntityLoadedEvent $event)
    {
        $products = $event->getEntities();
        foreach ($products as $product) {
            /** @var SalesChannelProductEntity $product */
            $this->logger->notice('TESTING product loaded: '.$product->getName());
        }
    }
}
