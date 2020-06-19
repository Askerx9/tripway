<?php

namespace App\DataFixtures;

use App\Entity\Planning;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class PlanningFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager) : void
    {
        $faker = Faker\Factory::create('fr_FR');
        $startDate = new \DateTime();

        for ($i = 0; $i < 20; $i++) {
            $planning = new Planning();
            $planning->setName($faker->country)
                ->setStartAt($startDate)
                ->setFinishAt($faker->dateTimeBetween("now", "+40 days"))
                ->setDaysCount((int) $planning->getFinishAt()->diff($startDate)->format("%a"))
                ->setImageName($faker->imageUrl(300, 180, 'city'))
                ->setUser($this->getReference("user_" . rand(0, 2)));
            // $product = new Product();
            $manager->persist($planning);
        }
        $manager->flush();
    }

    public function getDependencies() : array
    {
        return array(
            UserFixtures::class,
        );
    }

}
