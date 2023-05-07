<?php
require_once 'helpers/Image.php';
require_once 'helpers/ImageModifierGeneral.php';

if (! isset($_GET['fileName'])) {
    echo "Parameter fileName not found";
    exit;
}
$fileName = $_GET['fileName'];
$filePath = STORAGE_IMAGES.'/'.$fileName;
if (! file_exists($filePath)) {
    echo "File not exist.";
    exit;
}

if (! isset($_GET['width']) || ! isset($_GET['height'])) {
    echo "Parameters height or width is missing.";
    exit;
}

$width = $_GET['width'];
$height = $_GET['height'];

try {
    $image = new Image($filePath);
} catch (Exception $exception) {
    echo $exception->getMessage();
    exit;
}

try {
    $modifier = new ImageModifierGeneral($image);
} catch (Exception $exception) {
    echo $exception->getMessage();
    exit;
}

$modifier->resize($width, $height);
$modifier->display();
