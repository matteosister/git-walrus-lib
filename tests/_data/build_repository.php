<?php
/**
 * User: matteo
 * Date: 05/04/13
 * Time: 22.23
 * Just for fun...
 */

include __DIR__.'/../../vendor/autoload.php';

use Symfony\Component\Filesystem\Filesystem;
use GitElephant\Repository;

$dir = '/test_repository';
$f = new Filesystem();
$r = new Repository($dir);
$r->init();
$f->touch($dir.'/file1');
$f->touch($dir.'/file2');
$f->mkdir($dir.'/dir1');
$f->touch($dir.'/dir1/file3');
$r->commit('first commit', true);