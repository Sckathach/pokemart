<?php

namespace App\Controller;

use App\Entity\Comment;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {
        $userIp = $request->getClientIp();
        $entityManager = $doctrine->getManager();
        $comments = $entityManager->getRepository(Comment::class)->findAll();

        return $this->render('index/index.html.twig', [
            'userIp' => $userIp,
            'comments' => $comments,
        ]);
    }

    #[Route('/template', name: 'template')]
    public function template(): Response
    {
        return $this->render('template.html.twig');
    }
}
