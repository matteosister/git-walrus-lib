<?php
/**
 * User: matteo
 * Date: 04/04/13
 * Time: 22.00
 * Just for fun...
 */


namespace GitWalrus\Controller;

use GitElephant\Repository;
use GitWalrus\Git\RefPathSplitter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * @return Repository
     */
    protected function getRepo()
    {
        return $this->get('repo');
    }

    /**
     * @return RefPathSplitter
     */
    protected function getRefPathSplitter()
    {
        return $this->get('ref_path_splitter');
    }
}