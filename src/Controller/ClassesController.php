<?php

namespace App\Controller;

use App\Entity\Classes;
use App\Form\ClassesType;
use App\Repository\ClassesRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[IsGranted('ROLE_USER')]
#[Route('/classes')]
class ClassesController extends AbstractController
{
    #[Route('/', name: 'app_classes_index', methods: ['GET'])]
    public function index(ClassesRepository $classesRepository): Response
    {
        return $this->render('classes/index.html.twig', [
            'classes' => $classesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_classes_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ClassesRepository $classesRepository): Response
    {
        $class = new Classes();
        $form = $this->createForm(ClassesType::class, $class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $classesRepository->save($class, true);

            return $this->redirectToRoute('app_classes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('classes/new.html.twig', [
            'class' => $class,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_classes_show', methods: ['GET'])]
    public function show(Classes $class): Response
    {
        return $this->render('classes/show.html.twig', [
            'class' => $class,
            'eleves' => $class->getEleves(),
            'professeur' => $class->getProfesseur(),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_classes_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Classes $class, ClassesRepository $classesRepository): Response
    {
        $form = $this->createForm(ClassesType::class, $class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $classesRepository->save($class, true);

            return $this->redirectToRoute('app_classes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('classes/edit.html.twig', [
            'class' => $class,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_classes_delete', methods: ['POST'])]
    public function delete(Request $request, Classes $class, ClassesRepository $classesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$class->getId(), $request->request->get('_token'))) {
            $classesRepository->remove($class, true);
        }

        return $this->redirectToRoute('app_classes_index', [], Response::HTTP_SEE_OTHER);
    }
}
