<?php

function standby(string $serverHost, string $user, string $keyPath, string $knownHosts): array
{
    $cmd = sprintf(
      'ssh -T -i %s -o IdentitiesOnly=yes -o BatchMode=yes -o ConnectTimeout=5 -o UserKnownHostsFile=%s %s@%s 2>&1',
        escapeshellarg($keyPath),
        escapeshellarg($knownHosts),
        escapeshellarg($user),
        escapeshellarg($serverHost)
    );

    exec($cmd, $output, $code);

    return [
        'ok' => $code === 0,
        'code' => $code,
        'output' => $output,
        ];
}