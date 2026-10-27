<?php


class WolService
{
    public function wakeOnLan(): bool
    {
        require_once '../Command/WOL.php';

        $macAddress = getenv("MAC_ADDRESS");
        $port = (int) getenv("PORT");
        $broadcastAddress = getenv("BROADCAST_ADDRESS");

        return wakeOnLan($macAddress, $broadcastAddress, $port);
    }
}