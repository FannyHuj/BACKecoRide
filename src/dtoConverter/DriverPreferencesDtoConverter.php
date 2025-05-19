<?php
namespace App\dtoConverter;

use App\Dto\DriverPreferencesDto;
use App\Entity\DriverPreferences;

class DriverPreferencesDtoConverter {

    
      public function converterToEntity($dto) {
        
        $preferences = new DriverPreferences();
        $preferences->setAnimals($dto->getAnimals());
        $preferences->setSmoking($dto->getSmoking());
        $preferences->setTags($dto->getTags());
     

        return $preferences;
    }

    public function converterToDto($preferences) {

        $preferencesDto = new DriverPreferencesDto();

        $preferencesDto->setAnimals($preferences->isAnimals());
        $preferencesDto->setSmoking($preferences->isSmoking());
        $preferencesDto->setTags($preferences->getTags());
     
        return $preferencesDto;
    }

}