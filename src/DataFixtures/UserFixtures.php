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
        /**
         * ADMIN
         */
        $admin = new User();
        $admin->setEmail('me@test200.fr');
        $admin->setPassword($this->encoder->encodePassword($admin, 'test200'));
        $admin->setCreateAt();
        $admin->setRoles(['ROLE_ADMIN']);

        /**
         * CUSTOMERS
         */
        $chief = new User();
        $chief->setEmail('chief@annecy.fr');
        $chief->setFirstName('Nathan');
        $chief->setLastName('Cuvellier');
        $chief->setPassword($this->encoder->encodePassword($chief, 'annecy'));
        $chief->setCreateAt();
        $chief->setRoles(['ROLE_CHIEF']);

        /**
         * CUSTOMERS
         */
        $employee1 = new User();
        $employee1->setEmail('1@annecy.fr');
        $employee1->setFirstName('Francois');
        $employee1->setLastName('Cottle');
        $employee1->setEmail('1@annecy.fr');
        $employee1->setPassword($this->encoder->encodePassword($employee1, 'annecy'));
        $employee1->setCreateAt();
        $employee1->setRoles(['ROLE_EMPLOYEE']);

        /**
         * CUSTOMERS
         */
        $employee2 = new User();
        $employee2->setEmail('2@annecy.fr');
        $employee2->setFirstName('Ginelle');
        $employee2->setLastName('Saffen');
        $employee2->setPassword($this->encoder->encodePassword($employee2, 'annecy'));
        $employee2->setCreateAt();
        $employee2->setRoles(['ROLE_EMPLOYEE']);


        $manager->persist($admin);
        $manager->persist($chief);
        $manager->persist($employee1);
        $manager->persist($employee2);
        $manager->flush();
    }
}
