<?php


namespace App\DataFixtures;


use App\Entity\Activity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class ActivityFixtures extends Fixture implements DependentFixtureInterface
{

    public function getDependencies()
    {
        return array(
            PlanningFixtures::class,
        );
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 75; $i++) {
            $planning = $this->getReference("planning_" . rand(0, 19));
            $activity = new Activity();
            $activity->setName($faker->company)
                ->setDay(rand(1, $planning->getDaysCount()))
                ->setPosition(1)
                ->setAddress($faker->address)
                ->setType('plane')
                ->setDescription($faker->text(150))
                ->setPrice($faker->randomFloat(2, $min = 0, $max = 1500))
                ->setStartAt($faker->dateTimeBetween($planning->getStartAt(), $planning->getFinishAt()))
                ->setPlanning($planning);

            $manager->persist($activity);
        }
        $manager->flush();
    }
}