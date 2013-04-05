<?php
/**
 * User: matteo
 * Date: 29/11/12
 * Time: 23.11
 * 
 * Just for fun...
 */

namespace GitWalrus\Git;

use GitWalrus\Git\Base\GitBaseService;
use GitWalrus\Git\RefPathSplitter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use GitElephant\Objects\TreeObject;
/**
 * Git route generator
 */
class Router extends GitBaseService
{

    /**
     * @var \Symfony\Component\Routing\RouterInterface
     */
    private $router;

    /**
     * @var RefPathSplitter
     */
    private $splitter;

    /**
     * Class constructor
     *
     * @param \Symfony\Component\HttpFoundation\Request $request   request
     * @param \Symfony\Component\Routing\RouterInterface $router   router
     * @param RefPathSplitter                            $splitter ref/path splitter
     */
    public function __construct(Request $request, RouterInterface $router, RefPathSplitter $splitter)
    {
        $this->request = $request;
        $this->router = $router;
        $this->splitter = $splitter;
    }

    /**
     * tree object url
     *
     * @param \GitElephant\Objects\TreeObject $treeObject
     *
     * @return string
     */
    public function treeObjectUrl(TreeObject $treeObject)
    {
        $parts = $this->splitter->split($this->request->attributes->get('ref'), $treeObject->getFullPath());

        return $this->router->generate('tree_object', array(
            'ref' => $parts[0],
            'path' => $parts[1]
        ));
    }
}
