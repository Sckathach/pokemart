<?php

namespace App\Controller;

use App\Entity\Plush;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/plush')]
class PlushController extends AbstractController
{
    #[Route('/', name: 'home', methods: ['GET'])]
    public function indexAction(): Response
    {
        return $this->render(
          'plush/index.html.twig',
          [ 'name' => 'bonsoir' ]
        );
    }

    #[Route('/list', name: 'plush_list', methods: ['GET'])]
    #[Route('/index', name: 'plush_index', methods: ['GET'])]
    public function listAction(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $plushies = $entityManager->getRepository(Plush::class)->findAll();
        return $this->render(
            'plush/plush_list.html.twig',
            [ 'plushies' => $plushies ]
        );
    }

    #[Route('/{id}', name: 'plush_show', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function showAction(Plush $plush): Response
    {
        return $this->render(
            'plush/plush_show.html.twig',
            [ 'plush' => $plush ]
        );
    }
}
