<?php

namespace App\Controller;

use App\dto\ReportDto;
use App\Repository\ReportTripRepository;
use App\Repository\TripRepository;
use App\dtoConverter\ReportDtoConverter;
use Psr\Log\LoggerInterface;
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

        $index=0;
        foreach ($reports as $report) {
           
         $reportDtos[$index]= $converter->convertToDto($report);
         $index++;
        }

        return $this->json($reportDtos);
    }

     #[Route('/api/changeReportStatus/{id}/{status}', methods:['PUT'])]
    public function ChangeReportStatus (LoggerInterface $logger,string $status, ReportTripRepository $reportRepository, int $id):JsonResponse{


         $publish = false;
        if ($status == 'true') {
            $publish = true;
        } elseif ($status == 'false') {
            $publish = false;
        } else {
            return $this->json(['error' => 'Invalid status'], 400);
        }
        $reportRepository->findById($id);
        $reportTrip = $reportRepository->find($id);
        $reportTrip->setPublish($publish);

        $logger->info('Report status changed', [
            'reportId' => $id,
            'newStatus' => $status,
        ]);
        $reportRepository->save($reportTrip);
        
        return $this->json(['status' => 'success']);
    }

}
