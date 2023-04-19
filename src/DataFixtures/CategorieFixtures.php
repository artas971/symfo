<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CategorieFixtures extends Fixture
{


    public const CATEGORIE_BD = 'categorie_bd';
    public const CATEGORIE_ROMAN = 'categorie_roman';

    public function load(ObjectManager $manager): void
    {
        $categorie = new Categorie();
        $categorie->setTitle('Bande dessiné');
        $categorie->setDescription('Bande dessiné de tout genre');
        $manager->persist($categorie);
        $this->addReference(self::CATEGORIE_BD, $categorie);

        $categorie = new Categorie();
        $categorie->setTitle('Roman');
        $categorie->setDescription('Roman de tout genre');
        $manager->persist($categorie);
        $this->addReference(self::CATEGORIE_ROMAN, $categorie);



        $manager->flush();
    }
}
