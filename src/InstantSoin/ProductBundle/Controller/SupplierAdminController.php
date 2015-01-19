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
use InstantSoin\ProductBundle\Repository\FournisseursRepository;
use InstantSoin\ProductBundle\Form\FournisseursType;
use InstantSoin\ProductBundle\Entity\CategorieProd;
use InstantSoin\ProductBundle\Repository\CategorieProdRepository;
use InstantSoin\ProductBundle\Entity\CategorieServ;
use InstantSoin\ProductBundle\Repository\CategorieServRepository;


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

            $nom = $form->get('nom')->getData();

            $temp = $this->stripAccents($nom);

            $nomImage = $temp.'.'.$extension;

            $file->move($dir, $nomImage);

            $fournisseur->setUrlimage($dir.'/'.$nomImage);
            $fournisseur->setAltimage($fournisseur->getNom());

            $newFourn = $form->get('nom')->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($fournisseur);
            $em->flush();

            $this->get('session')->getFlashBag()->clear();
            $this->get('session')->getFlashBag()->add('user_add_success', 'Le fournisseur "' .$newFourn. '" a bien été créé. Vous pouvez créer les produits associés.');

            return $this->redirect($this->generateUrl('createSupplier'));
        }

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieProd');
        $categoriesProd = $repository->findAllOrderedByName();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieServ');
        $categoriesServ = $repository->findAllOrderedByName();

        return $this->render('ProductBundle:Suppliers:createSupplier.html.twig',
            array(
                'form' => $form->createView(),
                'categoriesServ' => $categoriesServ,
                'categoriesProd' => $categoriesProd,
            ));
    }





    public function updateSupplierAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $fournisseur = $em->getRepository('ProductBundle:Fournisseurs')->findById($id)[0];
        

        if (!$fournisseur) {
            $fournisseur = new Fournisseurs();
        }

        $form = $this->createForm(new FournisseursType(), $fournisseur);
        
        $image = $fournisseur->getUrlimage();

        $form->handleRequest($request);

        if($form->isValid()){
            
            $file = $form['image']->getData();

            if ($file) {
            $dir = 'bundles/InstantSoin/Images/Fournisseurs';

            $extension = $file->guessExtension();
                if (!$extension) {
                    $extension = 'jpeg';
                }

            $nom = $form->get('nom')->getData();

            $temp = $this->stripAccents($nom);

            $nomImage = $temp.'.'.$extension;

            $file->move($dir, $nomImage);

            $fournisseur->setUrlimage($dir.'/'.$nomImage);
            $fournisseur->setAltimage($fournisseur->getNom());

            }

            $updateFourn = $form->get('nom')->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($fournisseur);
            $em->flush();

            $this->get('session')->getFlashBag()->clear();
            $this->get('session')->getFlashBag()->add('user_add_success', 'Le fournisseur "' .$updateFourn. '" a bien été mis à jour. Vous pouvez créer les produits associés.');

            return $this->redirect($this->generateUrl('listingSupplier'));
        }
        
        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieProd');
        $categoriesProd = $repository->findAllOrderedByName();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieServ');
        $categoriesServ = $repository->findAllOrderedByName();

        return $this->render('ProductBundle:Suppliers:updateSuplier.html.twig',
            array(
                'form' => $form->createView(),
                'image' => $image,
                'categoriesServ' => $categoriesServ,
                'categoriesProd' => $categoriesProd,
            ));
    }





    public function deleteSupplierAction($id, Request $request)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:Fournisseurs');
        $fournisseur = $repository->findById($id)[0];
        
        $em = $this->getDoctrine()->getManager();
        $em->remove($fournisseur);
        $em->flush();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:Fournisseurs');
        $fournisseurs = $repository->findAllOrderedByName();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieProd');
        $categoriesProd = $repository->findAllOrderedByName();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieServ');
        $categoriesServ = $repository->findAllOrderedByName();

        return $this->render('ProductBundle:Suppliers:listingSuplier.html.twig',
            array(
                'fournisseurs' => $fournisseurs,
                'categoriesServ' => $categoriesServ,
                'categoriesProd' => $categoriesProd,
            ));
    }





    public function listingSupplierAction()
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:Fournisseurs');
        $fournisseurs = $repository->findAllOrderedByName();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieProd');
        $categoriesProd = $repository->findAllOrderedByName();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieServ');
        $categoriesServ = $repository->findAllOrderedByName();

        return $this->render('ProductBundle:Suppliers:listingSuplier.html.twig',
            array(
                'fournisseurs' => $fournisseurs,
                'categoriesServ' => $categoriesServ,
                'categoriesProd' => $categoriesProd,
            ));
    }

    private function stripAccents($nom){
        $replace = array('e','e','e','a','o','e','e','a','a','u','u','r');
        $search = array('é','è','ê','à','ô','É','È','À','Â','ù','Ù','®');

        $nom = str_replace($search,$replace,$nom);
       
        $newChaine = "";
        $i = 0;
        $long = strlen($nom);

        for($idx=0; $idx<$long; $idx++){
            $car = $nom[$idx];

            switch ($car) {
                case ' ':
                    break;
                case '/':
                    $newChaine[$i] = '_';
                    $i++;
                    break;
                case '-':
                    $newChaine[$i] = '-';
                    $i++;
                    break;
                
                default:
                    $newChaine[$i] = $nom[$idx];
                    $i++;
                    break;
            }
        }
        return implode($newChaine);
    }


}
