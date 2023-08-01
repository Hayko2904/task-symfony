<?php

namespace App\Controller;

use App\Repository\IntervalsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use function Symfony\Component\String\length;

class RangeController extends AbstractController
{
    protected $intervalsRepository;

    public function __construct(
        IntervalsRepository $intervalsRepository
    )
    {
        $this->intervalsRepository = $intervalsRepository;
    }

    #[Route(path: '/find_range', name: 'app_range', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('range/index.html.twig', [
            'controller_name' => 'RangeController',
        ]);
    }

    #[Route(path: '/check_range', name: 'check_range', methods: ['GET'])]
    public function checkRange(Request $request): Response
    {
        if (strlen($request->get('range')) > 19) {
            return new Response(
                'Big number',
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        $response = $this->intervalsRepository->findRange($request->get('range'));

        if (!is_null($response) && count($response)) {
            return new Response(
                $response['id'],
                Response::HTTP_OK
            );
        }

        return new Response(
            'Not found',
            Response::HTTP_INTERNAL_SERVER_ERROR
        );
    }
}
