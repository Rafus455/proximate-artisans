<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
{
    $evenements = [
        [
            'image' => '/images/events/Match_FR_SERB_2026.png',
            'titre' => 'Salon des artisans locaux',
            'date' => '15 septembre 2026',
            'description' => 'Rencontrez les meilleurs artisans de votre région.'
        ],
        [
            'image' => '/images/events/rencontres_aero_2026.png',
            'titre' => 'Journée portes ouvertes',
            'date' => '3 octobre 2026',
            'description' => 'Découvrez les ateliers de nos artisans partenaires.'
        ],
        [
            'image' => '/images/events/Salon_MIVL_2026.jpg',
            'titre' => 'Formation hygiène et sécurité',
            'date' => '20 octobre 2026',
            'description' => 'Session gratuite ouverte à tous les professionnels inscrits.'
        ],
        [
            'image' => '/images/events/Tour Vibration 2026.png',
            'titre' => 'Musique',
            'date' => '31 octobre 2026',
            'description' => 'Session gratuite ouverte à tous les inscrits.'
        ],
    ];

    return $this->render('home/index.html.twig', [
        'evenements' => $evenements
    ]);
}

    #[Route('/recherche', name: 'app_search')]
    public function search(): Response
    {
        $artisans = [
          [
            'id' => 1,
            'nom' => 'Stop0Guêpes',
            'metier' => 'Dératisation / Désinsectisation',
            'ville' => 'Orléans',
            'url_photo_placeholder' => 'https://via.placeholder.com/150',
            'lat' => 47.9029,
            'lng' => 1.9093
        ],
            [
                'id'=> 2,
                'nom' => 'Sophie Lambert',
                'metier' => 'Plombier',
                'ville' => 'Fleury-lès-Aubrais',
                'url_photo_placeholder' => 'https://via.placeholder.com/150',
                'lat' => 47.9315,
                'lng' => 1.9235
            ],
            [
                'id'=> 3,
                'nom' => 'Karim Benali',
                'metier' => 'Électricien',
                'ville' => 'Olivet',
                'url_photo_placeholder' => 'https://via.placeholder.com/150',
                'lat' => 47.8608,
                'lng' => 1.9088
            ],
            [
                'id'=> 4,
                'nom' => 'Claire Petit',
                'metier' => 'Peintre',
                'ville' => 'Saint-Jean-de-Braye',
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

    #[Route('/devenir-artisan', name: 'app_become_artisan')]
    public function becomeArtisan(Request $request, MailerInterface $mailer): Response
    {
        $errors = [];
        $success = false;

        if ($request->isMethod('POST')) {
            $companyName = trim($request->request->get('company_name', ''));
            $trade = trim($request->request->get('trade', ''));
            $city = trim($request->request->get('city', ''));
            $postalCode = trim($request->request->get('postal_code', ''));
            $rate = trim($request->request->get('rate', ''));
            $description = trim($request->request->get('description', ''));
            $email = trim($request->request->get('email', ''));
            $phone = trim($request->request->get('phone', ''));

            if ($companyName === '') { $errors[] = "Le nom de l'entreprise est requis."; }
            if ($trade === '') { $errors[] = "Le métier est requis."; }
            if ($city === '') { $errors[] = "La ville est requise."; }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { $errors[] = "L'email n'est pas valide."; }

            if (empty($errors)) {
                $emailMessage = (new Email())
                    ->from('no-reply@ouvrage.fr')
                    ->to('contact@ouvrage.fr')
                    ->replyTo($email)
                    ->subject('Nouvelle candidature artisan : ' . $companyName)
                    ->text(
                        "Nouvelle demande d'inscription artisan\n\n" .
                        "Entreprise : {$companyName}\n" .
                        "Métier : {$trade}\n" .
                        "Ville : {$city}\n" .
                        "Code postal : {$postalCode}\n" .
                        "Tarif indicatif : {$rate}\n" .
                        "Email : {$email}\n" .
                        "Téléphone : {$phone}\n\n" .
                        "Description :\n{$description}"
                    );

                $mailer->send($emailMessage);
                $success = true;
            }
        }

        return $this->render('artisan/become.html.twig', [
            'errors' => $errors,
            'success' => $success,
        ]);
    }

    #[Route('/entreprise/sc3d', name: 'app_entreprise_sc3d')]
    public function entrepriseSc3d(): Response
    {
        return $this->render('entreprise/sc3d.html.twig');
    }
}
