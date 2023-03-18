<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    #[Route('/show', name: 'show')]
    public function show()
    {
        $users = $this->entityManager->getRepository(User::class)->findAll();

        echo '<pre>';
        print_r($users);
        echo '</pre>';

        exit('show...test...');
    }

    #[Route('/create', name: 'create')]
    public function create()
    {
        $user = new User();
        $user->setFirstName((string)random_int(1, 1000));
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        exit('create...');
    }
}