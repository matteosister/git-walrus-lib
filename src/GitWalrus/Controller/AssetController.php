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
use Assetic\Asset\GlobAsset;
use Assetic\Asset\StringAsset;
use Assetic\Filter\Sass\ScssFilter;
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
        $css = new AssetCollection();
        if ($this->container->getParameter('theme')) {
            $css->add(
                new FileAsset(sprintf($rootDir.'/../vendor/thomaspark/bootswatch/%s/bootstrap.css', $this->container->getParameter('theme')))
            );
        } else {
            $css->add(
                new FileAsset(sprintf($rootDir.'/assets/css/bootstrap/css/bootstrap.min.css', $this->container->getParameter('theme')))
            );
        }
        $css->add(new FileAsset($rootDir.'/assets/css/bootstrap/css/bootstrap-responsive.min.css'));
        $css->add(new FileAsset($rootDir.'/assets/css/git-walrus/main.css'));
        $css->add(new StringAsset($this->get('pygmentize')->generateCss()));
        $response->setContent($css->dump());

        return $response;
    }
}