<?php

namespace InstantSoin\ProductBundle\Repository;

use Doctrine\ORM\EntityRepository;


class ProduitsRepository extends EntityRepository
{
	public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT designation FROM ProductBundle:Produits designation ORDER BY designation.designation ASC'
            )
            ->getResult();
    }
}