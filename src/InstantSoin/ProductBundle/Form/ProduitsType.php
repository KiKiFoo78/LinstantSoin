<?php

namespace InstantSoin\ProductBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use InstantSoin\ProductBundle\Entity\Categorie;
use InstantSoin\ProductBundle\Form\CategorieType;
use InstantSoin\ProductBundle\Repository\CategorieRepository;

use InstantSoin\ProductBundle\Entity\Fournisseurs;
use InstantSoin\ProductBundle\Form\FournisseursType;
use InstantSoin\ProductBundle\Repository\FournisseursRepository;

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
            ->add('image', 'file', array('required' => true, 'label' => 'Image du produit :'))
            ->add('stock', 'text', array('required' => true, 'label' => 'Stock actuel du produit :'))
            ->add('categorie', 'entity', array(
                            'class' => 'ProductBundle:Categorie',
                            'property' => 'intitule',
                            'query_builder' => function(CategorieRepository $er)
                            {
                            return $er->createQueryBuilder('Categorie');
                            },
                            'empty_value' => 'Sélectionnez la catégorie',
                            'required' => true,
                            'expanded' => false,
                            'multiple' => false,
                            'label' => 'Catégorie correspondante :',
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
