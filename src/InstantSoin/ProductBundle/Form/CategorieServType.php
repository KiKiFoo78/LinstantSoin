<?php

namespace InstantSoin\ProductBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use InstantSoin\ProductBundle\Entity\CategorieServ;
use InstantSoin\ProductBundle\Form\CategorieServType;
use InstantSoin\ProductBundle\Repository\CategorieServRepository;


class CategorieServType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('intitule', 'text', array('required' => true, 'label' => 'Intitulé de la categorie de service :'))
            ->add('description', 'textarea', array('required' => true, 'label' => 'Description complète de la categorie de service :'))
            ->add('image', 'file', array('data_class' => null,'required' => false, 'label' => 'Image de la catégorie de service :'))
            ->add('save', 'submit', array('label' => 'Enregistrer'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'InstantSoin\ProductBundle\Entity\CategorieServ'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'instantsoin_productbundle_categorieServ';
    }
}
