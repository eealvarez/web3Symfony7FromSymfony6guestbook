<?php

namespace App\Controller;

use App\Entity\Cliente;
use App\Form\ClienteTypeForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;

final class ClienteController extends AbstractController
{

    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {}

    #[Route('/cliente', name: 'app_cliente')]
    public function index(Request $request, Cliente $cliente): Response
    {

        $categorias = [
            'categoria1' => '1',
            'categoria2' => '2',
            'categoria3' => '3',
        ];

        $form = $this->createForm(ClienteTypeForm::class, $cliente, [
            'categorias' => $categorias,
            'isEdit' => true,
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cliente = $form->getData();
            $this->entityManager->persist($cliente);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_cliente');
        }

        // dump($request);

        // $form->handleRequest($request);

        // $data = $form->getData();

        // dd($data);

        return $this->render('cliente/index.html.twig', [
            'clientForm' => $form->createView(),
        ]);
    }
}
