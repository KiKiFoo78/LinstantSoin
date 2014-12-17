<?php

namespace InstantSoin\ProductBundle\Repository;

use Doctrine\ORM\EntityRepository;


class CategorieRepository extends EntityRepository
{
	public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT intitule FROM ProductBundle:Categorie intitule ORDER BY intitule.intitule ASC'
            )
            ->getResult();
    }
}