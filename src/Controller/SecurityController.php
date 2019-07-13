<?php


namespace App\Controller;


use App\Entity\Profile;
use App\Entity\User;
use App\Repository\UserRepository;
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
     * @param Request $request
     * @return JsonResponse
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
     * @param Request $request
     * @param ObjectManager $manager
     * @return JsonResponse
     */
    public function register(Request $request, ObjectManager $manager, UserRepository $userRepository)
    {
        $data = json_decode($request->getContent());

        $user = new User();
        $user->setEmail($data->email);
        $user->setPlainPassword($data->plainPassword);
        $profile = new Profile();
        $user->setProfile($profile);
        $manager->persist($user);
        $manager->persist($profile);
        $manager->flush();

        $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
        $this->container->get('security.token_storage')->setToken($token);
        $this->container->get('session')->set('_security_main', serialize($token));

        $response = json_encode(
            [
                'roles' => $user->getRoles(),
                'id' => $user->getId()
            ]
        );
        $status = 200;

        return new JsonResponse($response, 200);
    }

    /**
     * @Route("/api/security/unique", name="user_unique")
     * @param Request $request
     * @param UserRepository $userRepository
     * @return JsonResponse
     */
    public function isUnique(Request $request, UserRepository $userRepository)
    {
        $data = json_decode($request->getContent());
        $bool = !$userRepository->findOneBy(['email'=>$data->email]);
        $response = $bool;
        return new JsonResponse($response, 200);
    }



}
