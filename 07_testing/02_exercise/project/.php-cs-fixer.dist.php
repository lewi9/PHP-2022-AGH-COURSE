<?php

use PhpCsFixer\Finder;
use PhpCsFixer\Config;

$finder = Finder::create();
$finder->exclude("vendor");
$finder->exclude('tests/Support/_generated');

$config = new Config();
$config->setFinder($finder);

return $config;
