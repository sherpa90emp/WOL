<?php

require_once __DIR__.'/../Command/server-status.php';

class StatusService
{
    function checkStatus(): bool|array
    {
        $serverHost = getenv("SERVER_HOST");

        if ($serverHost === false)
        {
            throw new Exception("Configurazione host mancante");
        }

        return pingServer($serverHost);
    }
}