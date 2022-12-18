<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RestController extends AbstractController
{
    #[Route('/rest', name: 'rest', methods: 'GET')]
    public function list(): Response
    {
        return $this->json([
            'field1' => 'string',
            'field2' => true,
            'field3' => ['test1', 'test2']
        ]);
    }
}
