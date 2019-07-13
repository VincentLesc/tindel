<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/{vueRouting}", requirements={"vueRouting"="^(?!api|_(profiler|wdt)).*"}, name="index")
     */
    public function index()
    {
        $user = $this->getUser();
        return $this->render(
            'base.html.twig',
            [
                'isAuthenticated' => json_encode(!empty($user)),
                'roles' => json_encode(!empty($user) ? $user->getRoles() : []),
            ]
        );
    }
}
