<?php

chdir(__DIR__);

include '../vendor/autoload.php';

//$languageBatchBo = new \Language\LanguageBatchBo();
$languageBatchBo = new \Language\Infrastructure\Services\BashLanguageFileGenerator();
$languageBatchBo->generateLanguageFiles();
$languageBatchBo->generateAppletLanguageXmlFiles();
