<?php

interface ImageInterface
{
    /**
     * @return int
     */
    public function height(): int;

    /**
     * @return int
     */
    public function width(): int;

    /**
     * @return string
     */
    public function path(): string;

    /**
     * @return string
     */
    public function type(): string;
}
