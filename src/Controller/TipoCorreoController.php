<?php

namespace App\Controller;

use App\Entity\TipoCorreo;
use App\Form\TipoCorreoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/portal/tipo_correo")
 */
class TipoCorreoController extends AbstractController
{
    /**
     * @Route("/", name="tipo_correo_index", methods={"GET"})
     */
    public function index(): Response
    {
        $tipoCorreos = $this->getDoctrine()
            ->getRepository(TipoCorreo::class)
            ->findAll();

        return $this->render('tipo_correo/index.html.twig', [
            'tipo_correos' => $tipoCorreos,
        ]);
    }

    /**
     * @Route("/new", name="tipo_correo_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $tipoCorreo = new TipoCorreo();
        $form = $this->createForm(TipoCorreoType::class, $tipoCorreo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tipoCorreo);
            $entityManager->flush();

            return $this->redirectToRoute('tipo_correo_index');
        }

        return $this->render('tipo_correo/new.html.twig', [
            'tipo_correo' => $tipoCorreo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idTipoCorreo}", name="tipo_correo_show", methods={"GET"})
     */
    public function show(TipoCorreo $tipoCorreo): Response
    {
        return $this->render('tipo_correo/show.html.twig', [
            'tipo_correo' => $tipoCorreo,
        ]);
    }

    /**
     * @Route("/{idTipoCorreo}/edit", name="tipo_correo_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TipoCorreo $tipoCorreo): Response
    {
        $form = $this->createForm(TipoCorreoType::class, $tipoCorreo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tipo_correo_index', [
                'idTipoCorreo' => $tipoCorreo->getIdTipoCorreo(),
            ]);
        }

        return $this->render('tipo_correo/edit.html.twig', [
            'tipo_correo' => $tipoCorreo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idTipoCorreo}", name="tipo_correo_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TipoCorreo $tipoCorreo): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tipoCorreo->getIdTipoCorreo(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tipoCorreo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tipo_correo_index');
    }
}
