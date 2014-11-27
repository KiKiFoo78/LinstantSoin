<?php

namespace InstantSoin\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ServicesController extends Controller
{
    public function services_overallAction()
    {

    	$search = $this->createFormBuilder()
                                ->add('recherche', 'search', array('label' => '', 'attr' => array('class' => 'productSearch')))
                                ->add('save', 'submit', array('label' => 'Rechercher','attr' => array('class' => 'productSearch')))
                                ->getForm();
                                
        return $this->render('ProductBundle:Services:Services_overall.html.twig', array('search' => $search->createView()));
    }


    public function products_faceAction()
    {

    	$search = $this->createFormBuilder()
                                ->add('recherche', 'search', array('label' => '', 'attr' => array('class' => 'productSearch')))
                                ->add('save', 'submit', array('label' => 'Rechercher','attr' => array('class' => 'productSearch')))
                                ->getForm();
                                
        return $this->render('ProductBundle:Products:Services_face.html.twig', array('search' => $search->createView()));
    }


    public function products_bodyAction()
    {

    	$search = $this->createFormBuilder()
                                ->add('recherche', 'search', array('label' => '', 'attr' => array('class' => 'productSearch')))
                                ->add('save', 'submit', array('label' => 'Rechercher','attr' => array('class' => 'productSearch')))
                                ->getForm();
                                
        return $this->render('ProductBundle:Products:Services_body.html.twig', array('search' => $search->createView()));
    }


    public function products_soinAction()
    {

    	$search = $this->createFormBuilder()
                                ->add('recherche', 'search', array('label' => '', 'attr' => array('class' => 'productSearch')))
                                ->add('save', 'submit', array('label' => 'Rechercher','attr' => array('class' => 'productSearch')))
                                ->getForm();
                                
        return $this->render('ProductBundle:Products:Services_soin.html.twig', array('search' => $search->createView()));
    }


    public function products_forfaitsAction()
    {

    	$search = $this->createFormBuilder()
                                ->add('recherche', 'search', array('label' => '', 'attr' => array('class' => 'productSearch')))
                                ->add('save', 'submit', array('label' => 'Rechercher','attr' => array('class' => 'productSearch')))
                                ->getForm();
                                
        return $this->render('ProductBundle:Products:Services_forfaits.html.twig', array('search' => $search->createView()));
    }


    public function products_massagesAction()
    {

    	$search = $this->createFormBuilder()
                                ->add('recherche', 'search', array('label' => '', 'attr' => array('class' => 'productSearch')))
                                ->add('save', 'submit', array('label' => 'Rechercher','attr' => array('class' => 'productSearch')))
                                ->getForm();
                                
        return $this->render('ProductBundle:Products:Services_massages.html.twig', array('search' => $search->createView()));
    }


    public function products_peelingAction()
    {

    	$search = $this->createFormBuilder()
                                ->add('recherche', 'search', array('label' => '', 'attr' => array('class' => 'productSearch')))
                                ->add('save', 'submit', array('label' => 'Rechercher','attr' => array('class' => 'productSearch')))
                                ->getForm();
                                
        return $this->render('ProductBundle:Products:Services_peeling.html.twig', array('search' => $search->createView()));
    }
}
