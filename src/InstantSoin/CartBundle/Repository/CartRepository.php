<?php

namespace InstantSoin\CartBundle\Repository;

use Doctrine\ORM\EntityRepository;


class CartRepository extends EntityRepository
{
	public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT user FROM ProductBundle:Cart user ORDER BY user.user ASC'
            )
            ->getResult();
    }
}