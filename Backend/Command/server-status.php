<?php

function pingServer(string $serverHost): bool|array
{
    exec('ping -c 1 -W 1 '.escapeshellarg($serverHost), $output, $code);
    return [
        'up' => $code === 0,
        'code' => $code,
        'output' => $output,
        ];
}