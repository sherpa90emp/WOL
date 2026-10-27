<?php

function wakeOnLan($macAddress, $broadcastAddress, $port): bool
{
    if (strlen($macAddress) != 12) {
        echo "Errore: Indirizzo MAC non valido";
        return false;
    }
    $macBinary = pack('H12', $macAddress);
    $magicPacket = str_repeat(chr(0xff), 6) . str_repeat($macBinary, 16);

    $socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
    if (!$socket) {
        echo "Errore creazione socket: " . socket_strerror(socket_last_error());
        return false;
    }

    socket_set_option($socket, SOL_SOCKET, SO_BROADCAST, 1);
    $inviato = socket_sendto($socket, $magicPacket, strlen($magicPacket), 0, $broadcastAddress, $port);
    socket_close($socket);

    return $inviato !== false;
}