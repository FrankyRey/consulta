<?php

namespace App\Controller;

use App\Entity\EstatusDocumento;
use App\Form\EstatusDocumentoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/portal/estatus_documento")
 */
class EstatusDocumentoController extends AbstractController
{
    /**
     * @Route("/", name="estatus_documento_index", methods={"GET"})
     */
    public function index(): Response
    {
        $estatusDocumentos = $this->getDoctrine()
            ->getRepository(EstatusDocumento::class)
            ->findAll();

        return $this->render('estatus_documento/index.html.twig', [
            'estatus_documentos' => $estatusDocumentos,
        ]);
    }

    /**
     * @Route("/new", name="estatus_documento_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $estatusDocumento = new EstatusDocumento();
        $form = $this->createForm(EstatusDocumentoType::class, $estatusDocumento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($estatusDocumento);
            $entityManager->flush();

            return $this->redirectToRoute('estatus_documento_index');
        }

        return $this->render('estatus_documento/new.html.twig', [
            'estatus_documento' => $estatusDocumento,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idEstatusDocumento}", name="estatus_documento_show", methods={"GET"})
     */
    public function show(EstatusDocumento $estatusDocumento): Response
    {
        return $this->render('estatus_documento/show.html.twig', [
            'estatus_documento' => $estatusDocumento,
        ]);
    }

    /**
     * @Route("/{idEstatusDocumento}/edit", name="estatus_documento_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, EstatusDocumento $estatusDocumento): Response
    {
        $form = $this->createForm(EstatusDocumentoType::class, $estatusDocumento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('estatus_documento_index', [
                'idEstatusDocumento' => $estatusDocumento->getIdEstatusDocumento(),
            ]);
        }

        return $this->render('estatus_documento/edit.html.twig', [
            'estatus_documento' => $estatusDocumento,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idEstatusDocumento}", name="estatus_documento_delete", methods={"DELETE"})
     */
    public function delete(Request $request, EstatusDocumento $estatusDocumento): Response
    {
        if ($this->isCsrfTokenValid('delete'.$estatusDocumento->getIdEstatusDocumento(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($estatusDocumento);
            $entityManager->flush();
        }

        return $this->redirectToRoute('estatus_documento_index');
    }
}
