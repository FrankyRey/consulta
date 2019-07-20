<?php

namespace App\Controller;

use App\Entity\Grupo;
use App\Form\GrupoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/grupo")
 */
class GrupoController extends AbstractController
{
    /**
     * @Route("/", name="grupo_index", methods={"GET"})
     */
    public function index(): Response
    {
        $grupos = $this->getDoctrine()
            ->getRepository(Grupo::class)
            ->findAll();

        return $this->render('grupo/index.html.twig', [
            'grupos' => $grupos,
        ]);
    }

    /**
     * @Route("/new", name="grupo_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $grupo = new Grupo();
        $form = $this->createForm(GrupoType::class, $grupo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($grupo);
            $entityManager->flush();

            return $this->redirectToRoute('grupo_index');
        }

        return $this->render('grupo/new.html.twig', [
            'grupo' => $grupo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idGrupo}", name="grupo_show", methods={"GET"})
     */
    public function show(Grupo $grupo): Response
    {
        return $this->render('grupo/show.html.twig', [
            'grupo' => $grupo,
        ]);
    }

    /**
     * @Route("/{idGrupo}/edit", name="grupo_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Grupo $grupo): Response
    {
        $form = $this->createForm(GrupoType::class, $grupo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('grupo_index', [
                'idGrupo' => $grupo->getIdGrupo(),
            ]);
        }

        return $this->render('grupo/edit.html.twig', [
            'grupo' => $grupo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idGrupo}", name="grupo_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Grupo $grupo): Response
    {
        if ($this->isCsrfTokenValid('delete'.$grupo->getIdGrupo(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($grupo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('grupo_index');
    }
}
