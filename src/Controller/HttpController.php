<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HttpController extends AbstractController
{
    #[Route('/http', name: 'http', methods: 'GET')]
    public function list(): Response
    {
        return new Response(http_build_query([
            'field1' => true,
            'field2' => 42,
            'field3' => [
                'key1' => 15,
                'key2' => 30,
            ],
        ]));
    }
}
