<?php
/**
 * User: matteo
 * Date: 31/03/13
 * Time: 23.44
 * Just for fun...
 */


namespace GitWalrus\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class MainController extends Controller
{
    public function homepageAction()
    {
        return $this->render('homepage.html.twig', array(
            'repo' => $this->get('repo')
        ));
    }
}