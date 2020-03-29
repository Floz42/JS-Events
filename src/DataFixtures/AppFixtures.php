<?php

namespace App\DataFixtures;

use App\Entity\Delivery;
use App\Entity\ImageSlider;
use App\Entity\Introduce;
use App\Entity\IntroduceOwner;
use App\Entity\News;
use App\Entity\Rating;
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
        $introduce = new Introduce();
        $introduce->setPicture('logo2.png')
                  ->setContent($faker->sentence(45));
        $manager->persist($introduce);

        $introduceOwner = new IntroduceOwner();
        $introduceOwner->setFirstname('Cédric')
                       ->setLastname('Patry')
                       ->setPicture('avatar_cdric.jpg')
                       ->setDescription($faker->sentence(25));
        $manager->persist($introduceOwner);

        for($j=0;$j<20;$j++) {
            $number = mt_rand(0,1);
            $news = new News();
            $news->setTitle($faker->sentence(10))
                 ->setContent($faker->sentence(45));
            if ($number === 1) {
                $news->setPicture($faker->imageUrl(200,200));
            }
            $manager->persist($news);
        }

        for ($k=0;$k<=3;$k++) {
            $delivery = new Delivery();
            $delivery->setPicture($faker->imageUrl(250,100))
                     ->setTitle($faker->sentence(5))
                     ->setOptions([$faker->sentence(5), $faker->sentence(5), $faker->sentence(8)])
                     ->setPrice(mt_rand(300,600));
            $manager->persist($delivery);
        }

        for($l=0;$l<=15;$l++) {
            $rating = new Rating();
            $rate = mt_rand(0,5);
            $rating->setFirstname($faker->firstName())
                   ->setLastname($faker->lastName())
                   ->setRating($rate)
                   ->setComment($faker->sentence(25))
                   ->setEmail($faker->email());
            $manager->persist($rating);
        }

        $manager->flush();
    }
}
