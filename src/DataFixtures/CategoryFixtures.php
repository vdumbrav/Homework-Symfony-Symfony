<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class CategoryFixtures extends Fixture implements OrderedFixtureInterface
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
            $category = new Category();
            $category->setName($faker->word);

            $manager->persist($category);

//            $this->addReference('category', $category);

        }

        $manager->flush();


    }

    /**
     * @return int
     */
    public function getOrder(): int
    {
        return 1;
    }
}