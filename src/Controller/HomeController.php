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
        'nom' => 'Martin Dubois',
        'metier' => 'Jardinier',
        'ville' => 'Orléans',
        'note' => 4.5,
        'tarif_indicatif' => '35€/h',
        'url_photo_placeholder' => 'https://via.placeholder.com/150'
    ],
    [
        'nom' => 'Sophie Lambert',
        'metier' => 'Plombier',
        'ville' => 'Fleury-lès-Aubrais',
        'note' => 4.8,
        'tarif_indicatif' => '45€/h',
        'url_photo_placeholder' => 'https://via.placeholder.com/150'
    ],
    [
        'nom' => 'Karim Benali',
        'metier' => 'Électricien',
        'ville' => 'Olivet',
        'note' => 4.2,
        'tarif_indicatif' => '50€/h',
        'url_photo_placeholder' => 'https://via.placeholder.com/150'
    ],
    [
        'nom' => 'Claire Petit',
        'metier' => 'Peintre',
        'ville' => 'Saint-Jean-de-Braye',
        'note' => 4.9,
        'tarif_indicatif' => '30€/h',
        'url_photo_placeholder' => 'https://via.placeholder.com/150'
    ]
];

        return $this->render('search/results.html.twig', [
            'artisans' => $artisans,
	    'search_query' => 'Jardinier à Orléans'
        ]);
    }
}
