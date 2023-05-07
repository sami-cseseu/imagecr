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

    /**
     * @param  int  $width
     * @param  int  $height
     * @return void
     */
    public function resize(int $width, int $height): void
    {
        $ratio = $this->originalImage->width() / $this->originalImage->height();
        if ($width / $height > $ratio) {
            $newwidth = ceil($height * $ratio);
            $newheight = $height;
        } else {
            $newheight = ceil($width / $ratio);
            $newwidth = $width;
        }

        $blankImage = imagecreatetruecolor($newwidth, $newheight);
        imagecopyresampled(
            $blankImage,
            $this->formattedImage,
            0,
            0,
            0,
            0,
            $newwidth,
            $newheight,
            $this->originalImage->width(),
            $this->originalImage->height()
        );

        $this->formattedImage = $blankImage;
    }

    /**
     * @param  int  $width
     * @param  int  $height
     * @return void
     */
    public function crop(int $width, int $height): void
    {
        $minHeight = min($this->originalImage->height(), $height);
        $minWidth = min($this->originalImage->width(), $width);

        $this->formattedImage = imagecrop(
            $this->formattedImage,
            [
                'x'      => 0,
                'y'      => 0,
                'width'  => $minWidth,
                'height' => $minHeight,
            ]
        );
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

    /**
     * @return void
     */
    public function display(): void
    {
        $contentType = 'Content-Type:'.$this->originalImage->type();
        header($contentType);

        $this->getModifiedImage();
    }
}
