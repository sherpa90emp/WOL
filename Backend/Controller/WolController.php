<?php


class WolController
{
    #[Route(path: '/api/wol', method: 'POST')]
    public function wol(): string
    {
        // $wolService = new WolService();
        $wolCheck = true; //$wolService->wakeOnLan();

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