<?php

namespace App\DataFixtures;

use App\Entity\ImageSlider;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        for($i=0; $i<= 5; $i++) {
            $image = new ImageSlider();
            $image->setImage($faker->imageUrl(1000, 350));
            $manager->persist($image);
        }

        $manager->flush();
    }
}
