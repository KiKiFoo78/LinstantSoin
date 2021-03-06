<?php

namespace InstantSoin\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;

use InstantSoin\UserBundle\Entity\Enquiry;
use InstantSoin\UserBundle\Form\EnquiryType;
use InstantSoin\UserBundle\Entity\User;
use InstantSoin\UserBundle\Form\UserType;
use InstantSoin\ProductBundle\Entity\CategorieProd;
use InstantSoin\ProductBundle\Repository\CategorieProdRepository;
use InstantSoin\ProductBundle\Entity\CategorieServ;
use InstantSoin\ProductBundle\Repository\CategorieServRepository;


class SecurityController extends Controller
{
	/******************************************************************************************************************************
	 * CONNEXION USER
	 ******************************************************************************************************************************/
	public function loginAction(Request $request)
	{
		$search = $this->createFormBuilder()
                                ->add('recherche', 'search', array('label' => '', 'attr' => array('class' => 'livreSearch')))
                                ->add('save', 'submit', array('label' => 'Rechercher','attr' => array('class' => 'livreSearch')))
                                ->getForm();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieProd');
        $categoriesProd = $repository->findAllOrderedByName();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieServ');
        $categoriesServ = $repository->findAllOrderedByName();

		if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
			return $this->redirect($this->generateUrl('product_homepage'));
		}
		$session = $request->getSession();

		if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
			$error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
		} else {
			$error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
			$session->remove(SecurityContext::AUTHENTICATION_ERROR);
		}

		return $this->render('UserBundle:Security:login.html.twig', array(

			'last_username' => $session->get(SecurityContext::LAST_USERNAME),
			'error'         => $error,
			'search' => $search->createView(),
			'categoriesServ' => $categoriesServ,
			'categoriesProd' => $categoriesProd
			));


	}

	public function lastLogDate($token)
    {   
        $user = $token->getUser('lastLogin');
        $date = getdate();
        $user->setLastLogin($date);

        $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
        return true;
        //var_dump($user->getLastLogin());
        //die();
    }

	/******************************************************************************************************************************
	 * CREATION USER BY HIMSELF
	 ******************************************************************************************************************************/
	public function new_accountAction(Request $request){

		$search = $this->createFormBuilder()
                                ->add('recherche', 'search', array('label' => '', 'attr' => array('class' => 'productSearch')))
                                ->add('save', 'submit', array('label' => 'Rechercher','attr' => array('class' => 'productSearch')))
                                ->getForm();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieProd');
        $categoriesProd = $repository->findAllOrderedByName();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieServ');
        $categoriesServ = $repository->findAllOrderedByName();

		$session = $this->getRequest()->getSession();
		$user = new User();

		$form = $this->createFormBuilder($user)
					->add('nom', 'text', array('required' => true))
					->add('prenom', 'text', array('required' => true))
					->add('adresse1', 'text', array('required' => true))
					->add('adresse2', 'text', array('required' => false))
					->add('codepostal', 'number', array('required' => true))
					->add('ville', 'text', array('required' => true))
					->add('telephone', 'text', array('required' => true))
					->add('email', 'text', array('required' => true))
					->add('username', 'text', array(
							'required' => true,
							'read_only' => true,
						))
					->add('password', 'text', array(
							'required' => true,
							'read_only' => true,
						))
					->add('save', 'submit', array('label' => 'Enregistrer'))
					->getForm();

		$form->handleRequest($request);

	    if ($form->isValid()) {

	    		$factory = $this->get('security.encoder_factory');
	            $encoder = $factory->getEncoder($user);
	            $password = $encoder->encodePassword($form->get('password')->getData(), $user->getSalt());
	            $user->setPassword($password);
	            $role = 'ROLE_USER';
	            $user->setRoles($role);

				$username = $form->get('username')->getData();

	        	$em = $this->getDoctrine()->getManager();
				$em->persist($user);
				$em->flush();

				$this->get('session')->getFlashBag()->clear();
				$session->getFlashBag()->add('user_add_success', 'Votre compte a été correctement créé ! Vous pouvez dores et déjà vous connecter à votre espace.');
				$session->getFlashBag()->add('user_add_warning', 'Votre mot de passe est identique à votre nom d\'utilisateur : ' .$username. ' Veuillez le changer dans votre profil lors de votre première connexion');

				return $this->redirect($this->generateUrl('new_account'));
		}

		return $this->render('UserBundle:Security:new_account.html.twig',
			array(
			'search' => $search->createView(),
			'form' => $form->createView(),
			'categoriesServ' => $categoriesServ,
			'categoriesProd' => $categoriesProd
			));
	}


	/******************************************************************************************************************************
	 * CREATION USER BY ADMIN
	 ******************************************************************************************************************************/
	public function new_account_adminAction(Request $request){

        $session = $this->getRequest()->getSession();
		$user = new User();

		$form = $this->createFormBuilder($user)
					->add('nom', 'text', array('required' => true))
					->add('prenom', 'text', array('required' => true))
					->add('adresse1', 'text', array('required' => true))
					->add('adresse2', 'text', array('required' => false))
					->add('codepostal', 'number', array('required' => true))
					->add('ville', 'text', array('required' => true))
					->add('telephone', 'text', array('required' => true))
					->add('email', 'text', array('required' => true))
					->add('username', 'text', array(
							'required' => true,
							'read_only' => true,
						))
					->add('password', 'text', array(
							'required' => true,
							'read_only' => true,
						))
					->add('save', 'submit', array('label' => 'Enregistrer'))
					->getForm();

		$form->handleRequest($request);

	    if ($form->isValid()) {

	    		$factory = $this->get('security.encoder_factory');
	            $encoder = $factory->getEncoder($user);
	            $password = $encoder->encodePassword($form->get('password')->getData(), $user->getSalt());
	            $user->setPassword($password);
	            $role = 'ROLE_USER';
	            $user->setRoles($role);

				$username = $form->get('username')->getData();

	        	$em = $this->getDoctrine()->getManager();
				$em->persist($user);
				$em->flush();

				$this->get('session')->getFlashBag()->clear();
				$this->get('session')->getFlashBag()->add('user_add_success', 'Le compte a été correctement créé ! Le client peut dores et déjà se connecter à son espace.');
				$this->get('session')->getFlashBag()->add('user_add_warning', 'Le mot de passe est identique au nom d\'utilisateur : ' .$username. ' Veuillez le changer dans le profil lors de la première connexion');

				return $this->redirect($this->generateUrl('new_account_admin'));
		}

		$repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieProd');
        $categoriesProd = $repository->findAllOrderedByName();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieServ');
        $categoriesServ = $repository->findAllOrderedByName();

		return $this->render('UserBundle:Security:new_account_admin.html.twig',
			array(
			'form' => $form->createView(),
			'categoriesServ' => $categoriesServ,
			'categoriesProd' => $categoriesProd
			));
	}


	/******************************************************************************************************************************
	 * MODIFICATION USER BY HIMSELF
	 ******************************************************************************************************************************/

	public function profilAction()
    {
        $search = $this->createFormBuilder()
                                ->add('recherche', 'search', array('label' => '', 'attr' => array('class' => 'livreSearch')))
                                ->add('save', 'submit', array('label' => 'Rechercher','attr' => array('class' => 'livreSearch')))
                                ->getForm();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieProd');
        $categoriesProd = $repository->findAllOrderedByName();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieServ');
        $categoriesServ = $repository->findAllOrderedByName();
        
        $username = $this->get('security.context')->getToken()->getUsername();
		
        return $this->render('UserBundle:Security:profil.html.twig',
        	array(
        		'search' => $search->createView(),
        		'username' => $username,
				'categoriesServ' => $categoriesServ,
				'categoriesProd' => $categoriesProd
        		));
    }

    public function profil_infoAction($username, request $request)
    {
    	$search = $this->createFormBuilder()
                                ->add('recherche', 'search', array('label' => '', 'attr' => array('class' => 'livreSearch')))
                                ->add('save', 'submit', array('label' => 'Rechercher','attr' => array('class' => 'livreSearch')))
                                ->getForm();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieProd');
        $categoriesProd = $repository->findAllOrderedByName();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieServ');
        $categoriesServ = $repository->findAllOrderedByName();

		$session = $this->getRequest()->getSession();
		$this->get('session')->getFlashBag()->clear();

	    $em = $this->getDoctrine()->getManager();
	    $user = $em->getRepository('UserBundle:User')->findByUsername($username)[0];
	   	
	    $form = $this->createFormBuilder($user)
					    			->add('nom', 'text', array('required' => true))
									->add('prenom', 'text', array('required' => true))
									->add('adresse1', 'text', array('required' => true))
									->add('adresse2', 'text', array('required' => false))
									->add('codepostal', 'number', array('required' => true))
									->add('ville', 'text', array('required' => true))
									->add('telephone', 'text', array('required' => true))
									->add('email', 'text', array('required' => true))
									
									->add('password', 'repeated', array(
										    'type' => 'password',
										    'options' => array(
										    	'required' => true,
										    	'read_only' => false,
										    ),
										    'first_options'  => array('label' => 'Mot de passe'),
										    'invalid_message' => 'Les mots de passe doivent correspondre',
										    'second_options' => array('label' => 'Mot de passe (vérification)'),
										))
									->add('save', 'submit', array(
														'label' => 'Enregistrer',
												  'attr' => array(
												  		'class' => 'submit spacer'
											)
										))
									->getForm();

	    $form->handleRequest($request);

	    if ($form->isValid()) {
	    	
	    	$factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($user);
            $password = $encoder->encodePassword($form->get('password')->getData(), $user->getSalt());
            $user->setPassword($password);

        	$em = $this->getDoctrine()->getManager();
			$em->flush();

			$session->getFlashBag()->add('user_modif_success', 'Les données ont été mises à jour correctement.');

			return $this->redirect($this->generateUrl('profil_info', array('username' => $username)));
	    }
	    
    	return $this->render('UserBundle:Security:profil_info.html.twig',
    		array('search' => $search->createView(),
    			'form'=> $form->createView(),
    			'categoriesServ' => $categoriesServ,
				'categoriesProd' => $categoriesProd
        		));

    }

    /******************************************************************************************************************************
	 * MODIFICATION USER BY ADMIN
	 ******************************************************************************************************************************/

    public function updateCustomerAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('UserBundle:User')->findById($id)[0];

        $form = $this->createFormBuilder($user)
					    			->add('nom', 'text', array('required' => true,'label' => 'Entrez le nom du client :'))
									->add('prenom', 'text', array('required' => true,'label' => 'Entrez le prénom :'))
									->add('adresse1', 'text', array('required' => true,'label' => 'Entrez le champs adresse :'))
									->add('adresse2', 'text', array('required' => false,'label' => 'Entrez la suite de l\'adresse  :'))
									->add('codepostal', 'number', array('required' => true,'label' => 'Entrez le code postal :'))
									->add('ville', 'text', array('required' => true,'label' => 'Entrez la ville :'))
									->add('telephone', 'text', array('required' => true,'label' => 'Entrez le numéro de téléphone :'))
									->add('email', 'text', array('required' => true,'label' => 'Entrez l\'adresse email  :'))
									
									->add('password', 'repeated', array(
										    'type' => 'password',
										    'options' => array(
										    	'required' => true,
										    	'read_only' => false,
										    ),
										    'first_options'  => array('label' => 'Mot de passe'),
										    'invalid_message' => 'Les mots de passe doivent correspondre',
										    'second_options' => array('label' => 'Mot de passe (vérification)'),
										))
									->add('save', 'submit', array(
														'label' => 'Enregistrer',
												  'attr' => array(
												  		'class' => 'submit spacer'
											)
										))
									->getForm();

	    $form->handleRequest($request);

	    if ($form->isValid()) {
	    	
	    	$factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($user);
            $password = $encoder->encodePassword($form->get('password')->getData(), $user->getSalt());
            $user->setPassword($password);

        	$em = $this->getDoctrine()->getManager();
			$em->flush();

			$this->get('session')->getFlashBag()->clear();
			$this->get('session')->getFlashBag()->add('user_modif_success', 'Les données ont été mises à jour correctement.');

			return $this->redirect($this->generateUrl('updateCustomer', array('id' => $id)));
	    }

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieProd');
        $categoriesProd = $repository->findAllOrderedByName();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieServ');
        $categoriesServ = $repository->findAllOrderedByName();

	    return $this->render('UserBundle:Security:updateCustomer.html.twig',
            array(
                'form' => $form->createView(),
                'categoriesServ' => $categoriesServ,
                'categoriesProd' => $categoriesProd,
            ));
	}

    /******************************************************************************************************************************
	 * LISTING USER BY ADMIN
	 ******************************************************************************************************************************/

	public function listingCustomerAction()
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('UserBundle:User');
        $Users = $repository->findAllOrderedByName();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieProd');
        $categoriesProd = $repository->findAllOrderedByName();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieServ');
        $categoriesServ = $repository->findAllOrderedByName();

        return $this->render('UserBundle:Security:listingCustomer.html.twig',
            array(
                'users' => $Users,
                'categoriesServ' => $categoriesServ,
                'categoriesProd' => $categoriesProd,
            ));
    }


    /******************************************************************************************************************************
	 * ENVOI EMAIL CLIENT OU ANONYMOUS
	 ******************************************************************************************************************************/

	public function contactAction()
	{
		$search = $this->createFormBuilder()
            ->add('recherche', 'search', array('label' => '', 'attr' => array('class' => 'livreSearch')))
            ->add('save', 'submit', array('label' => 'Rechercher','attr' => array('class' => 'livreSearch')))
            ->getForm();

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
	                    ->setSubject('Demande de contact / de renseignements à partir du site L\'Instant Soin')
	                    ->setFrom('arnaud.hascoet@gmail.com')
	                    ->setTo($this->container->getParameter('InstantSoin.emails.contact_email'))
	                    ->setBody($this->renderView('UserBundle:Security:contactEmail.txt.twig', array('enquiry' => $enquiry)));
	                $this->get('mailer')->send($message);

	                $this->get('session')->getFlashBag()->clear();
	                $this->get('session')->getFlashBag()->add('contact-notice', 'Votre message a bien été envoyé. Merci !');
	        
	                return $this->redirect($this->generateUrl('Demande_contact'));
	            }
	        }

	        return $this->render('UserBundle:Security:contact.html.twig',
	        	array(
	        		'search' => $search->createView(),
	        		'form' => $form->createView(),
	        		'categoriesServ' => $categoriesServ,
					'categoriesProd' => $categoriesProd
	        		));
	    }
}