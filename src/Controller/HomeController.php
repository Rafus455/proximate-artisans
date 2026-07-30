<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/recherche', name: 'app_search')]
    public function search(): Response
    {
        $artisans = [
            [
                'nom' => 'Artisan 1',
                'metier' => 'Métier 1',
                'ville' => 'Ville 1',
                'note' => 4.5,
                'tarif_indicatif' => '€100/h',
                'url_photo_placeholder' => 'https://via.placeholder.com/150'
            ],
            [
                'nom' => 'Artisan 2',
                'metier' => 'Métier 2',
                'ville' => 'Ville 2',
                'note' => 4.8,
                'tarif_indicatif' => '€120/h',
                'url_photo_placeholder' => 'https://via.placeholder.com/150'
            ],
            [
                'nom' => 'Artisan 3',
                'metier' => 'Métier 3',
                'ville' => 'Ville 3',
                'note' => 4.2,
                'tarif_indicatif' => '€90/h',
                'url_photo_placeholder' => 'https://via.placeholder.com/150'
            ],
            [
                'nom' => 'Artisan 4',
                'metier' => 'Métier 4',
                'ville' => 'Ville 4',
                'note' => 4.9,
                'tarif_indicatif' => '€130/h',
                'url_photo_placeholder' => 'https://via.placeholder.com/150'
            ]
        ];

        return $this->render('search/results.html.twig', [
            'artisans' => $artisans
        ]);
    }
}
