<?php

namespace ERP\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;

class InvProveedorType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', null, array(
                    'required'=>true,
                   'attr'=>array(
                    'class'=>'form-control proveedorTextBox'
                    )))
             ->add('direccion', null, array(
                    'required'=>true,
                   'attr'=>array(
                    'class'=>'form-control proveedorTextBox',
                     'label'=>'Direcciones'
                    )))
                

            ->add('crmIndustriaCliente','entity', array( 'label' => 'Industria cliente','required'=>false,
                         'empty_value'   => 'Seleccione una industria...',
                         'class'         => 'ERPAdminBundle:CtlIndustriaCliente',
                         'query_builder' => function(EntityRepository $repository) {
                                                return $repository->obtenerNombreActivo();
                                             },  
                         'attr'=>array(
                         'class'=>'form-control input-sm busqueda proveedorSelect'
                         )
                       ))     
                
                
                
        ;
    }
    
    
    
   


    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ERP\AdminBundle\Entity\InvProveedor'
        ));
    }
}
