<?php

namespace App\Controller;

use App\Entity\MenuRender;
use App\Form\MenuRenderType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/menu_rol")
 */
class MenuRenderController extends AbstractController
{
    /**
     * @Route("/", name="menu_render_index", methods={"GET"})
     */
    public function index(): Response
    {
        $menuRenders = $this->getDoctrine()
            ->getRepository(MenuRender::class)
            ->findAll();

        return $this->render('menu_render/index.html.twig', [
            'menu_renders' => $menuRenders,
        ]);
    }

    /**
     * @Route("/new", name="menu_render_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $menuRender = new MenuRender();
        $form = $this->createForm(MenuRenderType::class, $menuRender);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($menuRender);
            $entityManager->flush();

            return $this->redirectToRoute('menu_render_index');
        }

        return $this->render('menu_render/new.html.twig', [
            'menu_render' => $menuRender,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idMenuRender}", name="menu_render_show", methods={"GET"})
     */
    public function show(MenuRender $menuRender): Response
    {
        return $this->render('menu_render/show.html.twig', [
            'menu_render' => $menuRender,
        ]);
    }

    /**
     * @Route("/{idMenuRender}/edit", name="menu_render_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, MenuRender $menuRender): Response
    {
        $form = $this->createForm(MenuRenderType::class, $menuRender);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('menu_render_index', [
                'idMenuRender' => $menuRender->getIdMenuRender(),
            ]);
        }

        return $this->render('menu_render/edit.html.twig', [
            'menu_render' => $menuRender,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idMenuRender}", name="menu_render_delete", methods={"DELETE"})
     */
    public function delete(Request $request, MenuRender $menuRender): Response
    {
        if ($this->isCsrfTokenValid('delete'.$menuRender->getIdMenuRender(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($menuRender);
            $entityManager->flush();
        }

        return $this->redirectToRoute('menu_render_index');
    }
}
