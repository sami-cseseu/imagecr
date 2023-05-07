<?php
require_once 'helpers/Image.php';
require_once 'constants.php';

test('Exception throws if file is not an image', function () {
    expect(fn() => new Image(STORAGE_TESTS.'/testText.txt'))->toThrow('Not a valid image.');
});

test('All the Function correctly works', function () {
    $imagePath = STORAGE_TESTS.'/dog.jpg';
    $image = new Image($imagePath);

    [$width, $height] = getimagesize($imagePath);
    $type = mime_content_type($imagePath);

    expect($image->height())->toEqual($height);
    expect($image->width())->toEqual($width);
    expect($image->type())->toEqual($type);
    expect($image->path())->toEqual($imagePath);
});
