<?php

namespace InstantSoin\CartBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\ORM\EntityRepository;

use InstantSoin\ProductBundle\Entity\CategorieProd;
use InstantSoin\ProductBundle\Repository\CategorieProdRepository;
use InstantSoin\ProductBundle\Entity\CategorieServ;
use InstantSoin\ProductBundle\Repository\CategorieServRepository;
use InstantSoin\ProductBundle\Entity\Produits;
use InstantSoin\ProductBundle\Repository\ProduitsRepository;
use InstantSoin\CartBundle\Entity\Cart;
use InstantSoin\CartBundle\Repository\CartRepository;

class CartController extends Controller
{

    public function show_cartAction(Request $request)
    {

        $search = $this->createFormBuilder()
                                ->add('recherche', 'search', array('label' => '', 'attr' => array('class' => 'productSearch')))
                                ->add('save', 'submit', array('label' => 'Rechercher','attr' => array('class' => 'productSearch')))
                                ->getForm();
        
        $session = $request->getSession();
        var_dump($session->get('caddie'));
        die();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieProd');
        $categoriesProd = $repository->findAllOrderedByName();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieServ');
        $categoriesServ = $repository->findAllOrderedByName();
        
        return $this->render('CartBundle:Cart:cart.html.twig',
            array(
                'search' => $search->createView(),
                'categoriesServ' => $categoriesServ,
                'categoriesProd' => $categoriesProd,
            ));
    }

    public function to_cartAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $actionMsg = "";

            //Recupération des données du user actif :
            //$user = $this->get('security.context')->getToken()->getUser();
                                                                                                    //$_SESSION['user'] = $user;

            //Recupération data du POST :
            $id = $request->get("id");
            $action = $request->get("action");
            //if ($action == 1) { $action = "ajouté."; }
            //else { $action = "supprimé."; }
                                                                                                    $_SESSION['id'] = $id;
                                                                                                    $_SESSION['action'] = $action;
            $session = $request->getSession();
            //$session->set('caddie' , array(array('idart' => $id, 'qtt' => 1)));
            $cad = $session->get('caddie');
            $cad[] = New Cart();
            $session->set('caddie' , $cad);

            //Recupération du caddie éventuellement sauvegardé par le user :
            //$repository = $this->getDoctrine()->getManager()->getRepository('CartBundle:Cart');
            //$caddies = $repository->findByUser($user);
                                                                                                    //$_SESSION['caddie'] = $caddie;
            switch ($action) {
                case '1':
                    if ( !($session->get($id)) ){
                        $session->set($id , 1);                       
                    }
                    else {
                        $qte = $session->get($id);
                        $qte++;
                        $session->set($id , $qte);
                    }
                    $session->set('action','Ajout');
                    break;

                case '2':
                    $qte = $session->get($id);
                    if ( $qte = 1 ){
                        $session->remove($id);
                    }
                    else{
                        $qte--;
                        $session->set($id , $qte);
                    }
                    $session->set('action','Suppression');
                    break;

                default:
                    # code...
                    break;
            }
            

            return new Response("Cet article a bien été ".$_SESSION['action']);
        }
        else
        {
            // rediriger vers même page
        }
    }

}
