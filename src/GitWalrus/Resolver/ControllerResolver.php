<?php
/**
 * User: matteo
 * Date: 31/03/13
 * Time: 23.50
 * Just for fun...
 */


namespace GitWalrus\Resolver;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\ControllerResolver as BaseResolver;

class ControllerResolver extends BaseResolver
{
    public function getController(Request $request)
    {
        if ($controller = $request->attributes->get('_controller')) {
            $request->attributes->set('_controller', 'GitWalrus\\Controller\\'.$controller);
        }

        return parent::getController($request);
    }
}