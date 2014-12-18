<?php

namespace InstantSoin\ProductBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use InstantSoin\ProductBundle\Entity\CategorieProd;
use InstantSoin\ProductBundle\Form\CategorieProdType;
use InstantSoin\ProductBundle\Repository\CategorieProdRepository;


class CategorieProdType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('intitule', 'text', array('required' => true, 'label' => 'Intitulé de la categorie produit :'))
            ->add('description', 'text', array('required' => true, 'label' => 'Description complète de la categorie produit :'))
            ->add('image', 'file', array('data_class' => null,'required' => false, 'label' => 'Image de la catégorie de produit :'))
            ->add('save', 'submit', array('label' => 'Enregistrer'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'InstantSoin\ProductBundle\Entity\CategorieProd'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'instantsoin_productbundle_categorieProd';
    }

}
