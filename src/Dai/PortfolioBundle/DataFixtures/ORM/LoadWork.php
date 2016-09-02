<?php
namespace Dai\PortfolioBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Dai\PortfolioBundle\Entity\Work;
use Dai\PortfolioBundle\Entity\Image;

class LoadWork implements FixtureInterface
{
    // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
    public function load(ObjectManager $manager)
    {
        //work1
        $work1 = new Work();
        $work1->setTitle('Work title 1');
        $work1->setWidth('200');
        $work1->setheight('200');
        $work1->setDescription('Work description 1');
        $work1->setPosition(1);

        $image1 = new Image();
        $image1->setUrl('image1.png');
        $image1->setAlt('alt image 1');

        $work1->setImage($image1);

        //work2
        $work2 = new Work();
        $work2->setTitle('Work title 2');
        $work2->setWidth('200');
        $work2->setheight('200');
        $work2->setDescription('Work description 2');
        $work2->setPosition(2);

        $image2 = new Image();
        $image2->setUrl('image2.png');
        $image2->setAlt('alt image 2');
        $work2->setImage($image2);

        //work3
        $work3 = new Work();
        $work3->setTitle('Work title 3');
        $work3->setWidth('200');
        $work3->setheight('200');
        $work3->setDescription('Work description 3');
        $work3->setPosition(3);

        $image3 = new Image();
        $image3->setUrl('image3.png');
        $image3->setAlt('alt image 3');

        $work3->setImage($image3);

        // On la persiste
        $manager->persist($work1);
        $manager->persist($work2);
        $manager->persist($work3);

        // On déclenche l'enregistrement de toutes les catégories
        $manager->flush();
    }
}
