<?php

$pathToAutoloader = codecept_root_dir('vendor/autoload.php');

if (!file_exists($pathToAutoloader)) {
    $pathToAutoloader = codecept_root_dir('../../autoload.php');
}

require_once $pathToAutoloader;

$pageIndexMapFileName = 'PageIndexMap.php';
$pathToPageIndexMapDirectory = 'src/Generated/Shared/ConditionalAvailability/Search/';
$pathToPageIndexMap = sprintf('%s%s', $pathToPageIndexMapDirectory, $pageIndexMapFileName);

if (!file_exists(codecept_root_dir($pathToPageIndexMap))) {
    mkdir(codecept_root_dir($pathToPageIndexMapDirectory), 0755, true);

    copy(
        codecept_data_dir($pageIndexMapFileName),
        codecept_root_dir($pathToPageIndexMap)
    );
}
