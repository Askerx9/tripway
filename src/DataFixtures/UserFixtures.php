<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker;

class UserFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager) : void
    {
        $faker = Faker\Factory::create('fr_FR');

        $user = new User();

        $user->setEmail($faker->email)
            ->setFirstname($faker->firstName())
            ->setLastname($faker->lastName)
            ->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'test'
        ));

        $manager->persist($user);
        $manager->flush();
    }
}
