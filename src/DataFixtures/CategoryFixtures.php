<?php


namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $bridge = (new Category())->setName('Pont');
        $church = (new Category())->setName('Église');
        $marketplace = (new Category())->setName('Marché');

        $manager->persist($bridge);
        $manager->persist($church);
        $manager->persist($marketplace);
        $manager->flush();
    }
}
