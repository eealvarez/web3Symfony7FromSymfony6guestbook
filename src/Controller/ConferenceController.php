<?php

namespace App\Controller;

use App\Entity\Conference;
use App\Repository\CommentRepository;
use App\Repository\ConferenceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;

final class ConferenceController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function homepage(ConferenceRepository $conferenceRepository, SessionInterface $session): Response
    {

        $session->set('prueba', 'Hola mundo');
        dump($session->get('prueba'));

        $conferences = $conferenceRepository->findAll();

        return $this->render('conference/index.html.twig', [
            'controller_name' => 'ConferenceController',
            'conferences' => $conferences,
        ]);

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



    #[Route('/conference/{slug}', name: 'conference')]
    public function show(Request $request, CommentRepository $commentRepository, #[MapEntity(mapping: ['slug' => 'slug'])] Conference $conference): Response
    {

        // $offset = max(value1: 0, $request->query->getInt(key: 'offset', default: 0)); //eso es lo que significan los 2 parámetros dentro del método getInt();
        $offset = max(0, $request->query->getInt('offset', 0));

        $paginator = $commentRepository->getCommentPaginator($conference, $offset);

        // $comments = $conference->getComments();
        // $comments = $commentRepository->findBy(
        //     ['conference' => $conference],
        //     ['createdAt' => 'DESC'],
        // );

        return $this->render('conference/show.html.twig', [
            'conference' => $conference,
            'comments' => $paginator,
            'previous' => $offset - CommentRepository::PAGINATOR_PER_PAGE,
            'next' => min(count($paginator), $offset + CommentRepository::PAGINATOR_PER_PAGE),

        ]);
    }



    #[Route('/conferencia', name: 'conferencia')]
    public function conference(): Response
    {
        return $this->render('conference/index.html.twig', [
            'controller_name' => 'ConferenceController',
            'conferences' => 'Conferencias',
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
