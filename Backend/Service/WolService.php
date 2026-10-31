<?php

class WolService
{
    private function wakeOnLan(): bool
    {
        $macAddress = getenv("MAC_ADDRESS");
        $port = (int) getenv("PORT");
        $broadcastAddress = getenv("BROADCAST_ADDRESS");

        return wakeOnLan($macAddress, $broadcastAddress, $port);
    }
}