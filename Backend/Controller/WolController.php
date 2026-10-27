<?php


class WolController
{
    #[Route(path: '/wol', method: ['POST'])]
    public function wol()
    {
        $wolService = new WolService();
        $wolService->wakeOnLan();

        echo json_encode(['success' => true]);
    }
}