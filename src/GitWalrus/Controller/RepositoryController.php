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

class RepositoryController extends Controller
{
    public function rootAction($ref)
    {
        return $this->render('Repository/repository.html.twig', array(
            'repo' => $this->getRepo(),
            'ref' => $ref,
            'path' => null
        ));
    }

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
        $response = $this->render('Repository/repository.html.twig',
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
        $tree = $git->getTree($ref, $path);
        try {
            $readme = $git->getTree('master', 'README.md')->getBinaryData();
        } catch (\Exception $e) {
            $readme = null;
        }
        $response = $this->render('Repository/tree.html.twig',
            compact('git', 'tree', 'ref', 'path', 'slug', 'readme'));

        return $response;
    }
}