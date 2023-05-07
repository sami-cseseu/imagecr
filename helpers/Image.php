<?php

require_once 'ImageInterface.php';

class Image implements ImageInterface
{
    /**
     * @var int
     */
    protected int $height;

    /**
     * @var int
     */
    protected int $width;

    /**
     * @var string
     */
    protected string $type;

    /**
     * @throws Exception
     */
    public function __construct(protected string $path)
    {
        $imageInfo = getimagesize($path);
        if (is_array($imageInfo)) {
            [$this->width, $this->height] = $imageInfo;
            $this->type = mime_content_type($path);
        } else {
            throw new Exception('Not a valid image.');
        }
    }

    /**
     * @return int
     */
    public function height(): int
    {
        return $this->height;
    }

    /**
     * @return int
     */
    public function width(): int
    {
        return $this->width;
    }

    /**
     * @return string
     */
    public function path(): string
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function type(): string
    {
        return $this->type;
    }
}
