<?php

require_once __DIR__.'/../Service/StandbyService.php';

readonly class StandbyController
{
    public function __construct(
        private readonly StandbyService $standbyService,
    )
    {
    }

    #[Route('/api/standby', method: 'POST')]
    function putInStandby(): string
    {
        $standby = $this->standbyService->standbyLogic();

        $data[] = [
            'status' => 'success',
            'code' => $standby['code'],
            'output' => $standby['output'],
        ];

        return json_encode($data);
    }
}