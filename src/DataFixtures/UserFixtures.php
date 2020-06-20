<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker;

class UserFixtures extends Fixture
{

    public const USER_REFERENCE = 'user';

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

        for ($i = 0; $i < 3; $i++) {
            $user = new User();
            $email = $i === 0 ? "test@test.be" : $faker->email;

            $user->setEmail($email)
                ->setFirstname($faker->firstName())
                ->setLastname($faker->lastName)
                ->setPassword($this->passwordEncoder->encodePassword(
                    $user,
                    'Fak3password!'
                ));

            $this->addReference("user_" . $i, $user);
            $manager->persist($user);
        }
        $manager->flush();


    }

}
