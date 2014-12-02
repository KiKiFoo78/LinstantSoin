<?php


namespace InstantSoin\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;

use InstantSoin\UserBundle\Entity\User;


class EstheticienneController extends Controller
{
	
	public function estheticienneAction()
	{
        
		return $this->render('UserBundle:Estheticienne:Estheticienne.html.twig');
	}


	public function sidebar_estheticienneAction() {
       
        return $this->render('UserBundle:Estheticienne:sidebar_estheticienne.html.twig');
    }

}