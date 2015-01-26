<?php

namespace LibApp\Controllers;

use Psr\Log\LoggerInterface;
use \Silex\Application;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolverInterface;
use Symfony\Component\HttpFoundation\Request;

class DecoratorControllerResolverSymfony extends ControllerResolver
{
    private $logger;
    private $app;
    private $controllerResolver;

    /**
     * Constructor.
     * 
     * @param \Silex\Application $app instance Application Silex 
     * @param ControllerResolverInterface $resolver A ControllerResolverInterface instance
     * @param LoggerInterface $logger A LoggerInterface instance
     */
    public function __construct(ControllerResolverInterface $resolver, Application $app, LoggerInterface $logger = null)
    {
        $this->logger = $logger;
        $this->app = $app;
        $this->controllerResolver = $resolver;
        parent::__construct($logger);
    }
    
    /**
     * Returns a callable for the given controller.
     *
     * @param string $controller A Controller string
     *
     * @return mixed A PHP callable
     *
     * @throws \InvalidArgumentException
     */
    protected function createController($controller)
    {
        if (false === strpos($controller, '::')) {
            throw new \InvalidArgumentException(sprintf('Unable to find controller "%s".', $controller));
        }

        list($class, $method) = explode('::', $controller, 2);

        if (!class_exists($class)) {
            throw new \InvalidArgumentException(sprintf('Class "%s" does not exist.', $class));
        }

        return array(new $class($this->app), $method);
    }
    
    protected function doGetArguments(Request $request, $controller, array $parameters)
    {
        foreach ($parameters as $param) {
            if ($param->getClass() && $param->getClass()->isInstance($this->app)) {
                $request->attributes->set($param->getName(), $this->app);

                break;
            }
        }

        return parent::doGetArguments($request, $controller, $parameters);
    }
}
