<?php


namespace App\DataFixtures;


use App\Entity\User;
use DateInterval;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{

    private UserPasswordEncoderInterface $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }


    public function load(ObjectManager $manager)
    {
        $admin = new User();

        /**
         * ADMIN
         */
        $admin->setEmail('me@test200.fr');
        $admin->setCompanyName('Test200');
        $admin->setPassword($this->encoder->encodePassword($admin, 'test200'));
        $admin->setCreateAt();
        $admin->setRoles(['ROLE_ADMIN']);

        /**
         * CUSTOMERS
         */
        $annecy = new User();
        $annecy->setEmail('annecy@annecy.fr');
        $annecy->setCompanyName("Office de Tourisme du Lac d'Annecy");
        $annecy->setPassword($this->encoder->encodePassword($annecy, 'annecy'));
        $annecy->setCreateAt();
        $annecy->setRoles(['ROLE_CUSTOMER']);

        $chambery = new User();
        $chambery->setEmail('chambery@annecy.fr');
        $chambery->setCompanyName("Grand Chambéry Alpes Tourisme");
        $chambery->setPassword($this->encoder->encodePassword($chambery, 'chambery'));
        $chambery->setCreateAt();
        $chambery->setRoles(['ROLE_CUSTOMER', 'ROLE_TEST']);


        $manager->persist($admin);
        $manager->persist($annecy);
        $manager->persist($chambery);
        $manager->flush();
    }
}
