<?php
/**
 * User: matteo
 * Date: 31/03/13
 * Time: 23.44
 * Just for fun...
 */


namespace GitWalrus\Controller;

use GitWalrus\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class MainController extends Controller
{
    /**
     * Tree Object
     *
     * @param string $ref  actual reference
     * @param string $path actual path
     *
     * @return array
     */
    public function treeObjectAction($ref, $path)
    {
        $repository = $this->getRepo();
        $parts = $this->getRefPathSplitter()->split($ref, $path);
        $ref = $parts[0];
        $path = $parts[1];
        $response = $this->render('repository.html.twig',
            compact('repository', 'ref', 'path'));

        return $response;
    }

    /**
     * tree action
     *
     * @param string $ref  reference
     * @param string $path path
     *
     * @return array
     */
    public function treeAction($ref, $path)
    {
        $git = $this->getRepo();
        $parts = $this->getRefPathSplitter()->split($ref, $path);
        $ref = $parts[0];
        $path = $parts[1];
        $tree = $git->getTree($ref, $path);
        try {
            $readme = $git->getTree('master', 'README.md')->getBinaryData();
        } catch (\Exception $e) {
            $readme = null;
        }
        $response = $this->render('tree.html.twig',
            compact('git', 'tree', 'ref', 'path', 'slug', 'readme'));

        return $response;
    }

    /**
     * Homepage
     *
     * @return Response
     */
    public function homepageAction()
    {
        return $this->render('homepage.html.twig', array(
            'repo' => $this->get('repo')
        ));
    }
}