<?php
/**
 * User: matteo
 * Date: 12/04/13
 * Time: 22.37
 * Just for fun...
 */


namespace GitWalrus\Controller;

class MainController extends Controller
{
    public function homepageAction()
    {
        var_dump($this->container->getParameter('root'));
        return $this->render('Main/homepage.html.twig',
            array('repo' => $this->getRepo())
        );
    }
}