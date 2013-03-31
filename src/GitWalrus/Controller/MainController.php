<?php
/**
 * User: matteo
 * Date: 31/03/13
 * Time: 23.44
 * Just for fun...
 */


namespace GitWalrus\Controller;


use Symfony\Component\HttpFoundation\Response;

class MainController
{
    public function homepageAction()
    {
        return new Response('<h1>GitWalrus Hub</h1><h2>git-walrus repository</h2>');
    }
}