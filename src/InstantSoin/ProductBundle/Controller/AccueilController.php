<?php

namespace InstantSoin\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;

use InstantSoin\ProductBundle\Entity\CategorieProd;
use InstantSoin\ProductBundle\Repository\CategorieProdRepository;
use InstantSoin\ProductBundle\Entity\CategorieServ;
use InstantSoin\ProductBundle\Repository\CategorieServRepository;

class AccueilController extends Controller
{
    public function accueilAction()
    {

    	$search = $this->createFormBuilder()
                                ->add('recherche', 'search', array('label' => '', 'attr' => array('class' => 'productSearch')))
                                ->add('save', 'submit', array('label' => 'Rechercher','attr' => array('class' => 'productSearch')))
                                ->getForm();


        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieProd');
        $categoriesProd = $repository->findAllOrderedByName();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieServ');
        $categoriesServ = $repository->findAllOrderedByName();
                                
        return $this->render('ProductBundle:Accueil:accueil.html.twig',
            array(
                'search' => $search->createView(),
                'categoriesServ' => $categoriesServ,
                'categoriesProd' => $categoriesProd,
            ));
    }

    public function sidebarAction() {
       
        return $this->render('ProductBundle:Accueil:sidebar.html.twig');
    }

    public function whoswhoAction() {

        $search = $this->createFormBuilder()
                                ->add('recherche', 'search', array('label' => '', 'attr' => array('class' => 'productSearch')))
                                ->add('save', 'submit', array('label' => 'Rechercher','attr' => array('class' => 'productSearch')))
                                ->getForm();
       
        return $this->render('ProductBundle:Accueil:whoswho.html.twig',
            array(
                'search' => $search->createView()
            ));
    }


    public function clairjoieAction() {
       
        return $this->redirect('http://www.clairjoie.com');
    }

    public function cnd_shellacAction() {
       
        return $this->redirect('http://www.cnd.com');
    }


    public function contactAction() {

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieProd');
        $categoriesProd = $repository->findAllOrderedByName();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieServ');
        $categoriesServ = $repository->findAllOrderedByName();
        
        $enquiry = new Enquiry();
        $form = $this->createForm(new EnquiryType(), $enquiry);

        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {
                $message = \Swift_Message::newInstance()
                    ->setSubject('Demande de contact d\'un prospect')
                    ->setFrom('arnaud.hascoet@gmail.com')
                    ->setTo($this->container->getParameter('ProductBundle.emails.contact_email'))
                    ->setBody($this->renderView('ProductBundle:Accueil:contactEmail.txt.twig', array('enquiry' => $enquiry)));
                $this->get('mailer')->send($message);
        
                $this->get('session')->getFlashBag()->add('msg-notice', 'Votre message a bien été envoyé, Merci !');
        
                return $this->redirect($this->generateUrl('Demande_contact'));
            }
        }

        return $this->render('BloggerBlogBundle:Accueil:contact.html.twig',
            array(
                'form' => $form->createView(),
                'categoriesServ' => $categoriesServ,
                'categoriesProd' => $categoriesProd,
            ));
    }




}
