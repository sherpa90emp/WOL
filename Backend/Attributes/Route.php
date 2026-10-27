<?php

#[Attribute(Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class Route
{
    public function __construct(
        public string $path,
        public array|string $method = ['GET', 'POST', 'OPTIONS']
    )
    {
    }
}