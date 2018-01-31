<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

use App\Entity\Rede;
use App\Form\RedeType;
use App\Utils\NetworkOps;

use IPTools\IP;
use IPTools\Network;

class RedeController extends Controller
{
    /**
      * @Route("/rede",name="rede_index")
      * @Route("/")
      */
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository(Rede::class);
        $redes = $repository->findAll();
        return $this->render("rede/index.html.twig", [
            'redes' => $redes,
        ]);
    }

    /**
     * @Route("/rede/new", name="rede_new")
     */
    public function newAction(Request $request)
    {

        $rede = new Rede();
        $form = $this->createForm('App\Form\RedeType', $rede);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($rede);
            $em->flush();
            $this->addFlash('success','Nova rede adicionada com sucesso');
            return $this->redirectToRoute('rede_new');
        }
        return $this->render('rede/new.html.twig', [
          'form' => $form->createView(),
       ]);
    }
   
    /**
      * @Route("/rede/{id}",name="rede_show")
      */
    public function showAction(Rede $rede)
    {
        return $this->render('rede/show.html.twig', [
            'rede' => $rede,
            ]);
    }

    /**
      * @Route("/rede/{id}/edit",name="rede_edit")
      */
    public function editAction(Request $request, Rede $rede)
    {
        $form = $this->createForm(RedeType::class, $rede);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('rede_show', ['id' => $rede->getId()]);
        }
        return $this->render('rede/edit.html.twig', array(
        'rede' => $rede,
        'form' => $form->createView(),
    ));
    }

    /**
      * @Route("/rede/{id}/delete",name="rede_delete", methods="DELETE")
      */
    public function deleteAction(Request $request, Rede $rede)
    {
        $form = $this->createDeleteForm($rede);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $equipamentos = $rede->getEquipamentos();
            foreach ($equipamentos as $equipamento) {
                $equipamento->setRede(null);
            }
            $em = $this->getDoctrine()->getManager();
            $em->remove($rede);
            $em->flush();
        }
        
        return $this->redirectToRoute('rede_index');
    }

    private function createDeleteForm(Rede $rede)
    {
        $id = $rede->getId();
        return $this->createFormBuilder()
        ->setAction($this->generateUrl('rede_delete', ['id' => $id]))
        ->setMethod('DELETE')
        ->add('message', CheckboxType::class, [
             'label'    => "Quer mesmo deletar ?",
             'required' => true,])
        ->getForm();
    }

    /**
     * @Route("/rede/{id}/delete/confirm", name="rede_delete_confirm")
     */
    public function confirmDeleteAction(Rede $rede)
    {
        $form = $this->createDeleteForm($rede);
        return $this->render('rede/delete.html.twig', array(
        'rede' => $rede,
        'form' => $form->createView(),
    ));
    }


    /**
     * @Route("/dhcpd.conf", name="dhcpd")
     */
    public function dhcp()
    {
        
        $repository = $this->getDoctrine()->getRepository(Rede::class);
        $redes = $repository->findAll();
        $dhcp = new NetworkOps();
    
        $response = new Response($dhcp->build($redes));
        $response->headers-> set('Content-Type', 'text/plain');
        return $response;
    }
}
