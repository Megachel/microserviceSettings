<?php

namespace App\Controller;

use App\Service\Microservice\MicroserviceConfig;
use App\Service\Microservice\MicroserviceFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MicroserviceController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(MicroserviceConfig $config, MicroserviceFactory $factory): Response
    {
        $microservices = [];

        foreach ($config->listMicroservices() as $microserviceName) {
            if ('bravo' === $microserviceName) {
                // Не успел доделать gRPC
                continue;
            }
            $microservices[] = $factory->getMicroservice($microserviceName);
        }

        return $this->render('index.html.twig', [
            'microservices' => $microservices,
        ]);
    }

    #[Route('/save/{name}', name: 'save')]
    public function save(Request $request, string $name, MicroserviceConfig $config, MicroserviceFactory $factory): Response
    {
        $microservice = $factory->getMicroservice($name);
        // example for alpha service
        $data = $request->getContent();
        $data = [
            'field1' => 'string',
            'field2' => true,
            'field3' => ['test1', 'test2']
        ];

        $microservice->saveAllSettings($data);

        return new Response('');
    }

}
