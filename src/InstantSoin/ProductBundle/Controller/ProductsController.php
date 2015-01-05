<?php

namespace InstantSoin\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
                      
        return $this->render('ProductBundle:Products:Products_overall.html.twig',
            array(
                'search' => $search->createView(),
                'categoriesServ' => $categoriesServ,
                'categoriesProd' => $categoriesProd,
            ));
    }


    public function products_by_catAction($id, Request $Request)
    {        
        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:Produits');
        $products = $repository->findByCategorieProd($id);

        $search = $this->createFormBuilder()
                                ->add('recherche', 'search', array('label' => '', 'attr' => array('class' => 'productSearch')))
                                ->add('save', 'submit', array('label' => 'Rechercher','attr' => array('class' => 'productSearch')))
                                ->getForm();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieProd');
        $categoriesProd = $repository->findAllOrderedByName();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieServ');
        $categoriesServ = $repository->findAllOrderedByName();

        //var_dump($session);
        //die();
        if (!$products){

            $session = $this->getRequest()->getSession();
            $this->get('session')->getFlashBag()->clear();

            $session->getFlashBag()->add('user_add_warning', 'Nous sommes désolés mais aucun produit de cette catégorie n\'est n\'est disponible à la vente actuellement.');
            return $this->render('ProductBundle:Products:no_product.html.twig',
                array(
                    'search' => $search->createView(),
                    'categoriesServ' => $categoriesServ,
                    'categoriesProd' => $categoriesProd,
                ));
        }
        else {
        return $this->render('ProductBundle:Products:Products_by_cat.html.twig',
            array(
                'products' => $products,
                'search' => $search->createView(),
                'categoriesServ' => $categoriesServ,
                'categoriesProd' => $categoriesProd,
            ));
        }
    }


}
