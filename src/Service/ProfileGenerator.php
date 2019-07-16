<?php

namespace App\Service;

use App\Entity\Profile;
use Carbon\Carbon;

class ProfileGenerator
{
    public function encodeProfile(Profile $profile)
    {
        $profile = [
            'title' => $profile->getTitle(),
            'description' => $profile->getDescription(),
            'ethnicity' => $profile->getEthnicity(),
            'birthdate' => $profile->getBirthdate()
        ];

        $data = json_encode($profile);

        return $data;
    }

    public function setProfile(Profile $profile, $array)
    {
        foreach($array as $key => $value)
        {
            if ($key === 'birthdate') {
                $date = explode('-', $value);
                $date = Carbon::createFromDate($date[0], $date [1], $date[2], 'Europe/Madrid');
                $value = $date;
            }

            $method = 'set' . ucfirst($key);
            $profile->$method($value);
        }

        return $profile;
    }
}
