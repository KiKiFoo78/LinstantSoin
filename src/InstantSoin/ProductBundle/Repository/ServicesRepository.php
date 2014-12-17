<?php

namespace InstantSoin\ProductBundle\Repository;

use Doctrine\ORM\EntityRepository;


class ServicesRepository extends EntityRepository
{
	public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT libelle FROM ProductBundle:Services libelle ORDER BY libelle.libelle ASC'
            )
            ->getResult();
    }
}