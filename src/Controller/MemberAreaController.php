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

#[Route('/account')]
class MemberAreaController extends AbstractController
{
    #[Route('/', name: 'member_area_index', methods: ['GET'])]
    public function index(ManagerRegistry $doctrine, Request $request): Response
    {
        $user = $this->getUser();

        if ($user) {
            $wantedGeneration = $request->query->get('option');
            $entityManager = $doctrine->getManager();
            $plushies = $entityManager->getRepository(Plush::class)->findBy(['createdBy' => $user]);
            return $this->render(
                'member_area/index.html.twig',
                [ 'plushies' => $plushies,
                    'wantedGeneration' => $wantedGeneration ]
            );
        } else {
            return $this->redirectToRoute('app_login');
        }

    }
}
