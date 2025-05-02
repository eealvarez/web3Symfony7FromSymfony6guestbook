<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ConferenceController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function homepage(): Response
    {
        // return $this->render('conference/index.html.twig', [
        //     'controller_name' => 'ConferenceController',
        // ]);

        return new Response(
            <<<EOF
                    <html>
                        <body>
                            <img src="/images/under-construction.gif" />
                        </body>
                    </html>
                    EOF
        );
    }

    #[Route('/conference', name: 'conference')]
    public function conference(): Response
    {
        return $this->render('conference/index.html.twig', [
            'controller_name' => 'ConferenceController',
        ]);
    }

    #[Route('/saludo', name: 'saludo')]
    public function saludo(Request $request): Response
    {

        $greet = '';
        if ($name = $request->query->get('hello')) {
            $greet = sprintf('<h1>Hello %s!</h1>', htmlspecialchars($name));
        }

        return new Response(
            <<<EOF
                        <html>
                            <body>
                                $greet
                                <img src="/images/under-construction.gif" />
                            </body>
                        </html>
                        EOF
        );
    }


    #[Route('/hello/{name}', name: 'saludoParam')]
    public function saludoParam(string $name): Response
    {

        $greet = '';
        if ($name) {
            $greet = sprintf('<h1>Hello %s!</h1>', htmlspecialchars($name));
        }

        return new Response(
            <<<EOF
                        <html>
                            <body>
                                $greet
                                <img src="/images/under-construction.gif" />
                            </body>
                        </html>
                        EOF
        );
    }

    #[Route('/renderizar/{name}', name: 'renderizar')]
    public function renderizar(string $name): Response
    {
        return $this->render('conference/index.html.twig', [
            'controller_name' => $name,
        ]);
    }
}
