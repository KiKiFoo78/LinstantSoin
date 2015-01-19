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

use InstantSoin\ProductBundle\Entity\CategorieServ;
use InstantSoin\ProductBundle\Form\CategorieServType;
use InstantSoin\ProductBundle\Repository\CategorieServRepository;
use InstantSoin\ProductBundle\Entity\CategorieProd;
use InstantSoin\ProductBundle\Repository\CategorieProdRepository;


class CategoryServAdminController extends Controller
{
    public function createCategoryServAction(request $request)
    {
        $categorieServ = new CategorieServ();

        $form = $this->createForm(new CategorieServType(), $categorieServ);

        $form->handleRequest($request);

        if($form->isValid()){

            $file = $form['image']->getData();

            if ($file) {
            $dir = 'bundles/InstantSoin/Images/CategorieServ';

            $extension = $file->guessExtension();
                if (!$extension) {
                    $extension = 'jpeg';
                }

            $nom = $form->get('intitule')->getData();

            $temp = $this->stripAccents($nom);

            $nomImage = $temp.'.'.$extension;

            $file->move($dir, $nomImage);

            $categorieServ->setUrlimage($dir.'/'.$nomImage);
            $categorieServ->setAltimage($categorieServ->getIntitule());
            }

            $newCatServ = $form->get('intitule')->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($categorieServ);
            $em->flush();

            $this->get('session')->getFlashBag()->clear();
            $this->get('session')->getFlashBag()->add('user_add_success', 'La catégorie "' .$newCatServ. '" a bien été créée. Vous pouvez créer les services associés.');

            return $this->redirect($this->generateUrl('createCategoryServ'));
        }

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieProd');
        $categoriesProd = $repository->findAllOrderedByName();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieServ');
        $categoriesServ = $repository->findAllOrderedByName();

        return $this->render('ProductBundle:Category:createCategoryServ.html.twig',
            array(
                'form' => $form->createView(),
                'categoriesServ' => $categoriesServ,
                'categoriesProd' => $categoriesProd,
            ));
    }





    public function updateCategoryServAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $categorieServ = $em->getRepository('ProductBundle:CategorieServ')->findById($id)[0];
        

        if (!$categorieServ) {
            $categorieServ = new CategorieServ();
        }

        $form = $this->createForm(new CategorieServType(), $categorieServ);
        
        $image = $categorieServ->getUrlimage();

        $form->handleRequest($request);

        if($form->isValid()){
            
            $file = $form['image']->getData();

            if ($file) {
            $dir = 'bundles/InstantSoin/Images/CategorieServ';

            $extension = $file->guessExtension();
                if (!$extension) {
                    $extension = 'jpeg';
                }

            $nom = $form->get('intitule')->getData();

            $temp = $this->stripAccents($nom);

            $nomImage = $temp.'.'.$extension;

            $file->move($dir, $nomImage);

            $categorieServ->setUrlimage($dir.'/'.$nomImage);
            $categorieServ->setAltimage($categorieServ->getIntitule());
            }

            $updateCategServ = $form->get('intitule')->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($categorieServ);
            $em->flush();

            $this->get('session')->getFlashBag()->clear();
            $this->get('session')->getFlashBag()->add('user_add_success', 'La categorie "' .$updateCategServ. '" a bien été mise à jour. Vous pouvez créer les services associés.');

            return $this->redirect($this->generateUrl('listingCategoryServ'));
        }

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieProd');
        $categoriesProd = $repository->findAllOrderedByName();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieServ');
        $categoriesServ = $repository->findAllOrderedByName();

        return $this->render('ProductBundle:Category:updateCategoryServ.html.twig',
            array(
                'form' => $form->createView(),
                'image' => $image,
                'categoriesServ' => $categoriesServ,
                'categoriesProd' => $categoriesProd,
            ));
    }





    public function deleteCategoryServAction($id, Request $request)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieServ');
        $categorieServ = $repository->findById($id)[0];
        
        $nomCategServ = $categorieServ->getIntitule();

        $em = $this->getDoctrine()->getManager();
        $em->remove($categorieServ);
        $em->flush();

        $this->get('session')->getFlashBag()->clear();
        $this->get('session')->getFlashBag()->add('user_add_success', 'La categorie "' .$nomCategServ. '" a bien été supprimée.');

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieServ');
        $categoriesServ = $repository->findAllOrderedByName();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieProd');
        $categoriesProd = $repository->findAllOrderedByName();

        return $this->render('ProductBundle:Category:listingCategoryServ.html.twig',
            array(
                'categoriesServ' => $categoriesServ,
                'categoriesProd' => $categoriesProd,
            ));
    }


    

    public function listingCategoryServAction()
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieServ');
        $categoriesServ = $repository->findAllOrderedByName();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieProd');
        $categoriesProd = $repository->findAllOrderedByName();

        return $this->render('ProductBundle:Category:listingCategoryServ.html.twig',
            array(
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
                case '®':
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