<?php

namespace App\Controller;

use App\Entity\Proveedor;
use App\Form\ProveedorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ContabilidadController extends AbstractController
{
    /**
     * @Route("/crear", name="crear")
     */
    public function crearProveedor(Request $request)
    {
        $proveedor = new Proveedor();
        $form = $this->createForm(ProveedorType::class,$proveedor);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $proveedor = $form->getData(); //Asociamos los campos del form a la entidad
            $date = date('d-m-y h:i:s');
            $proveedor->setCreado($date);
            $proveedor->setModificado($date);
            $entMan = $this->getDoctrine()->getManager();
            $entMan->persist($proveedor);
            $entMan->flush();
            return $this->render('contabilidad/proveedorCreado.html.twig',array('nombre'=>$proveedor->getNombre()));
        }
        return $this->render('contabilidad/crear.html.twig',array('form'=>$form->createView()));
    }

    public function proveedorCreado(){
        return $this->render('contabilidad/inicio.html.twig');
    }

    public function proveedorModificado(){
        return $this->render('contabilidad/mostrar.html.twig');
    }

    /**
     * @Route("/", name="inicio")
     */
    public function inicio()
    {
        return $this->render('contabilidad/inicio.html.twig');
    }

    /**
     * @Route("/mostrar", name="mostrar")
     */
    public function showAll()
    {
        $proveedores = $this->getDoctrine()->getRepository(Proveedor::class)->findAll();
        return $this->render('contabilidad/mostrar.html.twig',array('proveedores'=>$proveedores));
    }

    /**
     * @Route("/editar/{id}", name="editar")
     */
    public function editar(int $id,Request $request){
        $proveedor = $this->getDoctrine()->getRepository(Proveedor::class)->find($id);
        $form = $this->createForm(ProveedorType::class,$proveedor);
        $entMan = $this->getDoctrine()->getManager();
        $proveedor = $entMan->getRepository(Proveedor::class) ->find($proveedor->getId());
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $proveedor->setNombre($form->get('Nombre')->getData());
            $proveedor->setEmail($form->get('Email')->getData());
            $proveedor->setTelefono($form->get('Telefono')->getData());
            $proveedor->setCategoria($form->get('Categoria')->getData());
            $proveedor->setActivo($form->get('Activo')->getData());
            $date = date('d-m-y h:i:s');
            $proveedor->setModificado($date);
            $entMan->flush();

            return $this->render('contabilidad/proveedorModificado.html.twig',array('nombre'=>$proveedor->getNombre()));
        }

        return $this->render('contabilidad/editar.html.twig',array('form'=>$form->createView()));
    }

    /**
     * @Route("/eliminar/{id}", name="eliminar")
     */
    public function eliminar(int $id,Request $request){
        $entMan = $this->getDoctrine()->getManager();
        $entMan->remove($this->getDoctrine()->getRepository(Proveedor::class)->find($id));
        $entMan->flush();
        $proveedores = $this->getDoctrine()->getRepository(Proveedor::class)->findAll();
        return $this->render('contabilidad/mostrar.html.twig',array('proveedores'=>$proveedores));
    }


}
