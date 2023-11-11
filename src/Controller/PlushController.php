<?php

namespace App\Controller;

use App\Entity\Plush;
use App\Form\PlushType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/plush')]
class PlushController extends AbstractController
{
    #[Route('/list', name: 'plush_list', methods: ['GET'])]
    #[Route('/', name: 'plush_index', methods: ['GET'])]
    public function list(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $plushies = $entityManager->getRepository(Plush::class)->findAll();
        return $this->render(
            'plush/list.html.twig',
            [ 'plushies' => $plushies ]
        );
    }

    #[Route('/{id}', name: 'plush_show', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function show(Plush $plush, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $plushRepository = $entityManager->getRepository(Plush::class);
        $allPlushies = $plushRepository->findAllExcept($plush->getId());

        return $this->render(
            'plush/show.html.twig',
            [ 'designated_plush' => $plush ,
                'plushies' => $allPlushies]
        );
    }

    #[Route('/new', name:'plush_new', methods:['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $plush = new Plush();
        $form = $this->createForm(PlushType::class, $plush);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($plush);
            $entityManager->flush();

            return $this->redirectToRoute('plush_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('plush/new.html.twig', [
            'plush' => $plush,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'plush_edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function edit(Request $request, Plush $plush, EntityManagerInterface $entityManager): Response
    {
        $id = $plush->getId();
        $form = $this->createForm(PlushType::class, $plush);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('plush_show', ['id' => $id], Response::HTTP_SEE_OTHER);
        }

        return $this->render('plush/edit.html.twig', [
            'plush' => $plush,
            'form' => $form,
        ]);
    }
    #[Route('/{id}', name: 'plush_delete', methods: ['POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function delete(Request $request, Plush $plush, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$plush->getId(), $request->request->get('_token'))) {
            $entityManager->remove($plush);
            $entityManager->flush();
        }

        return $this->redirectToRoute('plush_index', [], Response::HTTP_SEE_OTHER);
    }
}
