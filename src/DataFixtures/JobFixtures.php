<?php

namespace App\DataFixtures;


use App\Entity\Job;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class JobFixtures extends Fixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {

            $job = new Job();
//            $job->setCategory($manager->$this->getReference('category'));

            $job->setType('full-time');
            $job->setCompany($faker->company);
            $job->setLogo($faker->imageUrl());
            $job->setUrl($faker->url);
            $job->setPosition($faker->jobTitle);
//            $location = $faker->country.', '.$faker->city;
            $job->setLocation($faker->country);
            $job->setDescription($faker->text(100));
            $job->setHowToApply($faker->text(30));
            $job->setPublic($faker->boolean);
            $job->setActivated($faker->boolean);
            $job->setToken($faker->text);
            $job->setEmail($faker->companyEmail);
            $job->setExpiresAt($faker->dateTime);

            $manager->persist($job);
        }

        $manager->flush();
    }

    /**
     * @return int
     */
    public function getOrder(): int
    {
        return 2;
    }
}