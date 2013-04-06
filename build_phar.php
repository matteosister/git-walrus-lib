<?php
/**
 * User: matteo
 * Date: 06/04/13
 * Time: 9.18
 * Just for fun...
 */

require_once __DIR__.'/lib/vendor/autoload.php';

$srcRoot = "lib";
$buildRoot = "build";

$finder = new Symfony\Component\Finder\Finder();
$finder->files()->in(__DIR__.'/'.$srcRoot)
    ->exclude('vagrant')
    ->exclude('.vagrant')
    ->exclude('tmp')
    ->exclude('tests')
    ->exclude('app/cache')
    ->exclude('app/logs')
    ->exclude('cookbooks')
    ->exclude('codeception.yml')
;

$phar = new Phar($buildRoot . "/git-walrus.phar", 0, "git-walrus.phar");
//$phar["index.php"] = file_get_contents($srcRoot . "/index.php");
//$phar["common.php"] = file_get_contents($srcRoot . "/common.php");
//$phar->buildFromDirectory($srcRoot);
$phar->buildFromIterator($finder->getIterator(), $srcRoot);
$phar->setStub($phar->createDefaultStub("index.php"));