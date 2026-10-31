<?php

require_once __DIR__."/../Service/WolService.php";

class WolController
{
    public function __construct(
        private readonly WolService $wolService,
    )
    {
    }

    #[Route(path: '/api/wol', method: 'POST')]
    public function wol(): string
    {
        $wolService = new WolService();
        $wolCheck = $wolService->wakeOnLan();

        if ($wolCheck)
        {
            $data = [
                'status' => 'success',
                'message' => 'Server Up',
            ];

            return json_encode($data);
        }

        $data = [
            'status' => 'error',
            'message' => 'Server Down',
        ];

        return json_encode($data);
    }
}