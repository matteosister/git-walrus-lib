<?php
/**
 * User: matteo
 * Date: 30/11/12
 * Time: 0.11
 * 
 * Just for fun...
 */

namespace GitWalrus\Git\Base;

use Doctrine\ODM\MongoDB\DocumentRepository;
use GitElephant\Repository;
use Doctrine\ORM\EntityManager;
use Doctrine\Common\Persistence\ObjectManager;

class GitBaseService
{
    /**
     * @var \Symfony\Component\HttpFoundation\Request
     */
    protected $request;

    /**
     * @var Repository
     */
    private $repository;

    /**
     * @return Repository
     */
    protected function getGit()
    {
        return $this->repository;
    }
}
