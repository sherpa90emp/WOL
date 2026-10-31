<?php

require_once __DIR__ . '/../Service/StatusService.php';

readonly class StatusController
{
    public function __construct(
        private readonly StatusService $statusService,
    )
    {
    }

    #[Route('/api/status', method: 'GET')]
    function getStatus(): string
    {

        $status = $this->statusService->checkStatus();

        $data[] = [
            'status' => 'success',
            'up' => $status['up'],
            'code' => $status['code'],
            'output' => $status['output'],
        ];

        return json_encode($data);
    }
}