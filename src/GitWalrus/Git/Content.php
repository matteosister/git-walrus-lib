<?php
/**
 * User: matteo
 * Date: 30/11/12
 * Time: 0.06
 *
 * Just for fun...
 */

namespace GitWalrus\Git;

use Cypress\PygmentsElephantBundle\PygmentsElephant\Pygmentize;
use GitElephant\Repository;
use Symfony\Component\HttpFoundation\Request;
use GitElephant\Objects\TreeObject;
use GitElephant\Objects\Diff\DiffChunk;

/**
 * Git Content
 */
class Content
{
    const JPG = '\xFF\xD8\xFF';
    const GIF  = 'GIF';
    const PNG  = '\x89\x50\x4e\x47\x0d\x0a\x1a\x0a';

    /**
     * @var Repository
     */
    private $repository;

    /**
     * @var Pygmentize
     */
    private $pygmentize;

    /**
     * Class constructor
     *
     * @param \GitElephant\Repository $repository repository
     * @param Pygmentize              $pygmentize pygmentize
     */
    public function __construct(Repository $repository, Pygmentize $pygmentize)
    {
        $this->repository = $repository;
        $this->pygmentize = $pygmentize;
    }

    /**
     * output git Treeobject content
     *
     * @param \GitElephant\Repository         $repository repository
     * @param \GitElephant\Objects\TreeObject $treeObject tree object
     * @param string                          $ref        reference
     *
     * @return string
     */
    public function outputContent(TreeObject $treeObject, $ref = 'HEAD')
    {
        $output = $this->pygmentize->format($this->repository->outputRawContent($treeObject, $ref), $treeObject->getName());
        $matches = array();
        preg_match("'<div class=\"highlight\"><pre>(.*)\n</pre></div>'si", $output, $matches);
        $arrContent = preg_split('/\n/', $matches[1]);
        $arrOutput = array();
        $arrNumbers = array();
        foreach ($arrContent as $i => $line) {
            $arrNumbers[] = '<div class="number">'.($i + 1).'</div>';
            $arrOutput[] = '<div class="ln">'.$line.'</div>';
        }

        return array(
            'line_numbers' => implode($arrNumbers),
            'content' => implode($arrOutput)
        );
    }

    /**
     * output git DiffChunkLine content
     *
     * @param \GitElephant\Objects\Diff\DiffChunk $diffChunk
     *
     * @return string
     */
    public function outputChunk(DiffChunk $diffChunk)
    {
        //var_dump($diffChunkLine);
        return implode($diffChunk->getLines(), "\n");
    }
}
