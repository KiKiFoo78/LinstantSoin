<?php

namespace InstantSoin\ProductBundle\Repository;

use Doctrine\ORM\EntityRepository;


class CategorieProdRepository extends EntityRepository
{
	public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT intitule FROM ProductBundle:CategorieProd intitule ORDER BY intitule.intitule ASC'
            )
            ->getResult();
    }
}