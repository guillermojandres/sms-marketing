<?php

namespace ERP\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;

class CrmContactoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', null ,array('label'=>'Nombre'))
            ->add('apellido', null ,array('label'=>'Apellidos'))
            ->add('telefono', null ,array('label'=>'Telefono'))
            ->add('emailId', null ,array('label'=>'Correo'))
            ->add('numeroMovil', null ,array('label'=>'Movil'))
            ->add('departamento', null ,array('label'=>'Departamento'))
            ->add('puesto', null ,array('label'=>'Puesto'))
                
//            ->add('contactoProveedorId', null ,array('label'=>'Proveedor'))
                
               ->add('contactoProveedorId','entity', array( 'label' => 'Proveedor','required'=>false,
                         'empty_value'   => 'Seleccione un proveedor...',
                         'class'         => 'ERPAdminBundle:InvProveedor',
                         'query_builder' => function(EntityRepository $repository) {
                                                return $repository->obtenerNombreActivo();
                                             },  
                         'attr'=>array(
                         'class'=>'form-control input-sm busqueda'
                         )
                       ))     
                
                   
                
                
                
            ->add('contactoClientePotencialId', null ,array('label'=>'Cliente Potencial'))
                                                     
                                                     
//            ->add('contactoClienteId', null ,array('label'=>'Cliente'))
             ->add('contactoClienteId','entity', array( 'label' => 'Cliente','required'=>false,
                         'empty_value'   => 'Seleccione un cliente...',
                         'class'         => 'ERPAdminBundle:CrmCliente',
                         'query_builder' => function(EntityRepository $repository) {
                                                return $repository->obtenerNombreActivo();
                                             },  
                         'attr'=>array(
                         'class'=>'form-control input-sm busqueda'
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
            'data_class' => 'ERP\AdminBundle\Entity\CrmContacto'
        ));
    }
}
