<?php
namespace App\dtoConverter;

use App\dto\ReportDto;
use App\Entity\ReportTrip;
use App\dto\UserDtoMin;
use App\dto\TripFullDto;

class ReportDtoConverter {

    public function converterToEntity($dto, $trip) {
        $report = new ReportTrip();
        $report->setTrip( $trip);
        $report->setDate(new \DateTime());
        $report->setDetail($dto->getDetail());

        return $report;
    }

    
    public function convertToDto(ReportTrip $report)
    {

        $reportDto = new ReportDto();

        $tripFullDto = new TripFullDto();
        $tripFullDto->setId($report->getTrip()->getId());
        $tripFullDto->setDepartDate($report->getTrip()->getDepartDate());   
        $tripFullDto->setDepartLocation($report->getTrip()->getDepartLocation());
        $tripFullDto->setArrivalDate($report->getTrip()->getArrivalDate());
        $tripFullDto->setArrivalLocation($report->getTrip()->getArrivalLocation());

         foreach($report->getTrip()->getUsers() as $ut){
                if($ut->getDriver()  == true){
                    $driver=$ut->getUser();
                    
                    $userDtoMin = new UserDtoMin();
                    $userDtoMin->setId($driver->getId());
                    $userDtoMin->setFirstName($driver->getFirstName()); 
                    $userDtoMin->setLastName($driver->getLastName());
                    $tripFullDto->setDriver($userDtoMin);
                }
            }
        
        $reportDto->setIdTrip($tripFullDto);
        $reportDto->setDate($report->getDate());
        $reportDto->setId($report->getId());
        
        $userDtoMin = new UserDtoMin();
        $userDtoMin->setId($report->getReportOwner()->getId());
        $userDtoMin->setFirstName($report->getReportOwner()->getFirstName());
        $userDtoMin->setLastName($report->getReportOwner()->getLastName());
        $userDtoMin->setEmail($report->getReportOwner()->getEmail());

        $reportDto->setReportOwner($userDtoMin);

       
        
        $reportDto->setDetail($report->getDetail());
    
        return $reportDto;
    }

}