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

        $entityManager = $doctrine->getManager();
        $plushies = $entityManager->getRepository(Plush::class)->findAll();
        foreach($plushies as $plush) {
            $url = $this->generateUrl(
                'plush_show',
                ['id' => $plush->getId()]
            );
            $htmlpage .= '<li><a href="' . $url . '">' . $plush->getName() . '</a></li>';
        }
        $htmlpage .= '</ul></body></html>';

        return new Response(
            $htmlpage,
            Response::HTTP_OK,
            array('content-type' => 'text/html')
        );
    }

    #[Route('/{id}', name: 'plush_show', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function showAction(Plush $plush): Response
    {
        $htmlpage = '
        <!DOCTYPE html>
        <html>
            <head>
                <meta charset="UTF-8">
                <title>'.$plush->getName().'</title>
            </head>
            <body>
                <h2>Détails de la peluche</h2>
                <ul>
                <dl>
                    <dt>Peluche</dt>
                    <dd>'.$plush->getName().'</dd>
                    <dt>Prix</dt>
                    <dd>'.$plush->getPrice().'</dd>
                    <dt>Height</dt>
                    <dd>'.$plush->getHeight().'</dd>
                    <dt>Génération</dt>
                    <dd>'.$plush->getGeneration().'</dd>
                    <dt>Note</dt>
                    <dd>'.$plush->getNote().'</dd>
        ';

        return new Response(
            $htmlpage,
            Response::HTTP_OK,
            array('content-type' => 'text/html')
        );
    }
}
