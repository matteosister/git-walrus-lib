<?php
$I = new WebGuy($scenario);
$I->wantTo('perform actions and see result');
$I->amOnPage('/');
$I->see('GitElephant Hub', 'h1');
$I->see('Git Repositories', 'h2');
