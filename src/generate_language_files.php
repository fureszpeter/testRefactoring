<?php

use Language\Domain\Factories\BashLanguageFileGeneratorFactory;

chdir(__DIR__);

include '../vendor/autoload.php';

//$languageBatchBo = new \Language\LanguageBatchBo();
$languageBatchBo = BashLanguageFileGeneratorFactory::create();
$languageBatchBo->generateLanguageFiles();
$languageBatchBo->generateAppletLanguageXmlFiles();
