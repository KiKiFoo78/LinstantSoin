<?php

namespace InstantSoin\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use InstantSoin\UserBundle\Entity\User;


class LoadUser implements FixtureInterface
{
  public function load(ObjectManager $manager)
  {
    // Les noms d'utilisateurs à créer
    $listNames = array('Sandra');
    $listNames3 = array('Eva', 'Akemi');
    $listNames4 = array('Arnaud');

    foreach ($listNames as $name) {
      
      $user = new User;
      $user->setNom($name);
      $user->setPrenom($name);
      $user->setEmail('bibliotheque@afap.com');
      $user->setAdresse1('10 rue de mon cul');
      $user->setAdresse2('');
      $user->setCodepostal(75001);
      $user->setVille('Paris');
      $user->setTelephone(0100000000);
      $user->setUsername($name);
      $user->setPassword($name);
      $user->setSalt('');
      $user->setRoles('ROLE_ESTHETICIENNE');
      $manager->persist($user);
    }

    foreach ($listNames3 as $name) {
      $user = new User;
      $user->setNom($name);
      $user->setPrenom($name);
      $user->setEmail('bibliotheque@afap.com');
      $user->setAdresse1('10 rue de mon cul');
      $user->setAdresse2('');
      $user->setCodepostal(75001);
      $user->setVille('Paris');
      $user->setTelephone(0100000000);
      $user->setUsername($name);
      $user->setPassword($name);
      $user->setSalt('');
      $user->setRoles('ROLE_USER');
      $manager->persist($user);
    }
    foreach ($listNames4 as $name) {
      $user = new User;
      $user->setNom($name);
      $user->setPrenom($name);
      $user->setEmail('bibliotheque@afap.com');
      $user->setAdresse1('10 rue de mon cul');
      $user->setAdresse2('');
      $user->setCodepostal(75001);
      $user->setVille('Paris');
      $user->setTelephone(0100000000);
      $user->setUsername($name);
      $user->setPassword($name);
      $user->setSalt('');
      $user->setRoles('ROLE_ADMIN');
      $manager->persist($user);
    }

    $manager->flush();
  }
}