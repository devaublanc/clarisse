<?php
namespace Dai\PortfolioBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Dai\PortfolioBundle\Entity\Tag;

class LoadTag implements FixtureInterface
{
  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {
    // Liste des noms de catégorie à ajouter
    $names = array(
      'fresh',
      'Design',
      'web',
      'wear',
      'Darkness'
    );

    foreach ($names as $name) {
      // On crée la catégorie
      $tag = new Tag();
      $tag->setName($name);

      // On la persiste
      $manager->persist($tag);
    }

    // On déclenche l'enregistrement de toutes les catégories
    $manager->flush();
  }
}