<?php
/**
 * User: matteo
 * Date: 06/04/13
 * Time: 9.18
 * Just for fun...
 */

$srcRoot = "lib";
$buildRoot = "build";

$phar = new Phar($buildRoot . "/git-walrus.phar",
	FilesystemIterator::CURRENT_AS_FILEINFO |     	FilesystemIterator::KEY_AS_FILENAME, "git-walrus.phar");
//$phar["index.php"] = file_get_contents($srcRoot . "/index.php");
//$phar["common.php"] = file_get_contents($srcRoot . "/common.php");
$phar->buildFromDirectory($srcRoot,'/.*/');
$phar->setStub($phar->createDefaultStub("index.php"));