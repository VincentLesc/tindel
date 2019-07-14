<?php

namespace App\Service;

use App\Entity\Profile;

class ProfileGenerator
{
    public function encodeProfile(Profile $profile)
    {
        $profile = [
            'title' => $profile->getTitle(),
            'description' => $profile->getDescription()
        ];

        $data = json_encode($profile);

        return $data;
    }
}
