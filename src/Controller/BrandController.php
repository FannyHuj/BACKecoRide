<?php

namespace App\Controller;

use App\Repository\BrandRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class BrandController extends AbstractController
{
    #[Route('/api/brand/all')]
    public function findAll(BrandRepository $brandRepository,SerializerInterface $serializer): JsonResponse
    {
       return $this->json($serializer->serialize($brandRepository->findAll(), 'json'));
    }
}
