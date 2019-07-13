<?php


namespace App\Controller;


use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

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
        $request = $request->getContent();
        $data = json_decode($request);
        $user = new User();
        $user->setEmail($data->email);
        $user->setPlainPassword($data->plainPassword);
        $manager->persist($user);
        $manager->flush();

        $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
        $this->container->get('security.token_storage')->setToken($token);
        $this->container->get('session')->set('_security_main', serialize($token));

        $response = json_encode(
            [
                'roles' => $user->getRoles(),
                'userId' => $user->getId()
            ]
        );

        return new JsonResponse($response, 200);
    }

}
