<?php
/**
 * Скрипт сборки проекта
 */

function makeRightSlashes($path)
{
    return str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $path);
}

/**
 * Копирование конфигов из ./config в соответствующую
 * директорию в проекте. Одним словом - МИГРАЦИЯ_КОНФИГУРАЦИИ
 */
echo ">>> start copying configuration files... ";
$configureDir = makeRightSlashes(__DIR__ . '/build/config');
$copyTo = makeRightSlashes(__DIR__ . '/config');
if($openConfigureDir = opendir($configureDir)) {
    while(false !== ($file = readdir($openConfigureDir))) {
        if($file == "." || $file == "..") continue;
        $fullFilePath = $configureDir . DIRECTORY_SEPARATOR . $file;
        $finalFilePath = $copyTo . DIRECTORY_SEPARATOR . $file;
        @copy($fullFilePath, $finalFilePath);
    }
}
echo "OK!\n";
echo ">>> start copying public files... ";
$publicDir = makeRightSlashes(__DIR__ . '/build/public');
$copyTo = makeRightSlashes(__DIR__ . '/public');
if($openPublicDir = opendir($publicDir)) {
    while(false !== ($file = readdir($openPublicDir))) {
        if($file == "." || $file == "..") continue;
        $fullFilePath = $publicDir . DIRECTORY_SEPARATOR . $file;
        $finalFilePath = $copyTo . DIRECTORY_SEPARATOR . $file;
        @copy($fullFilePath, $finalFilePath);
    }
}
echo "OK!\n";

echo ">>> creating assets directory... ";
mkdir(makeRightSlashes(__DIR__ . '/public/assets'), 770);
echo "OK!\n";