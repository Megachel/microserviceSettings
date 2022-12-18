<?php

namespace App\Controller;

use App\Service\Microservice\MicroserviceConfig;
use App\Service\Microservice\MicroserviceFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MicroserviceController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(MicroserviceConfig $config, MicroserviceFactory $factory): Response
    {
        $microservices = [];

        foreach ($config->listMicroservices() as $microserviceName) {
//            $microservices[] = $factory->getMicroservice($microserviceName);
        }

//        $microservices[] = $factory->getMicroservice('alpha');
        $microservices[] = $factory->getMicroservice('bravo');
//        $microservices[] = $factory->getMicroservice('charly');
        foreach($microservices as $microservice) {
            dump($microservice->getSettings()->getAll());
        }
        exit;
        return $this->render('index.html.twig', [
            'microservices' => $microservices,
        ]);
    }
}
