<?php
require_once 'helpers/Image.php';
require_once 'helpers/ImageModifierGeneral.php';
require_once 'constants.php';

test('Unsupported image Format throws error', function () {
    $imagePath = STORAGE_TESTS.'/testTiff.tiff';
    $imageObject = new Image($imagePath);

    expect(fn() => new ImageModifierGeneral($imageObject))->toThrow('Unsupported Format.');
});

test('Image resize works', function () {
    $imagePath = STORAGE_IMAGES.'/dog.jpg';
    $imageObject = new Image($imagePath);
    $width = 500;
    $height = 500;
    $ratio = $imageObject->width() / $imageObject->height();
    if ($width / $height > $ratio) {
        $newwidth = ceil($height * $ratio);
        $newheight = $height;
    } else {
        $newheight = ceil($width / $ratio);
        $newwidth = $width;
    }

    $imageModifierGeneral = new ImageModifierGeneral($imageObject);
    $imageModifierGeneral->resize(500, 500);

    $modifiedImageObject = $imageModifierGeneral->getModifiedImage();

    $width = imagesx($modifiedImageObject);
    $height = imagesy($modifiedImageObject);

    expect($width)->toEqual($newwidth);
    expect($height)->toEqual($newheight);
});

test('Image crop works', function () {
    $imagePath = STORAGE_IMAGES.'/dog.jpg';
    $imageObject = new Image($imagePath);
    $newwidth = 500;
    $newheight = 500;

    $imageModifierGeneral = new ImageModifierGeneral($imageObject);
    $imageModifierGeneral->crop($newwidth, $newheight);

    $modifiedImageObject = $imageModifierGeneral->getModifiedImage();
    $width = imagesx($modifiedImageObject);
    $height = imagesy($modifiedImageObject);
    expect($width)->toEqual($newwidth);
    expect($height)->toEqual($newheight);
});
