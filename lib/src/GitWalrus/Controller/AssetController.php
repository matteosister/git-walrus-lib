<?php
/**
 * User: matteo
 * Date: 04/04/13
 * Time: 21.44
 * Just for fun...
 */

namespace GitWalrus\Controller;

use Assetic\Asset\AssetCollection;
use Assetic\Asset\FileAsset;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AssetController extends Controller
{
    public function cssAction()
    {
        $rootDir = $this->container->getParameter('kernel.root_dir');
        $response = new Response();
        $response->headers->set('Content-Type', 'text/css');
        $css = new AssetCollection(array(
            new FileAsset($rootDir.'/assets/css/bootstrap/css/bootstrap.min.css'),
            new FileAsset($rootDir.'/assets/css/bootstrap/css/bootstrap-responsive.min.css')
        ));
        $response->setContent($css->dump());

        return $response;
    }
}