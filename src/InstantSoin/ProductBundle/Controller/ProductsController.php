<?php

namespace InstantSoin\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;

use InstantSoin\ProductBundle\Entity\Produits;
use InstantSoin\ProductBundle\Form\ProduitsType;
use InstantSoin\ProductBundle\Repository\ProduitsRepository;

use InstantSoin\ProductBundle\Entity\CategorieProd;
use InstantSoin\ProductBundle\Repository\CategorieProdRepository;
use InstantSoin\ProductBundle\Entity\CategorieServ;
use InstantSoin\ProductBundle\Repository\CategorieServRepository;

class ProductsController extends Controller
{
    public function products_overallAction()
    {

        $search = $this->createFormBuilder()
                                ->add('recherche', 'search', array('label' => '', 'attr' => array('class' => 'productSearch')))
                                ->add('save', 'submit', array('label' => 'Rechercher','attr' => array('class' => 'productSearch')))
                                ->getForm();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieProd');
        $categoriesProd = $repository->findAllOrderedByName();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieServ');
        $categoriesServ = $repository->findAllOrderedByName();

        //var_dump($categoriesProd);
        //die();
                                
        return $this->render('ProductBundle:Products:Products_overall.html.twig', array('search' => $search->createView(), 'categoriesServ' => $categoriesServ, 'categoriesProd' => $categoriesProd));
    }


    public function productsAction($id, Request $Request)
    {

        $search = $this->createFormBuilder()
                                ->add('recherche', 'search', array('label' => '', 'attr' => array('class' => 'productSearch')))
                                ->add('save', 'submit', array('label' => 'Rechercher','attr' => array('class' => 'productSearch')))
                                ->getForm();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:Produits');
        $cremes = $repository->findByCategorieProd('15');

        return $this->render('ProductBundle:Products:Products_cremes.html.twig', array('cremes' => $cremes, 'search' => $search->createView()));
    }


}
