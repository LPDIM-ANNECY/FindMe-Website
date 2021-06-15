<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Place;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /**
         * CATEGORY
         */
        $bridge = (new Category())->setName('Pont');
        $church = (new Category())->setName('Église');
        $marketplace = (new Category())->setName('Marché');

        /**
         * PLACE
         */
        $basilique = new Place();
        $basilique->setName('Eglise Basilique de la Visitation');
        $basilique->setCategory($church);
        $basilique->setActive(True);
        $basilique->setDescription('La basilique de la Visitation, dressée sur le crêt du Maure, qui est le premier contrefort du massif du Semnoz, apparaît comme dominant Annecy et se repère de tout lieu, des kilomètres à la ronde');
        $basilique->setDifficulty(2);
        $basilique->setLatitude(45.89264634808408);
        $basilique->setLongitude(6.127579211291609);
        $basilique->setRadiusType(3);

        $amours = new Place();
        $amours->setName('Pont des Amours');
        $amours->setCategory($bridge);
        $amours->setActive(True);
        $amours->setDescription('Le pont des Amours est une passerelle située au bord du lac d\'Annecy à l\'entrée du canal du Vassé ; son nom officiel est « Passerelle du Jardin public » mais les Annéciens l\'ont depuis très longtemps rebaptisé « Pont des Amours »');
        $amours->setDifficulty(1);
        $amours->setLatitude(45.90021392770459);
        $amours->setLongitude(6.131381025876303);
        $amours->setRadiusType(1);


        $noel = new Place();
        $noel->setName('Marché de Noël Annecy');
        $noel->setCategory($marketplace);
        $noel->setActive(True);
        $noel->setDescription('Spécialisé dans les métiers de bouche et les idées cadeaux, ce marché de Noël faisait la part belle aux réjouissances gastronomiques.');
        $noel->setDifficulty(1);
        $noel->setLatitude(45.89914109273048);
        $noel->setLongitude(6.128102249599104);
        $noel->setRadiusType(3);


        $manager->persist($bridge);
        $manager->persist($church);
        $manager->persist($marketplace);
        $manager->persist($basilique);
        $manager->persist($amours);
        $manager->persist($noel);
        $manager->flush();
    }
}
