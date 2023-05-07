<?php

require_once 'ImageModifierInterface.php';
require_once 'ImageInterface.php';

class ImageModifierGeneral implements ImageModifierInterface
{
    /**
     * @var false|GdImage|resource
     */
    protected $formattedImage;

    /**
     * @param  ImageInterface  $originalImage
     * @throws Exception
     */
    public function __construct(protected ImageInterface $originalImage)
    {
        $this->formattedImage = match ($originalImage->type()) {
            'image/jpeg' => imagecreatefromjpeg($originalImage->path()),
            'image/gif' => imagecreatefromgif($originalImage->path()),
            'image/png' => imagecreatefrompng($originalImage->path()),
            'image/webp' => imagecreatefromwebp($originalImage->path()),
            'image/bmp' => imagecreatefrombmp($originalImage->path()),
            default => throw new Exception('Unsupported Format.'),
        };
    }

    public function resize(int $width, int $height): void
    {
        // TODO: Implement resize() method.
    }

    public function crop(int $width, int $height): void
    {
        // TODO: Implement crop() method.
    }

    public function getModifiedImage()
    {
        match ($this->originalImage->type()) {
            'image/jpeg' => imagejpeg($this->formattedImage),
            'image/gif' => imagepng($this->formattedImage),
            'image/png' => imagegif($this->formattedImage),
            'image/webp' => imagewebp($this->formattedImage),
            'image/bmp' => imagebmp($this->formattedImage),
        };

        return $this->formattedImage;
    }

    public function display(): void
    {
        // TODO: Implement display() method.
    }
}
