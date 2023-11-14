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
            $role = $user->getRoles();
            $entityManager = $doctrine->getManager();
            $plushies = $entityManager->getRepository(Plush::class)->findBy(['createdBy' => $user->getUserIdentifier()]);
            $all_plushies = $plushies;
            $admin = 'no';
            if (in_array("ROLE_ADMIN", $role)) {
                $all_plushies = $entityManager->getRepository(Plush::class)->findAll();
                $admin = 'yes';
            }
            return $this->render(
                'member_area/index.html.twig',
                [   'plushies' => $plushies,
                    'all_plushies' => $all_plushies,
                    'admin' => $admin,
                    'email' => $user->getUserIdentifier(),
                    'wantedGeneration' => $wantedGeneration ]
            );
        } else {
            return $this->redirectToRoute('app_login');
        }

    }
}
