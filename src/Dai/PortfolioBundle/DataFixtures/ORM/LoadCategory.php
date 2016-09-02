<?php
namespace Dai\PortfolioBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Dai\PortfolioBundle\Entity\Category;

class LoadCategory implements FixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $names = array(
            'Huile',
            'Crayon'            
            );

        foreach ($names as $name) {
            $category = new Category();
            $category->setName($name);

            $manager->persist($category);
        }

        $manager->flush();
    }
}
