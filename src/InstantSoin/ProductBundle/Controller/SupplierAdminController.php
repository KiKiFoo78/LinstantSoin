<?php

namespace InstantSoin\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;

use InstantSoin\ProductBundle\Entity\Fournisseurs;
use InstantSoin\ProductBundle\Form\FournisseursType;


class SupplierAdminController extends Controller
{
    public function createSupplierAction(request $request)
    {
        $fournisseur = new Fournisseurs();

        $form = $this->createForm(new FournisseursType(), $fournisseur);

        $form->handleRequest($request);

        if($form->isValid()){

            $dir = 'bundles/InstantSoin/Images/Fournisseurs';
            $file = $form['image']->getData();

            $extension = $file->guessExtension();
                if (!$extension) {
                    $extension = 'jpeg';
                }
            $nomImage = $form['nom']->getData().rand(1, 99).'.'.$extension;

            $file->move($dir, $nomImage);

            $fournisseur->setUrlimage($dir.'/'.$nomImage);
            $fournisseur->setAltimage($fournisseur->getNom());

            $newFourn = $form->get('nom')->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($fournisseur);
            $em->flush();

            $this->get('session')->getFlashBag()->add('user_add_success', 'Le fournisseur "' .$newFourn. '" a bien été créé. Vous pouvez créer les produits associés.');

            return $this->redirect($this->generateUrl('createSupplier'));
        }

        return $this->render('ProductBundle:Suppliers:createSupplier.html.twig', array('form' => $form->createView()));
    }





    public function updateSupplierAction()
    {

    }





    public function deleteSupplierAction($nom, Request $request)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:Fournisseurs');
        $fournisseur = $repository->findByNom($nom)[0];

        $em = $this->getDoctrine()->getManager();
        $em->remove($fournisseur);
        $em->flush();



        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:Fournisseurs');
        $fournisseurs = $repository->findAllOrderedByName();

        return $this->render('ProductBundle:Suppliers:listingSuplier.html.twig', array('fournisseurs' => $fournisseurs));
    }





    public function listingSupplierAction()
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:Fournisseurs');
        $fournisseurs = $repository->findAllOrderedByName();

        $_SESSION['fournisseurs']=$fournisseurs;

        return $this->render('ProductBundle:Suppliers:listingSuplier.html.twig', array('fournisseurs' => $fournisseurs));
    }



}
