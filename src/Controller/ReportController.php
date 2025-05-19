<?php

namespace App\Controller;

use App\dto\ReportDto;
use App\Repository\ReportTripRepository;
use App\Repository\TripRepository;
use App\dtoConverter\ReportDtoConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;


class ReportController extends AbstractController
{
    #[Route('/api/report', methods:['POST'])]
    public function new(#[MapRequestPayload] ReportDto $reportDto,TripRepository $tripRepository, ReportTripRepository $reportTripRepository): JsonResponse
    {
        $trip = $tripRepository->findTripById($reportDto->getIdTrip());
        $convert=new ReportDtoConverter();

        $reportEntity= $convert->converterToEntity($reportDto,$trip);
        $reportTripRepository->save($reportEntity);
        return $this->json(['status' => 'success']);
    }

    #[Route('/api/employee/all/reports', methods: ['GET'])]
    public function getAllReport(ReportTripRepository $reportRepository, ReportDtoConverter $converter): JsonResponse
    {
        $reports = $reportRepository->findAll();
      
        $reportDtos[] = [];

        foreach ($reports as $report) {
         $reportDtos= $converter->convertToDto($report);
        }

        return $this->json($reportDtos);
    }

    }
