<?php
$I = new WebGuy($scenario);
$I->haveAGitRepository();
$I->wantTo('see the repository list');
$I->amOnPage('/');
$I->see('Git Walrus', 'h1');
$I->seeElement('table.tree');
$I->see('file1');
$I->see('file2');
$I->see('dir1');
$I->dontSee('file3');
