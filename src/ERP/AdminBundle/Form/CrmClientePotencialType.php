<?php

namespace ERP\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;

class CrmClientePotencialType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', null ,array('label'=>'Nombre '))
            ->add('emailId', null ,array('label'=>'Correo '))
                
           
           ->add('siguienteFechaContacto', null,
                  array('label'  => 'Siguiente fecha de contacto ','required'=>false,
                        'widget' => 'single_text',
                        'attr'   => array('class' => 'form-control input-sm clientepotencialSelect'),
                        'format' => 'dd-MM-yyyy',
                       ))
                
                
                
                
            ->add('telefono', null ,array('label'=>' Telefono '))
            ->add('movil', null ,array('label'=>'Numero movil'))
            ->add('fax', null ,array('label'=>'Fax '))
            ->add('sitioWeb', null ,array('label'=>'Sitio web'))
                
                
//            ->add('estadoClientePotencial', null ,array('label'=>'Estado '))
                
                
             ->add('estadoClientePotencial','entity', array( 'label' => 'Estado','required'=>false,
                         'empty_value'   => 'Seleccione un estado...',
                         'class'         => 'ERPAdminBundle:CtlEstadoClientePotencial',
                         'query_builder' => function(EntityRepository $repository) {
                                                return $repository->obtenerNombreActivo();
                                             },  
                         'attr'=>array(
                         'class'=>'form-control input-sm busqueda'
                         )
                       ))     
                               
                
                
                ->add('industriaCliente','entity', array( 'label' => 'Industria cliente','required'=>false,
                         'empty_value'   => 'Seleccione una industria...',
                         'class'         => 'ERPAdminBundle:CtlIndustriaCliente',
                         'query_builder' => function(EntityRepository $repository) {
                                                return $repository->obtenerNombreActivo();
                                             },  
                         'attr'=>array(
                         'class'=>'form-control input-sm busqueda'
                         )
                       ))        

//            ->add('referenciaCliente', null ,array('label'=>'Referencia '))
                                                     
            ->add('referenciaCliente','entity', array( 'label' => ' Referencia ','required'=>false,
                         'empty_value'   => 'Seleccione un tipo de referencia...',
                         'class'         => 'ERPAdminBundle:CtlReferenciaCliente',
                         'query_builder' => function(EntityRepository $repository) {
                                                return $repository->obtenerNombreActivo();
                                             },  
                         'attr'=>array(
                         'class'=>'form-control input-sm busqueda'
                         )
                       ))                                                  
                                                     
                                                     
                                                     
                                                     
                                                     
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
                                                     
                                                     
                                                     
                                                     
            ->add('idUsuarioSiguienteContacto', null ,array('label'=>'Siguiente contacto por '))
            ->add('idUsuarioPropietario', null ,array('label'=>'Propietario de la iniciativa'))
                                                     
                                                     
                                                     
//            ->add('crmEmpresaCliente', null ,array('label'=>'Empresa del cliente'))
                 
                ->add('crmEmpresaCliente','entity', array( 'label' => 'Empresa del cliente','required'=>false,
                         'empty_value'   => 'Seleccionar Empresa del cliente...',
                         'class'         => 'ERPAdminBundle:CrmEmpresaCliente',
                         'query_builder' => function(EntityRepository $repository) {
                                                return $repository->obtenerNombreActivo();
                                             },  
                         'attr'=>array(
                         'class'=>'form-control input-sm busqueda'
                         )
                       ))        
                                       
                                                     
                                                     
                                                     
                                                     
                                                     
                                                     
                
//            ->add('sector_mercado',null, array('label'=>'Sector del mercado'))
            ->add('sector_mercado', 'choice', array(
                    'label'=> 'Sector del mercado',
                    'choices'  => array('0' => 'Ingreso Menor', '1' => 'Ingreso Medio','2' => 'Ingreso Superior'),
                    'multiple' => false,
                    'expanded'=>false
                   
                 
                ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ERP\AdminBundle\Entity\CrmClientePotencial'
        ));
    }
}
