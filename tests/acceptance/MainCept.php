<?php
$I = new WebGuy($scenario);
$I->wantTo('see the repository');
$I->amOnPage('/');
$I->see('GitWalrus Hub', 'h1');
$I->see('git-walrus repository', 'h2');
