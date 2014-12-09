<?php

namespace InstantSoin\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductsController extends Controller
{
    public function products_overallAction()
    {

        $search = $this->createFormBuilder()
                                ->add('recherche', 'search', array('label' => '', 'attr' => array('class' => 'productSearch')))
                                ->add('save', 'submit', array('label' => 'Rechercher','attr' => array('class' => 'productSearch')))
                                ->getForm();
                                
        return $this->render('ProductBundle:Products:Products_overall.html.twig', array('search' => $search->createView()));
    }


    public function products_cremesAction()
    {

        $search = $this->createFormBuilder()
                                ->add('recherche', 'search', array('label' => '', 'attr' => array('class' => 'productSearch')))
                                ->add('save', 'submit', array('label' => 'Rechercher','attr' => array('class' => 'productSearch')))
                                ->getForm();
                                
        return $this->render('ProductBundle:Products:Products_cremes.html.twig', array('search' => $search->createView()));
    }



    public function products_gommagesAction()
    {

        $search = $this->createFormBuilder()
                                ->add('recherche', 'search', array('label' => '', 'attr' => array('class' => 'productSearch')))
                                ->add('save', 'submit', array('label' => 'Rechercher','attr' => array('class' => 'productSearch')))
                                ->getForm();
                                
        return $this->render('ProductBundle:Products:Products_gommages.html.twig', array('search' => $search->createView()));
    }




    public function products_maquillageAction()
    {

        $search = $this->createFormBuilder()
                                ->add('recherche', 'search', array('label' => '', 'attr' => array('class' => 'productSearch')))
                                ->add('save', 'submit', array('label' => 'Rechercher','attr' => array('class' => 'productSearch')))
                                ->getForm();
                                
        return $this->render('ProductBundle:Products:Products_maquillage.html.twig', array('search' => $search->createView()));
    }



    public function products_lotionsAction()
    {

        $search = $this->createFormBuilder()
                                ->add('recherche', 'search', array('label' => '', 'attr' => array('class' => 'productSearch')))
                                ->add('save', 'submit', array('label' => 'Rechercher','attr' => array('class' => 'productSearch')))
                                ->getForm();
                                
        return $this->render('ProductBundle:Products:Products_lotions.html.twig', array('search' => $search->createView()));
    }



    public function products_parfumerieAction()
    {

        $search = $this->createFormBuilder()
                                ->add('recherche', 'search', array('label' => '', 'attr' => array('class' => 'productSearch')))
                                ->add('save', 'submit', array('label' => 'Rechercher','attr' => array('class' => 'productSearch')))
                                ->getForm();
                                
        return $this->render('ProductBundle:Products:Products_parfumerie.html.twig', array('search' => $search->createView()));
    }

}
