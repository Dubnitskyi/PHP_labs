<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class TestControlerController extends AbstractController
{
    #[Route('/test/controler', name: 'app_test_controler')]
    public function test(): Response
    {
        return new Response('Hello from Symfony!');
    }
}
