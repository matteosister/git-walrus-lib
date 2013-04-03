<?php
/**
 * User: matteo
 * Date: 31/03/13
 * Time: 22.59
 * Just for fun...
 */


namespace GitWalrus;

use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Bundle\BundleInterface;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Routing\Matcher\UrlMatcher;

/**
 * Class GitWalrus
 *
 * @package GitWalrus
 */
class GitWalrusKernel extends Kernel
{

//    public function __construct($basePath)
//    {
//        $this->basePath = $basePath;
//        $this->router = new Router($this);
//        $matcher = new UrlMatcher($this->router->getRoutes(), new RequestContext());
//        $dispatcher = new EventDispatcher();
//        $dispatcher->addSubscriber(new RouterListener($matcher));
//        $resolver = new ControllerResolver();
//        $this->kernel = new HttpKernel($dispatcher, $resolver);
//    }

    /**
     * Returns an array of bundles to registers.
     *
     * @return BundleInterface[] An array of bundle instances.
     *
     * @api
     */
    public function registerBundles()
    {
        return array(
            new FrameworkBundle()
        );
    }

    /**
     * Loads the container configuration
     *
     * @param LoaderInterface $loader A LoaderInterface instance
     *
     * @api
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/services.yml');
    }
}