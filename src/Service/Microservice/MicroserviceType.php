<?php

namespace App\Service\Microservice;

enum MicroserviceType
{
    case REST;
    case gRPC;
    case HTTP;
}