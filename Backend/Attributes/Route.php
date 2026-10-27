<?php

#[Attribute(Attribute::TARGET_METHOD)]
class Route
{
    public function __construct(
        public string $path,
        public array $method = ['GET', 'POST', 'OPTIONS']
    )
    {
    }
}