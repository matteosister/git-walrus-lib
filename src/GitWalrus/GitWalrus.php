<?php
/**
 * User: matteo
 * Date: 31/03/13
 * Time: 22.59
 * Just for fun...
 */


namespace GitWalrus;

use GitWalrus\Routing\Router;
use GitWalrus\Resolver\ControllerResolver;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\EventListener\RouterListener;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;

/**
 * Class GitWalrus
 *
 * @package GitWalrus
 */
class GitWalrus
{
    /**
     * @var string
     */
    private $basePath;

    /**
     * @var Routing\Router
     */
    private $router;

    /**
     * @var HttpKernel
     */
    private $kernel;

    public function __construct($basePath)
    {
        $this->basePath = $basePath;
        $this->router = new Router($this);
        $matcher = new UrlMatcher($this->router->getRoutes(), new RequestContext());
        $dispatcher = new EventDispatcher();
        $dispatcher->addSubscriber(new RouterListener($matcher));
        $resolver = new ControllerResolver();
        $this->kernel = new HttpKernel($dispatcher, $resolver);
    }

    public function handleRequest(Request $request)
    {
        return $this->getKernel()->handle($request);
    }

    /**
     * Get Kernel
     *
     * @return \Symfony\Component\HttpKernel\HttpKernel
     */
    public function getKernel()
    {
        return $this->kernel;
    }

    /**
     * Get BasePath
     *
     * @return string
     */
    public function getBasePath()
    {
        return $this->basePath;
    }

    /**
     * @return string
     */
    public function getConfigPath()
    {
        return $this->basePath.'/app/config';
    }
}