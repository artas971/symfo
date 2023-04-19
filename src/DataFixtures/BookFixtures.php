<?php

namespace App\DataFixtures;

use App\Entity\Book;
use App\DataFixtures\CategorieFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class BookFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $book = new Book();
        $book->setTitle('valle des immortels');
        $book->setDescription('black et mortimer la valle des immortels');
        $book->setImageName('blake-mortimer-tome-26-vallee-des-immortels.jpg');
        $book->setCategorie($this->getReference(CategorieFixtures::CATEGORIE_BD));
        $manager->persist($book);


        $book = new Book();
        $book->setTitle('Le cri du moloch');
        $book->setDescription('black et mortimer Le cri du moloch');
        $book->setImageName('blake-mortimer-tome-27-le-cri-du-moloch.jpg');
        $book->setCategorie($this->getReference(CategorieFixtures::CATEGORIE_BD));
        $manager->persist($book);


        $book = new Book();
        $book->setTitle('Le dernier espadon');
        $book->setDescription('black et mortimer Le dernier espadon');
        $book->setImageName('blake-mortimer-tome-28-le-dernier-espadon-couv.jpg');
        $book->setCategorie($this->getReference(CategorieFixtures::CATEGORIE_BD));
        $manager->persist($book);


        $book = new Book();
        $book->setTitle('L\'arcrobate');
        $book->setDescription('Le roman noire l\'acrobate');
        $book->setImageName('l-acrobate.jpeg');
        $book->setCategorie($this->getReference(CategorieFixtures::CATEGORIE_ROMAN));
        $manager->persist($book);


        $book = new Book();
        $book->setTitle('L\'heure H');
        $book->setDescription('Le roman noire l\'heure H');
        $book->setImageName('l-heure-h.jpeg');
        $book->setCategorie($this->getReference(CategorieFixtures::CATEGORIE_ROMAN));
        $manager->persist($book);


        $book = new Book();
        $book->setTitle('La horde');
        $book->setDescription('Le roman noire la horde');
        $book->setImageName('la-horde.jpeg');
        $book->setCategorie($this->getReference(CategorieFixtures::CATEGORIE_ROMAN));
        $manager->persist($book);

        

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategorieFixtures::class,
        ];
    }
}
