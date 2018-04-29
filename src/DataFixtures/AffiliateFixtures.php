<?php

namespace App\DataFixtures;

use App\Entity\Affiliate;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class AffiliateFixtures extends Fixture implements OrderedFixtureInterface
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

            $affiliate = new Affiliate();
            $affiliate->setActive($faker->boolean);
            $affiliate->setEmail($faker->email);
            $affiliate->setToken($faker->sha256);
            $affiliate->setUrl($faker->url);
            $manager->persist($affiliate);
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

