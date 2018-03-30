<?php


namespace rollun\notify\Middleware\Factory;


use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Psr\Log\LoggerInterface;
use rollun\notify\Middleware\NotifyWriter;
use Zend\Log\Logger;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class NotifyWriterFactory implements FactoryInterface
{

    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     * @return object
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var Logger $logger */
        $logger = $container->get(LoggerInterface::class);
        $writers = $logger->getWriters();
        return new NotifyWriter($writers);
    }
}