<?php

//require_once __DIR__.'/vendor/autoload.php';
//require_once __DIR__.'/app/GitWalrusKernel.php';

require_once "phar://git-walrus.phar/vendor/autoload.php";
require_once "phar://git-walrus.phar/app/GitWalrusKernel.php";

use GitWalrus\GitWalrusKernel;
use Symfony\Component\HttpFoundation\Request;

$gw = new GitWalrusKernel('prod', true);
$request = Request::createFromGlobals();
$response = $gw->handle($request);
$response->send();
$gw->terminate($request, $response);