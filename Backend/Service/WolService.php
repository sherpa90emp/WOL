<?php

require_once __DIR__.'/../Command/WOL.php';

class WolService
{
    public function wakeOnLan(): bool
    {
        $macAddress = getenv("MAC_ADDRESS");
        $port = (int) getenv("PORT");
        $broadcastAddress = getenv("BROADCAST_ADDRESS");

        return wakeOnLan($macAddress, $broadcastAddress, $port);
    }
}