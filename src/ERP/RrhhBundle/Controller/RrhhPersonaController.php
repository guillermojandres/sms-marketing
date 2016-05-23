<?php

namespace ERP\RrhhBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ERP\AdminBundle\Entity\RhPersona;
use ERP\AdminBundle\Entity\RhDetalleEmpleo;
use ERP\AdminBundle\Entity\RhPersonaPuestoPerfil;
use ERP\AdminBundle\Entity\RhDetalleContacto;
use ERP\AdminBundle\Entity\RhFormacionAcademica;
use ERP\AdminBundle\Entity\RhExperienciaLaboral;
use Symfony\Component\HttpFoundation\Response;
use ERP\AdminBundle\Form\RhPersonaType;

/**
 * RhPersona controller.
 *
 * @Route("/rrhhpersona")
 */
class RrhhPersonaController extends Controller {

    /**
     * Lists all RhPersona entities.
     *
     * @Route("/", name="rhpersona_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $rhPersonas = $em->getRepository('ERPAdminBundle:RhPersona')->findAll();

        return $this->render('rhpersona/index.html.twig', array(
                    'rhPersonas' => $rhPersonas,
        ));
    }

    /**
     * 
     *
     * @Route("/persona_data/data", name="persona_data")
     */
    public function PersonaDataAction(Request $request) {


        $entity = new RhPersona();

        $start = $request->query->get('start');
        $draw = $request->query->get('draw');
        $longitud = $request->query->get('length');
        $busqueda = $request->query->get('search');
      try {
        $em = $this->getDoctrine()->getEntityManager();
        $territoriosTotal = $em->getRepository('ERPAdminBundle:RhPersona')->findAll();

        $territorio['draw'] = $draw++;
        $territorio['recordsTotal'] = count($territoriosTotal);
        $territorio['recordsFiltered'] = count($territoriosTotal);

        $territorio['data'] = array();
        //var_dump($busqueda);
        //die();
        $arrayFiltro = explode(' ', $busqueda['value']);

        //echo count($arrayFiltro);
        
  
            
            $busqueda['value'] = str_replace(' ', '%', $busqueda['value']);
        if ($busqueda['value'] != '') {

          /*  $dql = "Select concat(p.nombres,' ',p.apellido) AS nombre, dp.estado, pp.nombre_puesto AS nombrePuesto, "
                    . "concat(concat('<input type=\"checkbox\" class=\"checkbox ideproveedor\" id=\"',p.id), '\">' as link "
                    . "from rh_persona p join rh_detalle_empleo dp on p.id=dp.rh_persona_id "
                    . "join rh_persona_puesto_perfil ppp on ppp.rh_persona_id=p.id "
                    . "join rh_puesto_perfil pp on ppp.rh_puesto_perfil_id=pp.id";

            //Aqui estas trabjando
            $territorio['data'] = $em->createQuery($dql)
                    ->setParameters(array('busqueda' => "%" . $busqueda['value'] . "%"))
                    ->getResult();

            $territorio['recordsFiltered'] = count($territorio['data']);

            $dql = "Select concat(p.nombres,' ',p.apellido) AS nombre, dp.estado, pp.nombre_puesto, "
                    . "concat(concat('<input type=\"checkbox\" class=\"checkbox ideproveedor\" id=\"',p.id), '\">' as link "
                    . "from rh_persona p join rh_detalle_empleo dp on p.id=dp.rh_persona_id "
                    . "join rh_persona_puesto_perfil ppp on ppp.rh_persona_id=p.id "
                    . "join rh_puesto_perfil pp on ppp.rh_puesto_perfil_id=pp.id";


            $territorio['data'] = $em->createQuery($dql)
                    ->setParameters(array('busqueda' => "%" . $busqueda['value'] . "%"))
                    ->setFirstResult($start)
                    ->setMaxResults($longitud)
                    ->getResult();*/
        } else {
            
             $sql = "SELECT concat(concat('<input type=\"checkbox\" class=\"checkbox idpersona\" id=\"',p.id), '\">') AS link, "
                        . " concat(p.nombres,' ',p.apellido) AS nombre, dp.estado AS estado, pp.nombre_puesto AS puesto "
                        . " FROM rh_persona p "
                        . "LEFT JOIN rh_detalle_empleo dp ON p.id=dp.rh_persona_id "
                        . "LEFT JOIN rh_persona_puesto_perfil ppp ON ppp.rh_persona_id=p.id "
                        . "LEFT JOIN rh_puesto_perfil pp ON ppp.rh_puesto_perfil_id=pp.id ";
                $stm = $this->container->get('database_connection')->prepare($sql);
                $stm->execute();
                $territorio['data'] = $stm->fetchAll();

                /*   $dql = "SELECT concat(p.nombres,' ',p.apellido) AS nombre, dp.estado AS estado, pp.nombre_puesto AS puesto "
                    ." FROM rh_persona p "
                    ."LEFT JOIN rh_detalle_empleo dp ON p.id=dp.rh_persona_id "
                    ."LEFT JOIN rh_persona_puesto_perfil ppp ON ppp.rh_persona_id=p.id "
                    ."LEFT JOIN rh_puesto_perfil pp ON ppp.rh_puesto_perfil_id=pp.id ";*/
            
           /* $territorio['data'] = $em->createQuery($dql)
                    ->setFirstResult($start)
                    ->setMaxResults($longitud)
                    ->getResult();*/
        }
      


        return new Response(json_encode($territorio));
        }
 catch (\Exception $e)
 {
     echo $e->getMessage();
      return new Response(json_encode($e->getMessage()));
 }
        
    }

    /**
     * Creates a new RhPersona entity.
     *
     * @Route("/new", name="rhpersona_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $rhPersona = new RhPersona();
        $form = $this->createForm('ERP\AdminBundle\Form\RhPersonaType', $rhPersona);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($rhPersona);
            $em->flush();

            return $this->redirectToRoute('rhpersona_show', array('id' => $rhPersona->getId()));
        }
        $sql = "SELECT es.id AS id, es.nombre_estado AS nombre FROM ctl_estado es";
        $stm = $this->container->get('database_connection')->prepare($sql);
        $stm->execute();
        $ArrayEstado = $stm->fetchAll();

        $sqlTE = "SELECT c.id AS id, c.nombre_tipo_empleocol AS nombre FROM ctl_tipo_empleo c";
        $stmTE = $this->container->get('database_connection')->prepare($sqlTE);
        $stmTE->execute();
        $ArrayTipoemp = $stmTE->fetchAll();

        $sqlSuc = "SELECT c.id AS id, c.nombre_sucursal AS nombre FROM ctl_sucursal c ";
        $stmSuc = $this->container->get('database_connection')->prepare($sqlSuc);
        $stmSuc->execute();
        $ArraySuc = $stmSuc->fetchAll();

        $sqlDep = "SELECT c.id AS id, c.departamento_empresacol AS nombre FROM ctl_departamento_empresa c";
        $stmDep = $this->container->get('database_connection')->prepare($sqlDep);
        $stmDep->execute();
        $ArrayDep = $stmDep->fetchAll();


        return $this->render('ERPRrhhBundle:RrhhPersona:newPersonal.html.twig', array(
                    'rhPersona' => $rhPersona,
                    'ArrayEstado' => $ArrayEstado,
                    'ArrayTipoemp' => $ArrayTipoemp,
                    'ArraySuc' => $ArraySuc,
                    'ArrayDep' => $ArrayDep,
                        //  'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a RhPersona entity.
     *
     * @Route("/{id}", name="rhpersona_show")
     * @Method("GET")
     */
    public function showAction(RhPersona $rhPersona) {
        $deleteForm = $this->createDeleteForm($rhPersona);

        return $this->render('rhpersona/show.html.twig', array(
                    'rhPersona' => $rhPersona,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing RhPersona entity.
     *
     * @Route("/{id}/edit", name="rhpersona_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, RhPersona $rhPersona) {

        $sql = "SELECT p.id AS id, p.nombres AS nombre, p.apellido AS apellido, p.genero AS genero, "
                . "date_format(p.fecha_nacimiento, '%d-%m-%Y') As fechaNacimiento, p.dui AS dui, p.nit As nit, p.correoelectronico As correo, "
                . "p.telefono_fijo AS telefonoFijo, p.telefono_movil AS telefonoMovil, p.direccion AS direccion, "
                . " es.nombre_estado AS nombreEstado, es.id AS idEstado, c.id AS idCiudad, c.nombre_ciudad AS nombreCiudad, "
                . " de.id AS idDetalle, de.estado AS estado, date_format(de.fecha_inicio_contrato, '%d-%m-%Y') As fechaIncC, "
                . "date_format(de.fecha_fin_contrato, '%d-%m-%Y') As fechaFinC, te.nombre_tipo_empleocol AS tipoEmpleo, te.id AS idTE,"
                . "de.ctl_tipo_empleo_id AS idTE, ppp.id AS idPPP, date_format(ppp.fecha_inicio, '%d-%m-%Y') As fechaIncPerf, "
                . "date_format(ppp.fecha_fin, '%d-%m-%Y') As fechaFinPerf, pp.id idPuesto, "
                . "dEmp.departamento_empresacol AS departamento, s.nombre_sucursal AS sucursal, dc.id AS idContacto, "
                . "dc.contacto AS contacto, dc.relacion AS relacion,dc.telefono_movil AS tcel, dc.telefono_fijo AS tfijo "
                . "FROM rh_persona p JOIN ctl_ciudad c ON p.id=" . $rhPersona->getId() . " and c.id=p.ctl_ciudad_id "
                . " LEFT JOIN ctl_estado es ON es.id=c.ctl_estado_id"
                . " LEFT JOIN rh_detalle_empleo de ON de.rh_persona_id=p.id "
                . "LEFT JOIN ctl_tipo_empleo te "
                . "ON te.id=de.ctl_tipo_empleo_id "
                . " LEFT JOIN rh_persona_puesto_perfil ppp ON ppp.rh_persona_id=p.id "
                . " LEFT JOIN rh_puesto_perfil pp ON pp.id=ppp.rh_puesto_perfil_id "
                . "LEFT JOIN ctl_departamento_empresa dEmp ON dEmp.id=pp.ctl_departamento_empresa_id "
                . "LEFT JOIN ctl_sucursal s ON s.id=dEmp.ctl_sucursal_id "
                . "LEFT JOIN rh_detalle_contacto dc ON dc.rh_persona_id=p.id ";
        $stm = $this->container->get('database_connection')->prepare($sql);
        $stm->execute();
        $ArrayPersona = $stm->fetchAll();
        $idCiudad = "";
        $idEstado = "";
        foreach ($ArrayPersona as $row) {
            $idCiudad = $row['idCiudad'];
            $idEstado = $row['idEstado'];
        }

        $sql = "SELECT es.id AS id, es.nombre_estado AS nombre FROM ctl_estado es";
        $stm = $this->container->get('database_connection')->prepare($sql);
        $stm->execute();
        $ArrayEstado = $stm->fetchAll();

        $sqlCiudad = "SELECT c.id AS id, c.nombre_ciudad AS nombre FROM ctl_ciudad c ";
        $stmCiudad = $this->container->get('database_connection')->prepare($sqlCiudad);
        $stmCiudad->execute();
        $ArrayCiudad = $stmCiudad->fetchAll();

        $sqlTE = "SELECT c.id AS id, c.nombre_tipo_empleocol AS nombre FROM ctl_tipo_empleo c";
        $stmTE = $this->container->get('database_connection')->prepare($sqlTE);
        $stmTE->execute();
        $ArrayTipoemp = $stmTE->fetchAll();

        $sqlPP = "SELECT c.id AS id, c.nombre_puesto AS nombre FROM rh_puesto_perfil c";
        $stmPP = $this->container->get('database_connection')->prepare($sqlPP);
        $stmPP->execute();
        $ArrayPP = $stmPP->fetchAll();

        $sqlDep = "SELECT c.id AS id, c.departamento_empresacol AS nombre FROM ctl_departamento_empresa c";
        $stmDep = $this->container->get('database_connection')->prepare($sqlDep);
        $stmDep->execute();
        $ArrayDep = $stmDep->fetchAll();

        $sqlSuc = "SELECT c.id AS id, c.nombre_sucursal AS nombre FROM ctl_sucursal c ";
        $stmSuc = $this->container->get('database_connection')->prepare($sqlSuc);
        $stmSuc->execute();
        $ArraySuc = $stmSuc->fetchAll();


        ///  if (!empty($datos['hIdPersona'])) {}
        return $this->render('ERPRrhhBundle:RrhhPersona:newPersonal.html.twig', array(
                    'ArrayPersona' => $ArrayPersona,
                    'ArrayEstado' => $ArrayEstado,
                    'ArrayCiudad' => $ArrayCiudad,
                    'idCiudad' => $idCiudad,
                    'idEstado' => $idEstado,
                    'ArrayTipoemp' => $ArrayTipoemp,
                    'ArrayPP' => $ArrayPP,
                    'ArrayDep' => $ArrayDep,
                    'ArraySuc' => $ArraySuc,
        ));
    }

    /**
     * Deletes a RhPersona entity.
     *
     * @Route("/{id}", name="rhpersona_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, RhPersona $rhPersona) {
        $form = $this->createDeleteForm($rhPersona);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($rhPersona);
            $em->flush();
        }

        return $this->redirectToRoute('rhpersona_index');
    }

    /**
     * Creates a form to delete a RhPersona entity.
     *
     * @param RhPersona $rhPersona The RhPersona entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RhPersona $rhPersona) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('rhpersona_delete', array('id' => $rhPersona->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    /**
     * @Route("/formacion_academica/get", name="formacion_academica", options={"expose"=true})
     * @Method("GET")
     */
    public function FormacionAcademicaAction() {

        $request = $this->getRequest();
        try {

            $sqlForm = "Select fa.id id, fa.institucion inst, fa.nivel nivel, fa.anio_graduacion anio, fa.calificacion cal, fa.titulo titulo, fa.rh_persona_id idPersonaF "
                    . "From rh_persona p JOIN rh_formacion_academica fa on fa.rh_persona_id=p.id and p.id=" . $request->get('idPersona');
            $stmForma = $this->container->get('database_connection')->prepare($sqlForm);
            $stmForma->execute();
            $data['ArrayForm'] = $stmForma->fetchAll();

            return new Response(json_encode($data));
        } catch (\Exception $e) {
            $data['msj'] = "Falla al mostras datos";
            //  return new Response(json_encode($data)); 
            //echo $e->getMessage();   
        }
    }

    /**
     * @Route("/experiencia_lab/get", name="experiencia_lab", options={"expose"=true})
     * @Method("GET")
     */
    public function ExperienciaLabAction() {

        $request = $this->getRequest();
        try {

            $sqlExp = "Select el.id id, el.compania compania, el.puesto puesto, el.salario salario, el.contacto contacto, "
                    . "el.facha_inicio finicio, el.fecha_fin ffin, el.telefono_ tel  "
                    . "From rh_persona p JOIN rh_experiencia_laboral el on el.rh_persona_id=p.id and p.id=" . $request->get('idPersona');
            $stmExp = $this->container->get('database_connection')->prepare($sqlExp);
            $stmExp->execute();
            $data['ArrayExp'] = $stmExp->fetchAll();

            return new Response(json_encode($data));
        } catch (\Exception $e) {
            $data['msj'] = "Falla al mostras datos";
            //  return new Response(json_encode($data)); 
            //echo $e->getMessage();   
        }
    }

    /**
     * @Route("/datos_ciudad/get", name="datos_ciudad", options={"expose"=true});
     * @Method("GET")
     */
    public function DatosCiudadAction() {
        try {
            $request = $this->getRequest();
            $sql = "SELECT c.id AS id, c.nombre_ciudad AS nombre FROM ctl_ciudad c where c.ctl_estado_id=" . $request->get('idEstado');
            $stm = $this->container->get('database_connection')->prepare($sql);
            $stm->execute();
            $data['ArrayCiudad'] = $stm->fetchAll();

            return new Response(json_encode($data));
        } catch (\Exception $e) {
            $data['msj'] = "Falla al mostras datos";
            return new Response(json_encode($data));
            //echo $e->getMessage();      
        }
    }

    /**
     * @Route("/datos_tipo_empleo/get", name="datos_tipo_empleo", options={"expose"=true});
     * @Method("GET")
     */
    public function DatosTipoEmpleoAction() {
        try {
            $sql = "SELECT c.id AS id, c.nombre_tipo_empleocol AS nombre FROM ctl_tipo_empleo c";
            $stm = $this->container->get('database_connection')->prepare($sql);
            $stm->execute();
            $data['ArrayTipoemp'] = $stm->fetchAll();

            return new Response(json_encode($data));
        } catch (\Exception $e) {
            $data['msj'] = "Falla al mostras datos";
            return new Response(json_encode($data));
            //echo $e->getMessage();      
        }
    }

    /**
     * @Route("/datos_sucursal/get", name="datos_sucursal", options={"expose"=true});
     * @Method("GET")
     */
    public function DatosSucursalAction() {
        try {
            $sql = "SELECT c.id AS id, c.nombre_sucursal AS nombre FROM ctl_sucursal c ";
            $stm = $this->container->get('database_connection')->prepare($sql);
            $stm->execute();
            $data['ArrayTipoemp'] = $stm->fetchAll();

            return new Response(json_encode($data));
        } catch (\Exception $e) {
            $data['msj'] = "Falla al mostras datos";
            return new Response(json_encode($data));
            //echo $e->getMessage();      
        }
    }

    /**
     * @Route("/datos_dep_suc/get", name="datos_dep_suc", options={"expose"=true});
     * @Method("GET")
     */
    public function DatosDepSucAction() {
        try {
            $request = $this->getRequest();

            $sql = "SELECT c.id AS id, c.departamento_empresacol AS nombre FROM ctl_departamento_empresa c where c.ctl_sucursal_id=" . $request->get('idSucursal');
            $stm = $this->container->get('database_connection')->prepare($sql);
            $stm->execute();
            $data['ArrayDep'] = $stm->fetchAll();

            return new Response(json_encode($data));
        } catch (\Exception $e) {
            $data['msj'] = "Falla al mostras datos";
            return new Response(json_encode($data));
            //echo $e->getMessage();      
        }
    }

    /**
     * @Route("/datos_puesto/get", name="datos_puesto", options={"expose"=true});
     * @Method("GET")
     */
    public function DatosPuestoAction() {
        try {
            $request = $this->getRequest();

            $sql = "SELECT c.id AS id, c.nombre_puesto AS nombre FROM rh_puesto_perfil c where c.ctl_departamento_empresa_id=" . $request->get('idDepartamento');
            $stm = $this->container->get('database_connection')->prepare($sql);
            $stm->execute();
            $data['ArrayDep'] = $stm->fetchAll();

            return new Response(json_encode($data));
        } catch (\Exception $e) {
            $data['msj'] = "Falla al mostras datos";
            return new Response(json_encode($data));
            //echo $e->getMessage();      
        }
    }

    /**
     * @Route("/registar_persona/get", name="registrar_persona", options={"expose"=true})
     * @Method("GET")
     */
    public function RegistarPersonaAction() {
        $em = $this->getDoctrine()->getManager();
        try {
            //   $em->getConnection()->beginTransaction();
            $request = $this->getRequest();

            parse_str($request->get('dato'), $datos);
            parse_str($request->get('datosDetalleEmpleo'), $datosDetalleEmpleo);
            parse_str($request->get('datosPersonaPP'), $datosPersonaPP);
            parse_str($request->get('datosContacto'), $datosContacto);

            $RhPersona = new RhPersona();
            $RhDetalleEmpleo = new RhDetalleEmpleo();
            $RhPersonaPustPerfil = new RhPersonaPuestoPerfil();
            $RhContacto = new RhDetalleContacto();
            $RhFormacionAca = new RhFormacionAcademica();

            $idCiudad = $this->getDoctrine()->getRepository('ERPAdminBundle:CtlCiudad')->find($datos['sCiudad']);
            //   $ciudad= $this->getDoctrine()->getRepository('ERPAdminBundle:CtlCiudad')->find($idCiudad );
            $fecha = date_create($datos['fechaNacimiento']);
            $fechaNacimiento = $fecha;
            $idTipoEmpleo = $this->getDoctrine()->getRepository('ERPAdminBundle:CtlTipoEmpleo')->find($datosDetalleEmpleo['divTipoEmpleo']);
            $fechaIniC = date_create($datosDetalleEmpleo['fechaIniC']);
            $fechaFinC = date_create($datosDetalleEmpleo['fechaFinC']);

            $fechaIniPuesto = date_create($datosPersonaPP['fechaIniPuesto']);
            $fechaFinPuesto = date_create($datosPersonaPP['fechaFinPuesto']);


            $idPuesto = $this->getDoctrine()->getRepository('ERPAdminBundle:RhPuestoPerfil')->find(intval($datosPersonaPP['SPuesto']));

            // Si el empleado ya existe
            if (!empty($datos['hIdPersona'])) {

                $Persona = $em->getRepository("ERPAdminBundle:RhPersona")->find($datos['hIdPersona']);
                $Persona->setNombres($datos['txtnombre']);
                $Persona->setApellido($datos['txtapellido']);
                $Persona->setGenero($datos['genero']);
                $Persona->setFechaIngreso(new \DateTime("now"));
                $Persona->setFechaNacimiento($fechaNacimiento);
                $Persona->setDui($datos['txtdui']);
                $Persona->setNit($datos['txtnit']);
                $Persona->setCorreoelectronico($datos['txtcorreo']);
                $Persona->setDireccion($datos['txtdireccion']);
                $Persona->setTelefonoFijo($datos['txtfijo']);
                $Persona->setTelefonoMovil($datos['txtmovil']);
                $Persona->setCtlCiudad($idCiudad);

                $em->flush();

                $idPersona = $this->getDoctrine()->getRepository('ERPAdminBundle:RhPersona')->find($datos['hIdPersona']);
                // Detalle de empleado
                $RepositorioDetalle = $em->getRepository('ERPAdminBundle:RhDetalleEmpleo');

                if (count($RepositorioDetalle->findBy(array('rhPersona' => $idPersona))) > 0) {

                    $DetalleEmp = $em->getRepository("ERPAdminBundle:RhDetalleEmpleo")->find($datosDetalleEmpleo['hIdDetalle']);
                    $DetalleEmp->setEstado($datosDetalleEmpleo['SEstado']);
                    $DetalleEmp->setFechaInicioContrato($fechaIniC);
                    $DetalleEmp->setFechaFinContrato($fechaFinC);
                    $DetalleEmp->setRhPersona($idPersona);
                    $DetalleEmp->setCtlTipoEmpleo($idTipoEmpleo);
                    $em->flush();
                } else {
                    $RhDetalleEmpleo->setEstado($datosDetalleEmpleo['SEstado']);
                    $RhDetalleEmpleo->setFechaInicioContrato($fechaIniC);
                    $RhDetalleEmpleo->setFechaFinContrato($fechaFinC);
                    $RhDetalleEmpleo->setRhPersona($idPersona);
                    $RhDetalleEmpleo->setCtlTipoEmpleo($idTipoEmpleo);
                    $em->persist($RhDetalleEmpleo);
                    $em->flush();
                }
                // Persona asignada a un puesto de trabajo
                $PersonaPP = $em->getRepository("ERPAdminBundle:RhPersonaPuestoPerfil")->find($datosPersonaPP['hIdPPP']);
             
                if (count($em->getRepository("ERPAdminBundle:RhPersonaPuestoPerfil")->find($datosPersonaPP['hIdPPP'])) > 0) {
                    $PersonaPP->setFechaInicio($fechaIniPuesto);
                    $PersonaPP->setFechaFin($fechaFinPuesto);
                    $PersonaPP->setRhPersona($idPersona);
                    $PersonaPP->setRhPuestoPerfil($idPuesto);
                    $em->flush();
                } else {
                         if ($idPuesto) {
                    $RhPersonaPustPerfil->setFechaInicio($fechaIniPuesto);
                    $RhPersonaPustPerfil->setFechaFin($fechaFinPuesto);
                    $RhPersonaPustPerfil->setRhPersona($idPersona);
                    $RhPersonaPustPerfil->setRhPuestoPerfil($idPuesto);
                    $em->persist($RhPersonaPustPerfil);
                    $em->flush();
                         }
                }
                // Detalle Contacto 
                $detalleContact = $em->getRepository("ERPAdminBundle:RhDetalleContacto")->find($datosContacto['hIdContacto']);
                $detalleContact->setContacto($datosContacto['txtcontacto']);
                $detalleContact->setRelacion($datosContacto['txtrelacion']);
                $detalleContact->setRhPersona($idPersona);
                $detalleContact->setTelefonoFijo($datosContacto['txtTelefono']);
                $detalleContact->setTelefonoMovil($datosContacto['txtMovil']);
                $em->flush();
                // Formacion Academica
                $array = $request->get('datosFormacion');
                $Repositorioformacion = $em->getRepository('ERPAdminBundle:RhFormacionAcademica');
                if (is_null($Repositorioformacion->findBy(array('rhPersona' => $idPersona)))) {
                    
                } else {
                    $formacion = $Repositorioformacion->findBy(array('rhPersona' => $idPersona));

                    foreach ($formacion as $obj) {
                        $em->remove($obj);
                        $em->flush();
                    }
                }
                if (is_null($array)) {
                    
                } else {
                    foreach ($array as $obj) {
                        $RhFormacionAca = new RhFormacionAcademica();
                        $RhFormacionAca->setAnioGraduacion($obj['3']);
                        $RhFormacionAca->setCalificacion($obj['4']);
                        $RhFormacionAca->setInstitucion($obj['1']);
                        $RhFormacionAca->setNivel($obj['2']);
                        $RhFormacionAca->setRhPersona($idPersona);
                        $RhFormacionAca->setTitulo($obj['5']);
                        $em->persist($RhFormacionAca);
                        $em->flush();
                    }
                }
                // Experiencia laboral
                $arrayExperiencia = $request->get('datosExperiencia');
                $RepositorioExperiencia = $em->getRepository('ERPAdminBundle:RhExperienciaLaboral');

                if (is_null($RepositorioExperiencia->findBy(array('rhPersona' => $idPersona)))) {
                    
                } else {
                    $Experiencia = $RepositorioExperiencia->findBy(array('rhPersona' => $idPersona));
                    foreach ($Experiencia as $objExperiencia) {
                        $em->remove($objExperiencia);
                        $em->flush();
                    }
                }

                if (is_null($arrayExperiencia)) {
                    
                } else {
                    foreach ($arrayExperiencia as $objExperiencia) {

                        $txtFechaIniTrabajo = date_create($objExperiencia['6']);
                        $txtFechaFinTrabajo = date_create($objExperiencia['7']);

                        $RhExperienciaLaboral = new RhExperienciaLaboral();
                        $RhExperienciaLaboral->setCompania($objExperiencia['1']);
                        $RhExperienciaLaboral->setPuesto($objExperiencia['2']);
                        $RhExperienciaLaboral->setSalario($objExperiencia['3']);
                        $RhExperienciaLaboral->setContacto($objExperiencia['4']);
                        $RhExperienciaLaboral->setTelefono($objExperiencia['5']);
                        $RhExperienciaLaboral->setFachaInicio($txtFechaIniTrabajo);
                        $RhExperienciaLaboral->setFechaFin($txtFechaFinTrabajo);
                        $RhExperienciaLaboral->setRhPersona($idPersona);
                        $em->persist($RhExperienciaLaboral);
                        $em->flush();
                    }
                }
                $data['msj'] = "Actualizado";
            }
            
            else {
                $RhPersona->setNombres($datos['txtnombre']);
                $RhPersona->setApellido($datos['txtapellido']);
                $RhPersona->setGenero($datos['genero']);
                $RhPersona->setFechaIngreso(new \DateTime("now"));
                $RhPersona->setFechaNacimiento($fechaNacimiento);

                $RhPersona->setDui($datos['txtdui']);
                $RhPersona->setNit($datos['txtnit']);

                $RhPersona->setCorreoelectronico($datos['txtcorreo']);
                $RhPersona->setDireccion($datos['txtdireccion']);
                $RhPersona->setTelefonoFijo($datos['txtfijo']);
                $RhPersona->setTelefonoMovil($datos['txtmovil']);
                $RhPersona->setCtlCiudad($idCiudad);

                $em->persist($RhPersona);
                $em->flush();

                $idPersona = $this->getDoctrine()->getRepository('ERPAdminBundle:RhPersona')->find($RhPersona->getId());
                // Detalle de empleado

                if (is_null($idTipoEmpleo)) {
                    
                } else {
                    $RhDetalleEmpleo->setEstado($datosDetalleEmpleo['SEstado']);
                    $RhDetalleEmpleo->setFechaInicioContrato($fechaIniC);
                    $RhDetalleEmpleo->setFechaFinContrato($fechaFinC);
                    $RhDetalleEmpleo->setRhPersona($idPersona);
                    $RhDetalleEmpleo->setCtlTipoEmpleo($idTipoEmpleo);
                    $em->persist($RhDetalleEmpleo);
                    $em->flush();
                }
                // Persona asignada a un puesto de trabajo
                if ($idPuesto) {
                    $RhPersonaPustPerfil->setFechaInicio($fechaIniPuesto);
                    $RhPersonaPustPerfil->setFechaFin($fechaFinPuesto);
                    $RhPersonaPustPerfil->setRhPersona($idPersona);
                    $RhPersonaPustPerfil->setRhPuestoPerfil($idPuesto);
                    $em->persist($RhPersonaPustPerfil);
                    $em->flush();
                }
                // Detalle Contacto 

                $RhContacto->setContacto($datosContacto['txtcontacto']);
                $RhContacto->setRelacion($datosContacto['txtrelacion']);
                $RhContacto->setRhPersona($idPersona);
                $RhContacto->setTelefonoFijo($datosContacto['txtTelefono']);
                $RhContacto->setTelefonoMovil($datosContacto['txtMovil']);
                $em->persist($RhContacto);
                $em->flush();

                // Formacion Academica
                $array = $request->get('datosFormacion');
                if (is_null($array)) {
                    
                } else {



                    foreach ($array as $obj) {

                        $RhFormacionAca = new RhFormacionAcademica();
                        $RhFormacionAca->setAnioGraduacion($obj['3']);
                        $RhFormacionAca->setCalificacion($obj['4']);
                        $RhFormacionAca->setInstitucion($obj['1']);
                        $RhFormacionAca->setNivel($obj['2']);
                        $RhFormacionAca->setRhPersona($idPersona);
                        $RhFormacionAca->setTitulo($obj['5']);
                        $em->persist($RhFormacionAca);
                        $em->flush();
                    }
                }
                // Experiencia laboral
                $arrayExperiencia = $request->get('datosExperiencia');
                if (is_null($arrayExperiencia)) {
                    
                } else {
                    foreach ($arrayExperiencia as $objExperiencia) {
                        $txtFechaIniTrabajo = date_create($objExperiencia['6']);
                        $txtFechaFinTrabajo = date_create($objExperiencia['7']);

                        $RhExperienciaLaboral = new RhExperienciaLaboral();

                        $RhExperienciaLaboral->setCompania($objExperiencia['1']);
                        $RhExperienciaLaboral->setPuesto($objExperiencia['2']);
                        $RhExperienciaLaboral->setSalario($objExperiencia['3']);
                        $RhExperienciaLaboral->setContacto($objExperiencia['4']);
                        $RhExperienciaLaboral->setTelefono($objExperiencia['5']);
                        $RhExperienciaLaboral->setFachaInicio($txtFechaIniTrabajo);
                        $RhExperienciaLaboral->setFechaFin($txtFechaFinTrabajo);
                        $RhExperienciaLaboral->setRhPersona($idPersona);
                        $em->persist($RhExperienciaLaboral);
                        $em->flush();
                    }
                }
                $data['msj'] = "Registrado";
            }
            //  $em->getConnection()->commit();
            // $em->close();
            return new Response(json_encode($data));
        } catch (\Exception $e) {
            // $data['msj']="Falla al mostras datos";
            //  $em->getConnection()->rollback();
            // $em->close();
            $data['msj'] = $e->getMessage();
            //    $e->getCode();

            return new Response(json_encode($data));
        }
    }

}
