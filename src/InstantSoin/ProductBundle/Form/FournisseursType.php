<?php

namespace InstantSoin\ProductBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FournisseursType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', 'text', array('required' => true, 'label' => 'Nom du fournisseur'))
            ->add('description', 'text', array('required' => true, 'label' => 'Description'))
            ->add('image', 'file', array('data_class' => null,'required' => false, 'label' => 'Image ou logo du fournisseur'))
            ->add('adresse1', 'text',  array('required' => true, 'label' => 'Adresse1'))
            ->add('adresse2', 'text', array('required' => false, 'label' => 'Adresse2'))
            ->add('adresse3', 'text', array('required' => false, 'label' => 'Adresse3'))
            ->add('code_postal', 'text', array('required' => true, 'label' => 'Code Postal'))
            ->add('ville', 'text', array('required' => true, 'label' => 'Ville'))
            ->add('contact', 'text', array('required' => true, 'label' => 'Personne à contacter'))
            ->add('telephone', 'text', array('required' => true, 'label' => 'Numéro de téléphone'))
            ->add('save', 'submit', array('label' => 'Enregistrer'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'InstantSoin\ProductBundle\Entity\Fournisseurs'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'instantsoin_productbundle_fournisseurs';
    }
}
