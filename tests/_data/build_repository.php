<?php
/**
 * User: matteo
 * Date: 05/04/13
 * Time: 22.23
 * Just for fun...
 */

require_once __DIR__.'/../../vendor/autoload.php';

use Symfony\Component\Filesystem\Filesystem;
use GitElephant\Repository;

$dir = sys_get_temp_dir().DIRECTORY_SEPARATOR.sha1(uniqid());
$f = new Filesystem();
$f->mkdir($dir);
$r = new Repository($dir);
$r->init();
$f->touch($dir.'/file1');
$f->touch($dir.'/file2');
$f->mkdir($dir.'/dir1');
$f->touch($dir.'/dir1/file3');
$r->commit('first commit', true);