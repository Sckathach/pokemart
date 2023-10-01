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
        $htmlpage = ' 
            <!DOCTYPE html>
            <html>
                <head>
                    <meta charset="UTF-8">
                    <title>Bienvenue !</title>
                </head>
                <body>
                    <h1>Bienvenue !</h1>
                </body>
            </html>
        ';
        return new Response(
            $htmlpage,
            Response::HTTP_OK,
            array('content-type' => 'text/html')
        );
    }

    #[Route('/list', name: 'plush_list', methods: ['GET'])]
    #[Route('/index', name: 'plush_index', methods: ['GET'])]
    public function listAction(ManagerRegistry $doctrine): Response
    {
        $htmlpage = '
        <!DOCTYPE html>
        <html>
            <head>
                <meta charset="UTF-8">
                <title>Peluches</title>
            </head>
            <body>
                <h1>Liste des peluches</h1>
                <ul>
        ';
    }
}
