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

use InstantSoin\ProductBundle\Entity\Categorie;
use InstantSoin\ProductBundle\Form\CategorieType;

class CategoryAdminController extends Controller
{
    public function createCategoryAction(request $request)
    {
        $categorie = new Categorie();

        $form = $this->createForm(new CategorieType(), $categorie);

        $form->handleRequest($request);

        if($form->isValid()){

            $newCat = $form->get('intitule')->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();

            $this->get('session')->getFlashBag()->add('user_add_success', 'La catégorie "' .$newCat. '" a bien été créée. Vous pouvez créer les produits associés.');

            return $this->redirect($this->generateUrl('createCategory'));
        }

        return $this->render('ProductBundle:Category:createCategory.html.twig', array('form' => $form->createView()));
    }





    public function updateCategoryAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $categorie = $em->getRepository('ProductBundle:Categorie')->findById($id)[0];
        

        if (!$categorie) {
            $categorie = new Categorie();
        }

        $form = $this->createForm(new CategorieType(), $categorie);
        
        $form->handleRequest($request);

        if($form->isValid()){
            
            $updateCateg = $form->get('intitule')->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();

            $this->get('session')->getFlashBag()->add('user_add_success', 'La categorie "' .$updateCateg. '" a bien été mise à jour. Vous pouvez créer les produits associés.');

            return $this->redirect($this->generateUrl('listingCategory'));
        }

        return $this->render('ProductBundle:Category:updateCategory.html.twig', array('form' => $form->createView()));
    }





    public function deleteCategoryAction($id, Request $request)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:Categorie');
        $categorie = $repository->findById($id)[0];
        
        $nomCateg = $categorie->getIntitule();

        $em = $this->getDoctrine()->getManager();
        $em->remove($categorie);
        $em->flush();

        $this->get('session')->getFlashBag()->add('user_add_success', 'La categorie "' .$nomCateg. '" a bien été supprimée.');

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:Categorie');
        $categories = $repository->findAllOrderedByName();

        return $this->render('ProductBundle:Category:listingCategory.html.twig', array('categories' => $categories));
    }





    public function listingCategoryAction()
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:Categorie');
        $categories = $repository->findAllOrderedByName();

        $_SESSION['categories']=$categories;

        return $this->render('ProductBundle:Category:listingCategory.html.twig', array('categories' => $categories));
    }




}
