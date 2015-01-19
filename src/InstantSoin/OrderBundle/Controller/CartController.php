<?php

namespace InstantSoin\OrderBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\ORM\EntityRepository;

use InstantSoin\ProductBundle\Entity\CategorieProd;
use InstantSoin\ProductBundle\Entity\CategorieServ;


class CartController extends Controller
{
    public function cartAction(Request $request)
    {
        $session = $request->getSession();

        if (!$session->has('panier')) $session->set('panier', array());

        if (count($session->get('panier')) > 0)
        {
            $em = $this->getDoctrine()->getManager();
            $produits = $em->getRepository('ProductBundle:Produits')->findArray(array_keys($session->get('panier')));
        }
        else
        {
            $produits = array();
        }

        $search = $this->createFormBuilder()
                                ->add('recherche', 'search', array('label' => '', 'attr' => array('class' => 'productSearch')))
                                ->add('save', 'submit', array('label' => 'Rechercher','attr' => array('class' => 'productSearch')))
                                ->getForm();
        
        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieProd');
        $categoriesProd = $repository->findAllOrderedByName();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieServ');
        $categoriesServ = $repository->findAllOrderedByName();

        return $this->render('OrderBundle:Cart:cart.html.twig',
        	array(
        		'produits' => $produits,
        		'categoriesServ' => $categoriesServ,
                'categoriesProd' => $categoriesProd,
                'search' => $search->createView(),
        		'panier' => $session->get('panier')));
    }


    public function to_cartAction(Request $request)
    {
        $session = $request->getSession();

        if (!$session->has('panier')) $session->set('panier',array());
        $panier = $session->get('panier');
        
        $id = $request->get("id");
        $qte = $request->get("qte");

        $panier[$id] = $qte;
        $session->set('panier',$panier);
        
        return new Response("Votre panier a bien été mis à jour.");
    }


    public function del_prod_cartAction($id)
    {
        $session = $this->getRequest()->getSession();
        $panier = $session->get('panier');
        
        if (array_key_exists($id, $panier))
        {
            unset($panier[$id]);
            $session->set('panier',$panier);
            $this->get('session')->getFlashBag()->add('success','Article supprimé avec succès');
        }
        return $this->redirect($this->generateUrl('cart_view')); 
    }


    public function emptyCartAction(Request $request)
    {
        $session = $request->getSession();
        $action = $request->get("action");

        if ($action = "vider"){

            if ($session->has('panier')) $session->set('panier',array());

            return new Response("Votre panier a bien été vidé.");
        }
        return $this->redirect($this->generateUrl('cart_view'));
    }



}