<?php

require_once __DIR__.'/vendor/autoload.php';

use GitWalrus\GitWalrus;
use Symfony\Component\HttpFoundation\Request;

$gw = new GitWalrus(__DIR__);

$request = Request::createFromGlobals();
$response = $gw->getKernel()->handle($request);
$response->send();
$gw->getKernel()->terminate($request, $response);