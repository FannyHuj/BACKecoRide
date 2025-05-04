<?php
namespace App\dtoConverter;

use App\Entity\ReportTrip;

class ReportDtoConverter {

    public function converterToEntity($dto, $trip) {
        $report = new ReportTrip();
        $report->setTrip( $trip);
        $report->setDate(new \DateTime());
        $report->setDetail($dto->getDetail());

        return $report;
    }

}