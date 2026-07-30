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
                'id' => 1,
                'nom' => 'Martin Dubois',
                'metier' => 'Jardinier',
                'ville' => 'Orléans',
                'note' => 4.5,
                'tarif_indicatif' => '35€/h',
                'url_photo_placeholder' => 'https://via.placeholder.com/150',
                'lat' => 47.9029,
                'lng' => 1.9093
            ],
            [
                'id'=> 2,
                'nom' => 'Sophie Lambert',
                'metier' => 'Plombier',
                'ville' => 'Fleury-lès-Aubrais',
                'note' => 4.8,
                'tarif_indicatif' => '45€/h',
                'url_photo_placeholder' => 'https://via.placeholder.com/150',
                'lat' => 47.9315,
                'lng' => 1.9235
            ],
            [
                'id'=> 3,
                'nom' => 'Karim Benali',
                'metier' => 'Électricien',
                'ville' => 'Olivet',
                'note' => 4.2,
                'tarif_indicatif' => '50€/h',
                'url_photo_placeholder' => 'https://via.placeholder.com/150',
                'lat' => 47.8608,
                'lng' => 1.9088
            ],
            [
                'id'=> 4,
                'nom' => 'Claire Petit',
                'metier' => 'Peintre',
                'ville' => 'Saint-Jean-de-Braye',
                'note' => 4.9,
                'tarif_indicatif' => '30€/h',
                'url_photo_placeholder' => 'https://via.placeholder.com/150',
                'lat' => 47.9214,
                'lng' => 1.9722
            ]
        ];

        return $this->render('search/results.html.twig', [
            'artisans' => $artisans,
            'search_query' => 'Jardinier à Orléans'
        ]);
    }

    #[Route('/artisan/{id}', name: 'app_artisan_profile')]
    public function artisanProfile($id): Response
    {
        // Hardcoded artisan profile for demonstration purposes
        $artisan = [
            'nom_entreprise' => 'Ma Petite Entreprise',
            'metier' => 'Jardinier',
            'description' => 'Nous sommes une entreprise de jardinage professionnelle.',
            'ville' => 'Orléans',
            'note' => 4.5,
            'tarif_indicatif' => '35€/h',
            'disponibilites' => [
                'Lundi' => '8:00 - 12:00, 14:00 - 18:00',
                'Mardi' => '9:00 - 13:00, 15:00 - 19:00',
                'Mercredi' => '10:00 - 14:00, 16:00 - 20:00'
            ],
            'avis' => [
                [
                    'nom_client' => 'Jean Dupont',
                    'note' => 5,
                    'commentaire' => 'Très professionnel et rapide.'
                ],
                [
                    'nom_client' => 'Marie Martin',
                    'note' => 4.8,
                    'commentaire' => 'Excellent travail, recommandé!'
                ],
                [
                    'nom_client' => 'Pierre Durand',
                    'note' => 4.2,
                    'commentaire' => 'Bon service, à améliorer.'
                ]
            ]
        ];

        return $this->render('artisan/profile.html.twig', [
            'artisan' => $artisan
        ]);
    }

    #[Route('/connexion', name: 'app_login')]
    public function login(): Response
    {
        return $this->render('security/login.html.twig');
    }
}
