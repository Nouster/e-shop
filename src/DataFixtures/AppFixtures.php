<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
  private const NB_PRODUCT = 150;
  private const NB_CATEGORY = 5;

  public function load(ObjectManager $manager): void
  {
    $faker = Factory::create();

    for ($i = 0, $categories = []; $i < self::NB_CATEGORY; $i++) {
      $category = new Category();
      $category
        ->setName($faker->word());

      $categories[] = $category;

      $manager->persist($category);
    }
    $manager->flush();
    
    for ($i = 0; $i < self::NB_PRODUCT; $i++) {
      $product = new Product();
      $product
        ->setName($faker->realText(35))
        ->setDescription($faker->realText())
        ->setPrice($faker->randomFloat(2, 10, 99))
        ->setVisible($faker->boolean(80))
        ->setDiscount($faker->boolean())
        ->setCategory($faker->randomElement($categories));

      $manager->persist($product);
    }

    $manager->flush();
  }
}
