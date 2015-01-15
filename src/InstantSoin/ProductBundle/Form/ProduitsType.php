<?php

namespace InstantSoin\ProductBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use InstantSoin\ProductBundle\Entity\CategorieProd;
use InstantSoin\ProductBundle\Form\CategorieProdType;
use InstantSoin\ProductBundle\Repository\CategorieProdRepository;

use InstantSoin\ProductBundle\Entity\Fournisseurs;
use InstantSoin\ProductBundle\Form\FournisseursType;
use InstantSoin\ProductBundle\Repository\FournisseursRepository;

use InstantSoin\ProductBundle\Entity\Tva;
use InstantSoin\ProductBundle\Repository\TvaRepository;

class ProduitsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('reference', 'text', array('required' => true, 'label' => 'Référence du produit :'))
            ->add('designation', 'text', array('required' => true, 'label' => 'Désignation du produit :'))
            ->add('description', 'text', array('required' => true, 'label' => 'Description complète du produit :'))
            ->add('image', 'file', array('data_class' => null,'required' => false, 'label' => 'Image du produit :'))
            ->add('prix', 'money', array('required' => true, 'label' => 'Prix actuel du produit :'))
            ->add('tva', 'entity', array(
                            'class' => 'ProductBundle:Tva',
                            'property' => 'nom',
                            'query_builder' => function(TvaRepository $er)
                            {
                            return $er->createQueryBuilder('Tva');
                            },
                            'empty_value' => 'Sélectionnez la TVA à appliquer',
                            'required' => true,
                            'expanded' => false,
                            'multiple' => false,
                            'label' => 'TVA à appliquer :',
                        ))
            ->add('nouveaute', 'checkbox', array('required' => false, 'label' => 'Afficher comme nouveauté :'))
            ->add('stock', 'text', array('required' => true, 'label' => 'Stock actuel du produit :'))
            ->add('categorieProd', 'entity', array(
                            'class' => 'ProductBundle:CategorieProd',
                            'property' => 'intitule',
                            'query_builder' => function(CategorieProdRepository $er)
                            {
                            return $er->createQueryBuilder('CategorieProd');
                            },
                            'empty_value' => 'Sélectionnez la catégorie de produit',
                            'required' => true,
                            'expanded' => false,
                            'multiple' => false,
                            'label' => 'Catégorie produit correspondante :',
                        ))
            ->add('fournisseurs', 'entity', array(
                            'class' => 'ProductBundle:Fournisseurs',
                            'property' => 'nom',
                            'query_builder' => function(FournisseursRepository $er)
                            {
                            return $er->createQueryBuilder('Fournisseurs');
                            },
                            'empty_value' => 'Sélectionnez le fournisseur',
                            'required' => true,
                            'expanded' => false,
                            'multiple' => false,
                            'label' => 'Fournisseur correspondant :',
                        ))
            ->add('save', 'submit', array('label' => 'Enregistrer'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'InstantSoin\ProductBundle\Entity\Produits'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'instantsoin_productbundle_produits';
    }
}
