<?php

namespace App\Controller;

use App\Entity\ChildClass;
use App\Form\ChildClassType;
use App\Repository\ChildClassRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/child")
 */
class ChildClassController extends AbstractController
{
    /**
     * @Route("/", name="child_class_index", methods={"GET"})
     */
    public function index(ChildClassRepository $childClassRepository): Response
    {
        return $this->render('child_class/index.html.twig', [
            'child_classes' => $childClassRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="child_class_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $childClass = new ChildClass();
        $form = $this->createForm(ChildClassType::class, $childClass);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($childClass);
            $entityManager->flush();

            return $this->redirectToRoute('child_class_index');
        }

        return $this->render('child_class/new.html.twig', [
            'child_class' => $childClass,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="child_class_show", methods={"GET"})
     */
    public function show(ChildClass $childClass): Response
    {
        return $this->render('child_class/show.html.twig', [
            'child_class' => $childClass,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="child_class_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ChildClass $childClass): Response
    {
        $form = $this->createForm(ChildClassType::class, $childClass);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('child_class_index');
        }

        return $this->render('child_class/edit.html.twig', [
            'child_class' => $childClass,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="child_class_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ChildClass $childClass): Response
    {
        if ($this->isCsrfTokenValid('delete'.$childClass->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($childClass);
            $entityManager->flush();
        }

        return $this->redirectToRoute('child_class_index');
    }
}
