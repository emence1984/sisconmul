<?php

namespace App\Controller;

use App\Entity\SmPersona;
use App\Entity\SmUsuario;
use App\Form\RegistroUsuarioType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistroUsuarioController extends AbstractController
{
    #[Route('/sisconmul/usuario', name: 'registro_usuario')]
    public function index(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {

        $em = $this->getDoctrine()->getManager();

        $usuario = new SmUsuario();
       
        $frmUsuario = $this->createForm(RegistroUsuarioType::class, $usuario);
        $frmUsuario->handleRequest($request);
 
         if ($frmUsuario->isSubmitted() && $frmUsuario->isValid()){
             
            
            
            $usuario ->setClave($passwordEncoder->encodePassword($usuario,$frmUsuario['clave']->getData()));
            
            $em->persist($usuario);
            $em->flush();
 
            $this->addFlash('msgOk','Transacción Ejecutada con Éxito !!');
 
            return $this->redirectToRoute('principal');
         }

         $listadoPersonas = $this->getDoctrine()  ->getRepository(SmPersona::class) ->findAll();
    
         return $this->render('registro_usuario/index.html.twig', [
           'frmUsuario' => $frmUsuario->createView(),
           'listadoPersonas' => $listadoPersonas ,
        ]);
    }
    


}
