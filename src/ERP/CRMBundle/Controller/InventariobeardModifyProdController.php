<?php

namespace ERP\CRMBundle\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ERP\AdminBundle\Entity\BeardProducto;
use ERP\AdminBundle\Entity\BeardAtributoProducto;
use ERP\AdminBundle\Entity\BeardImagenProducto;
use ERP\AdminBundle\Entity\CtlSubCategoriaProducto;

/**
 * Modify Producto controller.
 *
 * @Route("/admin/inventariobeardmodifyprod")
 */
class InventariobeardModifyProdController extends Controller
{
    /**
     * Lists all InvProveedor entities.
     *
     * @Route("/modifyprod", name="inventariobeard_modifyprod")
     *
     */  
    public function indexAction()
    {
        $idprod = 171;
        
        //Recuperando datos del producto
        $em = $this->getDoctrine()->getManager();
        $dql = "SELECT prod.id as idproducto, prod.nombre as nombre, prod.precio as precio, prod.numeroReferencia as numref, prod.estado as estado, prod.descripcion as descrip, "
                . "prod.link as link, prod.ingrediente as ingre, prod.presentacion as pres, prod.stock as stock, catprod.id as idc, catprod.nombreCategoria as nomcat,"
                . "subcatprod.id as idsc, subcatprod.nombreSubCategoria as nomscat "
                . "FROM ERPAdminBundle:BeardProducto prod "
                . "JOIN prod.idSubCategoriaProducto subcatprod "
                . "JOIN subcatprod.idCategoria catprod "                
                . "WHERE prod.id =:idprod";
        $producto = $em->createQuery($dql)
                ->setParameter('idprod', $idprod)
                ->getSingleResult();
        
        //Recuperando las imagenes relacionadas al producto
        $em = $this->getDoctrine()->getManager();
        $dql = "SELECT imgpro.imagen1 as img1, imgpro.imagen2 as img2, imgpro.imagen3 as img3, imgpro.imagen4 as img4, imgpro.imagen5 as img5 "                
                . "FROM ERPAdminBundle:BeardImagenProducto imgpro "
                . "JOIN imgpro.idProducto prod "                
                . "WHERE imgpro.idProducto =:idprod";
        $imgprod = $em->createQuery($dql)
                ->setParameter('idprod', $idprod)
                ->getResult();
        
        //Recuperando las imagenes relacionadas al producto
        $em = $this->getDoctrine()->getManager();
        $dql = "SELECT attrib.nombre as nombre, attrib.porcentaje as porcentaje "
                . "FROM ERPAdminBundle:BeardAtributoProducto attrib "
                . "JOIN attrib.idProducto prod "
                . "WHERE attrib.idProducto =:idprod";
        $atributos = $em->createQuery($dql)
                ->setParameter('idprod', $idprod)
                ->getResult();
                       
        $cats = $em->getRepository('ERPAdminBundle:CtlCategoriaProducto')->findAll();
        //$scats = $em->getRepository('ERPAdminBundle:CtlSubCategoriaProducto')->findBy(array('idCategoria'=>$cats));
//        var_dump($scats);
//        die();
        
        return $this->render('ERPCRMBundle:inventariobeard:modifyprod.html.twig', array('producto'=>$producto, 'imagen'=>$imgprod, 'atributos'=>$atributos, 'cats'=>$cats));
    }         
    
    /**
     * Insertar los valores modificados de producto
     *
     * @Route("/modins", name="inventariobeard_modifyinsert")
     * @Method({"POST","GET"})
     */
    public function modifyinsertAction(Request $request) {
    
        $em = $this->getDoctrine()->getManager();
        $parameters = $request->request->all();   
        $idpro = $parameters['idpro'];
        $producto = $em->getRepository('ERPAdminBundle:BeardProducto')->find($idpro);
                
        if(isset($parameters['subcategoria'])){
        $subca = $em->getRepository('ERPAdminBundle:CtlSubCategoriaProducto')->find($parameters['subcategoria']);
                
        $producto->setSubCategoriaProducto($subca);
        
        }
                                                
        $producto->setNombre($parameters['nombreprod']);
        $producto->setNumeroReferencia($parameters['codigo']);
        $producto->setPrecio($parameters['precio']);
        $producto->setLink($parameters['link']);
        $producto->setPresentacion($parameters['presentacion']);
        $producto->setStock($parameters['stock']);
        $producto->setDescripcion($parameters['descripcion']);        
        $producto->setIngrediente($parameters['ingrediente']);
                
        $em->merge($producto);
        $em->flush();
        
        //eliminando los atributos
        $atributos = $em->getRepository('ERPAdminBundle:BeardAtributoProducto')->findby(array('idProducto'=>$idpro));        
        foreach ( $atributos as $row){
            $em->remove($row);
            $em->flush();
        }
        
        $atri = $parameters['atributo'];
        $por = $parameters['porcentaje'];
        
        //Ingresando los nuevos atributos
        $n = count($atri);
        for ($i=1 ; $i<$n ; $i++){
           $atribu = new BeardAtributoProducto();
           $atribu->setNombre($atri[$i]);
           $atribu->setPorcentaje($por[$i]);
           $atribu->setIdProducto($producto);
           $em->persist($atribu);
           $em->flush();
        }
                
        if($_FILES){
           
           $fotoproducto = $em->getRepository('ERPAdminBundle:BeardImagenProducto')->findOneBy(array('idProducto'=>$idpro)); 
           $path = $this->container->getParameter('photo.producto');

            $fecha = date('Y-m-d-His');
            //$extension = $entity->getFile()->getClientOriginalExtension();
            $nombreArchivo1 = "producto_" . $fecha . "_" . $_FILES['userfile']['name'];
            $nombreArchivo2 = "producto_" . $fecha . "_" . $_FILES['userfile2']['name'];
            $nombreArchivo3 = "producto_" . $fecha . "_" . $_FILES['userfile3']['name'];
            $nombreArchivo4 = "producto_" . $fecha . "_" . $_FILES['userfile4']['name'];
            $nombreArchivo5 = "producto_" . $fecha . "_" . $_FILES['userfile5']['name'];

            //Primero se verifica si el archivo se subio al servidor y luego se guarda en la BD
            
            if (move_uploaded_file($_FILES['userfile']['tmp_name'], $path . $nombreArchivo1)) {
                $fotoproducto->setImagen1($nombreArchivo1);
            }
            if (move_uploaded_file($_FILES['userfile2']['tmp_name'], $path . $nombreArchivo2)) {
                $fotoproducto->setImagen2($nombreArchivo2);
            }
            if (move_uploaded_file($_FILES['userfile3']['tmp_name'], $path . $nombreArchivo3)) {
                $fotoproducto->setImagen3($nombreArchivo3);
            }
            if (move_uploaded_file($_FILES['userfile4']['tmp_name'], $path . $nombreArchivo4)) {
                $fotoproducto->setImagen4($nombreArchivo4);
            }
            if (move_uploaded_file($_FILES['userfile5']['tmp_name'], $path . $nombreArchivo5)) {
                $fotoproducto->setImagen5($nombreArchivo5);
            }

            $fotoproducto->setIdProducto($producto);
            
            $em->merge($fotoproducto);
           $em->flush();           
        }// fin if que valida si no hay ninguna imagen
        
        
        //die();
        return $this->render('ERPCRMBundle:inventariobeard:dashboard.html.twig');
    }
        
}