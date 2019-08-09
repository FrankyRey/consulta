<?php

namespace App\Controller;

use App\Entity\MenuMenuRender;
use App\Form\MenuMenuRenderType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/menu_menu_render")
 */
class MenuMenuRenderController extends AbstractController
{
    /**
     * @Route("/", name="menu_menu_render_index", methods={"GET"})
     */
    public function index(): Response
    {
        $menuMenuRenders = $this->getDoctrine()
            ->getRepository(MenuMenuRender::class)
            ->findAll();

        return $this->render('menu_menu_render/index.html.twig', [
            'menu_menu_renders' => $menuMenuRenders,
        ]);
    }

    /**
     * @Route("/new", name="menu_menu_render_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $menuMenuRender = new MenuMenuRender();
        $form = $this->createForm(MenuMenuRenderType::class, $menuMenuRender);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($menuMenuRender);
            $entityManager->flush();

            return $this->redirectToRoute('menu_menu_render_index');
        }

        return $this->render('menu_menu_render/new.html.twig', [
            'menu_menu_render' => $menuMenuRender,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idMenuMenuRender}", name="menu_menu_render_show", methods={"GET"})
     */
    public function show(MenuMenuRender $menuMenuRender): Response
    {
        return $this->render('menu_menu_render/show.html.twig', [
            'menu_menu_render' => $menuMenuRender,
        ]);
    }

    /**
     * @Route("/{idMenuMenuRender}/edit", name="menu_menu_render_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, MenuMenuRender $menuMenuRender): Response
    {
        $form = $this->createForm(MenuMenuRenderType::class, $menuMenuRender);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('menu_menu_render_index');
        }

        return $this->render('menu_menu_render/edit.html.twig', [
            'menu_menu_render' => $menuMenuRender,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idMenuMenuRender}", name="menu_menu_render_delete", methods={"DELETE"})
     */
    public function delete(Request $request, MenuMenuRender $menuMenuRender): Response
    {
        if ($this->isCsrfTokenValid('delete'.$menuMenuRender->getIdMenuMenuRender(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($menuMenuRender);
            $entityManager->flush();
        }

        return $this->redirectToRoute('menu_menu_render_index');
    }
}
