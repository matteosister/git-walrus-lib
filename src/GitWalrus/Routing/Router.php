<?php
/**
 * User: matteo
 * Date: 31/03/13
 * Time: 23.08
 * Just for fun...
 */


namespace GitWalrus\Routing;

use GitWalrus\GitWalrus;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;

class Router
{
    /**
     * @var RouteCollection
     */
    private $routes;

    public function __construct(GitWalrus $gitWalrus)
    {
        $locator = new FileLocator(array($gitWalrus->getConfigPath()));
        $loader = new YamlFileLoader($locator);
        $this->routes = $loader->load('routes.yml');
    }

    /**
     * Get Routes
     *
     * @return \Symfony\Component\Routing\RouteCollection
     */
    public function getRoutes()
    {
        return $this->routes;
    }
}