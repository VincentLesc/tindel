<?php

namespace App\Controller;

use App\Service\ProfileGenerator;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/api/user/profile", name="user_profile")
     * @param ProfileGenerator $profileGenerator
     * @return JsonResponse
     */
    public function index(ProfileGenerator $profileGenerator)
    {
        $profile = $this->getUser()->getProfile();

        $data = $profileGenerator->encodeProfile($profile);

        return new JsonResponse($data, 200);
    }

    /**
     * @Route("/api/user/profile/update", name="user_profile_update")
     * @param Request $request
     * @param ObjectManager $manager
     * @param ProfileGenerator $generator
     * @return JsonResponse
     */
    public function update(Request $request, ObjectManager $manager, ProfileGenerator $generator)
    {
        $profile = $this->getUser()->getProfile();
        $request = json_decode($request->getContent());

        $profile = $generator->setProfile($profile, $request);

        $data = $generator->encodeProfile($profile);

        return new JsonResponse($data, 200);
    }

}
