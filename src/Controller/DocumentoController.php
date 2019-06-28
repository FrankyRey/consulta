<?php

namespace App\Controller;

use App\Entity\Documento;
use App\Form\DocumentoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/app/documento")
 */
class DocumentoController extends AbstractController
{
    /**
     * @Route("/", name="documento_index", methods={"GET"})
     */
    public function index(): Response
    {
        $documentos = $this->getDoctrine()
            ->getRepository(Documento::class)
            ->findAll();

        return $this->render('documento/index.html.twig', [
            'documentos' => $documentos,
        ]);
    }

    /**
     * @Route("/new", name="documento_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $documento = new Documento();
        $form = $this->createForm(DocumentoType::class, $documento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($documento);
            $entityManager->flush();

            return $this->redirectToRoute('documento_index');
        }

        return $this->render('documento/new.html.twig', [
            'documento' => $documento,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idCodumento}", name="documento_show", methods={"GET"})
     */
    public function show(Documento $documento): Response
    {
        return $this->render('documento/show.html.twig', [
            'documento' => $documento,
        ]);
    }

    /**
     * @Route("/{idCodumento}/edit", name="documento_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Documento $documento): Response
    {
        $form = $this->createForm(DocumentoType::class, $documento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('documento_index', [
                'idCodumento' => $documento->getIdCodumento(),
            ]);
        }

        return $this->render('documento/edit.html.twig', [
            'documento' => $documento,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idCodumento}", name="documento_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Documento $documento): Response
    {
        if ($this->isCsrfTokenValid('delete'.$documento->getIdCodumento(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($documento);
            $entityManager->flush();
        }

        return $this->redirectToRoute('documento_index');
    }
}
