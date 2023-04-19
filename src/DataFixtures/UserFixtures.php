<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{

    private $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $plainPassword = 'password';

        $user = new User();
        $user->setNom('Meneux');
        $user->setPrenom('Christian');
        $user->setEmail('cmeneux@graphikchannel.com');
        $user->setPassword($this->hasher->hashPassword($user, $plainPassword));
        $user->setIsVerified(true);
        $user->setRoles(['ROLE_ADMIN', 'ROLE_USER']);

        $manager->persist($user);

        $user = new User();
        $user->setNom('Jean');
        $user->setPrenom('Dupont');
        $user->setEmail('jean.dupont@gmail.com');
        $user->setPassword($this->hasher->hashPassword($user, $plainPassword));
        $user->setIsVerified(true);
        $user->setRoles(['ROLE_USER']);

        $manager->persist($user);




        $manager->flush();
    }
}
