<?php
/**
 * User: matteo
 * Date: 05/04/13
 * Time: 23.22
 * Just for fun...
 */

namespace GitWalrus\Twig;

use GitElephant\Objects\Diff\DiffChunk;
use GitElephant\Objects\Tree;
use GitElephant\Objects\TreeObject;
use Symfony\Component\DependencyInjection\ContainerInterface;

class GitWalrusExtension extends \Twig_Extension
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    private $container;

    /**
     * class constructor
     *
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getGlobals()
    {
        return array(
            'title' => $this->container->getParameter('title')
        );
    }

    /**
     * twig filters
     *
     * @return array
     */
    public function getFilters()
    {
        return array(
            'link_tree_object' => new \Twig_Filter_Method($this, 'linkTreeObject', array('is_safe' => array('all'))),
            'breadcrumb'       => new \Twig_Filter_Method($this, 'breadcrumb', array('is_safe' => array('html')))
        );
    }

    /**
     * twig functions
     *
     * @return array
     */
    public function getFunctions()
    {
        return array(
            'link_parent' => new \Twig_Function_Method($this, 'linkParent'),
            'output_content' => new \Twig_Function_Method($this, 'outputContent', array('is_safe' => array('html'))),
            'output_chunk' => new \Twig_Function_Method($this, 'outputChunk', array('is_safe' => array('html'))),
            'icon_for' => new \Twig_Function_Method($this, 'iconFor', array('is_safe' => array('html'))),
            'is_image' => new \Twig_Function_Method($this, 'isImage', array('is_safe' => array('html'))),
            'is_text' => new \Twig_Function_Method($this, 'isPygmentableText', array('is_safe' => array('html'))),
            'commit_box' => new \Twig_Function_Method($this, 'commitBox', array('is_safe' => array('html'))),
            'code_table' => new \Twig_Function_Method($this, 'codeTable', array('is_safe' => array('html'))),
            'user_login' => new \Twig_Function_Method($this, 'userLogin', array('is_safe' => array('html'))),
            'order_github_pagination_links' => new \Twig_Function_Method($this, 'orderGithubPaginationLinks', array('is_safe' => array('all')))
        );
    }

    /**
     * Generates an url from a treeObject
     *
     * @param \GitElephant\Objects\TreeObject $treeObject
     *
     * @return mixed
     */
    public function linkTreeObject(TreeObject $treeObject)
    {
        return $this->container->get('git_router')->treeObjectUrl($treeObject);
    }

    /**
     * link to the parent
     *
     * @return mixed
     */
    public function linkParent()
    {
        return $this->container->get('git_router')->parentUrl();
    }

    /**
     * output a tree object content
     *
     * @param \GitElephant\Objects\TreeObject $treeObject tree object
     * @param string                          $ref        reference
     *
     * @return mixed
     */
    public function outputContent(TreeObject $treeObject, $ref)
    {
        try {
            $output = $this->container->get('templating')->render('Twig/output_content.html.twig', array(
                'output' => $this->container->get('git_content')->outputContent($treeObject, $ref)
            ));
        } catch (\Exception $e) {
            $output = $this->container->get('templating')->render('Twig/output_content.html.twig', array(
                'link' => '(TODO) link to the file'
            ));
        }

        return $output;
    }

    /**
     * output a line
     *
     * @param \GitElephant\Objects\Diff\DiffChunk $diffChunk diff chunk
     *
     * @return mixed
     */
    public function outputChunk(DiffChunk $diffChunk)
    {
        return $this->container->get('git_content')->outputChunk($diffChunk);
    }

    /**
     * is an image
     *
     * @param \GitElephant\Objects\Tree $tree tree
     *
     * @return bool
     */
    public function isImage(Tree $tree)
    {
        if (!$tree->isBinary()) {
            return false;
        }
        $pathInfo = pathinfo($tree->getSubject()->getName());
        if (!isset($pathInfo['extension'])) {
            return false;
        }

        return in_array($pathInfo['extension'], array('jpg', 'jpeg', 'png', 'gif'));
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'git_walrus';
    }
}