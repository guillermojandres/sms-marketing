<?php

namespace ERP\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;

class CrmClienteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('tipo', null ,array('label'=>'Tipo'))
              ->add('tipo', 'choice', array(
                    'label'=> 'Tipo',
                    'choices'  => array('0' => 'Individual', '1' => 'Compañia'),
                    'multiple' => false,
                    'expanded'=>false   ))
                
                
            ->add('datosCliente', null ,array('label'=>'Direccion'))
            ->add('sitioWeb', null ,array('label'=>' Sitio Web '))
            ->add('nombreCompleto', null ,array('label'=>' Nombre completo '))
                
//            ->add('categoriaCliente', null ,array('label'=>' Categoria de cliente '))
                
                       
            ->add('categoriaCliente', null ,array('label'=>' Categoria de cliente '))
                  ->add('categoriaCliente','entity', array( 'label' => 'Categoria de cliente','required'=>true,
                         'empty_value'   => 'Seleccione una categoria del cliente...',
                         'class'         => 'ERPAdminBundle:CtlCategoriaCliente',
                         'query_builder' => function(EntityRepository $repository) {
                                                return $repository->obtenerNombreActivo();
                                             }, 
                         'attr'=>array(
                         'class'=>'form-control input-sm busqueda'
                         )
                       ))     
                
            ->add('clientePotencial', null ,array('label'=>' Desde cliente potencial '))
            
                
                
                
//            ->add('territorio', null ,array('label'=>' Territorio '))
                
             ->add('territorio','entity', array( 'label' => 'Territorio','required'=>false,
                         'empty_value'   => 'Seleccione un territorio...',
                         'class'         => 'ERPAdminBundle:CtlTerritorio',
                         'query_builder' => function(EntityRepository $repository) {
                                                return $repository->obtenerNombreActivo();
                                             }, 
                         'attr'=>array(
                         'class'=>'form-control input-sm busqueda'
                         )
                       ))     
                 ->add('porcentaje', null ,array('label'=>' Porcentaje Descuento'))   
               
              ->add('credito', 'choice', array(
                    'label'=> 'Acceso a credito',
                    'choices'  => array('0' => 'No ', '1' => ' Si '),
                    'multiple' => false,
                    'expanded'=>'true',
                  
                   
                 
                ))

                                                     
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ERP\AdminBundle\Entity\CrmCliente'
        ));
    }
}
