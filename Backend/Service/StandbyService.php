<?php

require_once __DIR__.'/../Command/standby.php';

class StandbyService
{
    function standbyLogic(): bool|array {
        $serverHost = getenv("SERVER_HOST");
        $user = getenv("STANDBY_SSH_USER");
        $keyPath = getenv("STANDBY_SSH_KEY");
        $knownHosts = getenv("STANDBY_KNOWN_HOSTS");

        return standby($serverHost, $user, $keyPath, $knownHosts);
    }

}