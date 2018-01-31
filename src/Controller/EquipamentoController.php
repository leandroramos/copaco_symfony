<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

use App\Entity\Equipamento;
use App\Form\EquipamentoType;
use App\Utils\NetworkOps;
use App\Utils\Utils;

use IPTools\IP;
use IPTools\Network;

class EquipamentoController extends Controller
{

/**
 * @Route("/equipamento/", name="equipamento_index")
 */
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository(Equipamento::class);
        $equipamentos = $repository->findAll();
        return $this->render('equipamento/index.html.twig', array(
        'equipamentos' => $equipamentos,
    ));
    }


    /**
     * @Route("/equipamento/new", name="equipamento_new")
     */
    public function newAction(Request $request)
    {
        $equipamento = new Equipamento();
        $form = $this->createForm(EquipamentoType::class, $equipamento);
        $form->handleRequest($request);
        $nw = new NetworkOps();

            if ($form->isSubmitted() && $form->isValid()) {

            $ip_sugerido = $equipamento->getIp();
            if(!empty($ip_sugerido)){
                $verifica = $nw->verificaSeIpDisponivel($equipamento); 
                if($verifica['status']){
                    $equipamento->setIp($ip_sugerido);
                }
                else {
                    $this->addFlash('danger',$verifica['msg']);
                    $aloca = $nw->alocaProximoIpDisponivel($equipamento);
                    if($aloca['status']){
                        $equipamento->setIp($aloca['ip']);
                    }
                    else {
                        $equipamento->setIp(null);
                        $this->addFlash('danger',$aloca['msg']);
                    }    
                }
            }
            else {
                $aloca = $nw->alocaProximoIpDisponivel($equipamento);
                if($aloca['status']){
                    $equipamento->setIp($aloca['ip']);
                }
                else {
                    $equipamento->setIp(null);
                    $this->addFlash('danger',$aloca['msg']);
                }
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($equipamento);
            $em->flush();
            $this->addFlash('success','Novo equipamento cadastrado');
            return $this->redirectToRoute('equipamento_new');
        }
        return $this->render('equipamento/new.html.twig', [
            'form' => $form->createView(),
            'title' => 'Cadastrar novo equipamento'
        ]);
    }

    /**
     * @Route("/equipamento/{id}", name="equipamento_show")
     */
    public function showAction(Equipamento $equipamento)
    {
        return $this->render('equipamento/show.html.twig', array(
        'equipamento' => $equipamento,
    ));
    }

    /**
      * @Route("/equipamento/{id}/edit", name="equipamento_edit")
      */
    public function editAction(Request $request, Equipamento $equipamento)
    {
        $form = $this->createForm('App\Form\EquipamentoType', $equipamento);
        $form->handleRequest($request);
        $nw = new NetworkOps();

        if ($form->isSubmitted() && $form->isValid()) {

            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('equipamento_show', ['id' => $equipamento->getId()]);
        }

        return $this->render('equipamento/new.html.twig', array(
            'equipamento' => $equipamento,
            'form' => $form->createView(),
            'title' => 'Editar equipamento'
    ));
    }


    /**
     * @Route("/{id}", name="equipamento_delete",methods="DELETE")
     */
    public function deleteAction(Request $request, Equipamento $equipamento)
    {
        $form = $this->createDeleteForm($equipamento);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($equipamento);
            $em->flush();
        }
        return $this->redirectToRoute('equipamento_index');
    }

    /**
     * @Route("/equipamento/{id}/delete/confirm", name="equipamento_delete_confirm")
     */
    public function confirmDeleteAction(Equipamento $equipamento)
    {
        $form = $this->createDeleteForm($equipamento);
        return $this->render('equipamento/delete.html.twig', array(
        'equipamento' => $equipamento,
        'form' => $form->createView(),
    ));
    }

    private function createDeleteForm(Equipamento $equipamento)
    {
//    $data = array('message' => "Certeza que quer deletar o equipamento {$equipamento->getMacaddress}?");
        return $this->createFormBuilder()
        ->setAction($this->generateUrl('equipamento_delete', array('id' => $equipamento->getId())))
        ->setMethod('DELETE')
        ->add(
            'message',
            CheckboxType::class,
            [
                 'label'    => "quer mesmo deletear: {$equipamento->getMacaddress()}?",
                 'required' => true,
             ]
        )
        ->getForm()
    ;
    }
}


