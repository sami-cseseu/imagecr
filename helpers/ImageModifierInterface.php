<?php

interface ImageModifierInterface
{
    /**
     * @param  int  $width
     * @param  int  $height
     * @return void
     */
    public function resize(int $width, int $height): void;

    /**
     * @param  int  $width
     * @param  int  $height
     * @return void
     */
    public function crop(int $width, int $height): void;

    /**
     * @return mixed
     */
    public function getModifiedImage();

    /**
     * @return void
     */
    public function display(): void;
}
