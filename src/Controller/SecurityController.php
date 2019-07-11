<?php


namespace App\Controller;


use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    /**
     * @Route("/api/security/login", name="login", methods={"POST"})
     */
    public function login(Request $request)
    {
        $user = $this->getUser();

        return $this->json([
            'username' => $user->getUsername(),
            'roles' => $user->getRoles(),
        ]);
    }

    /**
     * @Route("/api/security/logout", name="logout")
     * @return void
     * @throws \RuntimeException
     */
    public function logout(): void
    {
        throw new \RuntimeException('This should not be reached!');
    }

    /**
     * @Route("/api/security/register", name="user_register")
     */
    public function register(Request $request, ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail($request->request->get('email'));
        $manager->persist($user);
        $manager->flush();
    }

}