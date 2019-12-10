<?php

namespace App\Controller;

use App\Entity\ParentClass;
use App\Form\ParentClassType;
use App\Repository\ParentClassRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/parent")
 */
class ParentClassController extends AbstractController
{
    /**
     * @Route("/", name="parent_class_index", methods={"GET"})
     */
    public function index(ParentClassRepository $parentClassRepository): Response
    {
        return $this->render('parent_class/index.html.twig', [
            'parent_classes' => $parentClassRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="parent_class_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $parentClass = new ParentClass();
        $form = $this->createForm(ParentClassType::class, $parentClass);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($parentClass);
            $entityManager->flush();

            return $this->redirectToRoute('parent_class_index');
        }

        return $this->render('parent_class/new.html.twig', [
            'parent_class' => $parentClass,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="parent_class_show", methods={"GET"})
     */
    public function show(ParentClass $parentClass): Response
    {
        return $this->render('parent_class/show.html.twig', [
            'parent_class' => $parentClass,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="parent_class_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ParentClass $parentClass): Response
    {
        $form = $this->createForm(ParentClassType::class, $parentClass);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('parent_class_index');
        }

        return $this->render('parent_class/edit.html.twig', [
            'parent_class' => $parentClass,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="parent_class_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ParentClass $parentClass): Response
    {
        if ($this->isCsrfTokenValid('delete'.$parentClass->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($parentClass);
            $entityManager->flush();
        }

        return $this->redirectToRoute('parent_class_index');
    }
}
