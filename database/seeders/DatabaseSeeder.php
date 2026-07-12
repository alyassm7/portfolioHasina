<?php

namespace Database\Seeders;

use App\Models\Education;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Setting;
use App\Models\Skill;
use App\Models\Testimonial;
use App\Models\User;
use App\Support\LocaleContent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@hasina.dev'],
            [
                'name' => 'Ralison Hasiniaina Aimée Samuëla',
                'password' => Hash::make('password'),
                'is_admin' => true,
            ]
        );

        $t = fn (string $fr, string $en) => LocaleContent::encode($fr, $en);
        $list = fn (array $fr, array $en) => LocaleContent::encodeList($fr, $en);

        $settings = [
            'site_name' => 'Ralison Hasiniaina Aimée Samuëla',
            'site_title' => $t(
                'Support Informatique & Gestion de Parc IT | Laravel',
                'IT Support & IT Asset Management | Laravel'
            ),
            'hero_greeting' => $t('Bonjour,', 'Hello,'),
            'hero_name' => 'Ralison Hasiniaina Aimée Samuëla',
            'hero_roles' => $t(
                'Support Utilisateur,Gestionnaire de Parc Informatique,Développeur Web Laravel',
                'User Support,IT Asset Manager,Laravel Web Developer'
            ),
            'about_text' => $t(
                "Professionnelle de l'informatique titulaire d'un Master II de l'École Nationale d'Informatique (ENI), j'occupe le poste de Support Utilisateur & Gestionnaire de Parc Informatique à l'ONG PIVOT. J'assure le support technique, la gestion du parc IT et le développement de solutions Laravel pour optimiser les processus informatiques.",
                'IT professional with a Master II from the National School of Informatics (ENI), I work as User Support & IT Asset Manager at NGO PIVOT. I provide technical support, IT asset management, and Laravel development to optimize IT processes.'
            ),
            'about_photo' => 'images/profile.svg',
            'hero_photo' => 'images/hero-bg.svg',
            'experience_years' => '2+',
            'stat_projects' => '10',
            'stat_commits' => '500',
            'stat_technologies' => '100',
            'stat_motivation' => '3',
            'github_url' => 'https://github.com/alyassm7',
            'linkedin_url' => 'https://linkedin.com/in/hasina',
            'email' => 'hasinaralison7@gmail.com',
            'phone' => '038 05 244 05',
            'cv_path' => 'cv/CV-Hasina-Samuela.pdf',
            'meta_description' => $t(
                'Portfolio de Ralison Hasiniaina Aimée Samuëla - Support Informatique, Gestion de Parc IT et Développement Laravel à Madagascar.',
                'Portfolio of Ralison Hasiniaina Aimée Samuëla - IT Support, IT Asset Management and Laravel Development in Madagascar.'
            ),
            'meta_keywords' => 'Laravel, PHP, MySQL, Support Informatique, Gestion Parc Informatique, ONG PIVOT, ENI, Madagascar',
        ];

        foreach ($settings as $key => $value) {
            Setting::set($key, $value);
        }

        $skills = [
            ['name' => $t('Support utilisateur', 'User support'), 'percentage' => 95, 'icon' => 'fas fa-headset', 'category' => $t('Support IT', 'IT Support')],
            ['name' => $t('Gestion de parc IT', 'IT asset management'), 'percentage' => 95, 'icon' => 'fas fa-laptop', 'category' => $t('Support IT', 'IT Support')],
            ['name' => 'Laravel', 'percentage' => 90, 'icon' => 'fab fa-laravel', 'category' => $t('Développement', 'Development')],
            ['name' => 'PHP', 'percentage' => 90, 'icon' => 'fab fa-php', 'category' => $t('Développement', 'Development')],
            ['name' => 'MySQL', 'percentage' => 88, 'icon' => 'fas fa-database', 'category' => $t('Bases de données', 'Databases')],
            ['name' => 'JavaScript', 'percentage' => 85, 'icon' => 'fab fa-js', 'category' => $t('Développement', 'Development')],
            ['name' => 'Symfony', 'percentage' => 80, 'icon' => 'fab fa-symfony', 'category' => $t('Développement', 'Development')],
            ['name' => $t('Git & GitHub', 'Git & GitHub'), 'percentage' => 90, 'icon' => 'fab fa-github', 'category' => $t('Outils', 'Tools')],
            ['name' => $t('Linux (Debian)', 'Linux (Debian)'), 'percentage' => 78, 'icon' => 'fab fa-linux', 'category' => $t('Systèmes', 'Systems')],
            ['name' => 'Windows', 'percentage' => 92, 'icon' => 'fab fa-windows', 'category' => $t('Systèmes', 'Systems')],
        ];

        Skill::query()->delete();
        foreach ($skills as $i => $skill) {
            Skill::create(array_merge($skill, ['order' => $i + 1]));
        }

        $projects = [
            [
                'title' => $t('Gestion Parc Informatique', 'IT Asset Management'),
                'slug' => 'gestion-parc-informatique',
                'description' => $t(
                    'Application complète de gestion des équipements informatiques avec QR Code, check-in/check-out et statistiques en temps réel.',
                    'Complete IT equipment management application with QR Code, check-in/check-out and real-time statistics.'
                ),
                'technologies' => ['Laravel', 'Livewire', 'Bootstrap', 'MySQL'],
                'features' => $list(
                    ['Gestion des équipements', 'QR Code', 'Check In / Check Out', 'Statistiques'],
                    ['Equipment management', 'QR Code', 'Check In / Check Out', 'Statistics']
                ),
                'github_url' => 'https://github.com/alyassm7',
                'demo_url' => '#',
                'is_featured' => true,
                'order' => 1,
            ],
            [
                'title' => $t('Gestion Flotte SIM', 'SIM Fleet Management'),
                'slug' => 'gestion-flotte-sim',
                'description' => $t(
                    'Système de suivi et gestion des cartes SIM de l\'entreprise.',
                    'System for tracking and managing company SIM cards.'
                ),
                'technologies' => ['Laravel', 'MySQL', 'Bootstrap'],
                'features' => $list(
                    ['Inventaire SIM', 'Attribution', 'Historique'],
                    ['SIM inventory', 'Assignment', 'History']
                ),
                'github_url' => '#',
                'demo_url' => '#',
                'is_featured' => false,
                'order' => 2,
            ],
            [
                'title' => $t('Dashboard Odoo', 'Odoo Dashboard'),
                'slug' => 'dashboard-odoo',
                'description' => $t(
                    'Tableau de bord personnalisé intégré avec Odoo pour le suivi des indicateurs.',
                    'Custom dashboard integrated with Odoo for KPI tracking.'
                ),
                'technologies' => ['Odoo', 'Python', 'JavaScript'],
                'features' => $list(
                    ['KPIs', 'Rapports', 'Intégration API'],
                    ['KPIs', 'Reports', 'API integration']
                ),
                'github_url' => '#',
                'demo_url' => '#',
                'is_featured' => false,
                'order' => 3,
            ],
            [
                'title' => $t('Galerie ONG Pivot', 'NGO Pivot Gallery'),
                'slug' => 'galerie-ong-pivot',
                'description' => $t(
                    'Galerie photo et gestion de médias pour l\'ONG Pivot.',
                    'Photo gallery and media management for NGO Pivot.'
                ),
                'technologies' => ['Laravel', 'Bootstrap', 'MySQL'],
                'features' => $list(
                    ['Upload images', 'Catégories', 'Lightbox'],
                    ['Image upload', 'Categories', 'Lightbox']
                ),
                'github_url' => '#',
                'demo_url' => '#',
                'is_featured' => false,
                'order' => 4,
            ],
            [
                'title' => $t('Gestion des Tickets', 'Ticket Management'),
                'slug' => 'gestion-tickets',
                'description' => $t(
                    'Système de tickets de support informatique avec priorités et assignation.',
                    'IT support ticket system with priorities and assignment.'
                ),
                'technologies' => ['Laravel', 'Livewire', 'MySQL'],
                'features' => $list(
                    ['Tickets', 'Priorités', 'Notifications'],
                    ['Tickets', 'Priorities', 'Notifications']
                ),
                'github_url' => '#',
                'demo_url' => '#',
                'is_featured' => false,
                'order' => 5,
            ],
            [
                'title' => $t('Gestion des Utilisateurs', 'User Management'),
                'slug' => 'gestion-utilisateurs',
                'description' => $t(
                    'Module de gestion des utilisateurs avec rôles et permissions.',
                    'User management module with roles and permissions.'
                ),
                'technologies' => ['Laravel', 'MySQL', 'Bootstrap'],
                'features' => $list(
                    ['Rôles', 'Permissions', 'Audit log'],
                    ['Roles', 'Permissions', 'Audit log']
                ),
                'github_url' => '#',
                'demo_url' => '#',
                'is_featured' => false,
                'order' => 6,
            ],
        ];

        foreach ($projects as $project) {
            $features = $project['features'];
            unset($project['features']);
            Project::updateOrCreate(['slug' => $project['slug']], array_merge($project, [
                'features' => json_decode($features, true),
            ]));
        }

        Experience::query()->delete();

        $experiences = [
            [
                'year' => $t('2024 – Auj.', '2024 – Present'),
                'title' => $t('Support Utilisateur & Gestionnaire de Parc Informatique', 'User Support & IT Asset Manager'),
                'company' => $t('ONG PIVOT – Madagascar', 'NGO PIVOT – Madagascar'),
                'description' => $t(
                    'Assistance et support technique aux utilisateurs. Gestion du parc informatique et des actifs IT. Installation, configuration et maintenance des ordinateurs. Inventaire et suivi des équipements. Gestion des cartes SIM. Diagnostic et résolution des incidents. Développement d\'outils internes avec Laravel.',
                    'User assistance and technical support. IT asset and equipment management. Computer installation, configuration and maintenance. Equipment inventory and tracking. SIM card management. Incident diagnosis and resolution. Internal tool development with Laravel.'
                ),
                'order' => 1,
            ],
            [
                'year' => '2023',
                'title' => $t('Développeuse Shopify', 'Shopify Developer'),
                'company' => 'Ferber Enterprises',
                'description' => $t(
                    'Développement et maintenance de boutiques Shopify. Personnalisation de thèmes et optimisation des performances.',
                    'Shopify store development and maintenance. Theme customization and performance optimization.'
                ),
                'order' => 2,
            ],
            [
                'year' => '2023',
                'title' => $t('Stagiaire Ingénieure Développeuse Web', 'Web Developer Intern'),
                'company' => 'MANAO',
                'description' => $t(
                    'Maintenance, correction de bugs et développement d\'applications web.',
                    'Maintenance, bug fixing and web application development.'
                ),
                'order' => 3,
            ],
            [
                'year' => '2022',
                'title' => $t('Projet BIANCO – Gestion des activités des services', 'BIANCO Project – Service Activity Management'),
                'company' => $t('Stage académique', 'Academic internship'),
                'description' => $t(
                    'Application de gestion des activités des services développée en Java Swing.',
                    'Service activity management application developed in Java Swing.'
                ),
                'order' => 4,
            ],
            [
                'year' => $t('2019 – 2020', '2019 – 2020'),
                'title' => $t('Projet INSTAT – Gestion des stagiaires', 'INSTAT Project – Intern Management'),
                'company' => $t('Stage académique', 'Academic internship'),
                'description' => $t(
                    'Application de gestion des stagiaires développée avec Angular et JavaScript.',
                    'Intern management application developed with Angular and JavaScript.'
                ),
                'order' => 5,
            ],
            [
                'year' => 'ENI',
                'title' => $t('Système de pointage des étudiants', 'Student Attendance System'),
                'company' => $t('Projet académique – ENI', 'Academic project – ENI'),
                'description' => $t(
                    'Système de pointage des étudiants développé en PHP avec Arduino.',
                    'Student attendance system developed in PHP with Arduino.'
                ),
                'order' => 6,
            ],
        ];

        foreach ($experiences as $exp) {
            Experience::create($exp);
        }

        Education::query()->delete();

        $educations = [
            [
                'title' => $t('Master II Professionnel', 'Professional Master II'),
                'institution' => $t('École Nationale d\'Informatique (ENI)', 'National School of Informatics (ENI)'),
                'year' => '',
                'description' => $t(
                    'Formation en ingénierie informatique et développement de solutions logicielles.',
                    'Training in computer engineering and software solution development.'
                ),
                'order' => 1,
            ],
            [
                'title' => $t('Licence Professionnelle', 'Professional Bachelor\'s Degree'),
                'institution' => $t('École Nationale d\'Informatique (ENI)', 'National School of Informatics (ENI)'),
                'year' => '',
                'description' => $t(
                    'Parcours professionnel en informatique et développement web.',
                    'Professional track in IT and web development.'
                ),
                'order' => 2,
            ],
            [
                'title' => $t('Baccalauréat Série C', 'High School Diploma – Science C'),
                'institution' => $t('Lycée Raherivelo Ramamonjy', 'Raherivelo Ramamonjy High School'),
                'year' => '',
                'description' => null,
                'order' => 3,
            ],
        ];

        foreach ($educations as $edu) {
            Education::create($edu);
        }

        $testimonials = [
            [
                'name' => 'Jean',
                'role' => $t('Responsable IT', 'IT Manager'),
                'content' => $t(
                    'Excellent développeur. Très professionnel dans la gestion du parc informatique.',
                    'Excellent developer. Very professional in IT asset management.'
                ),
                'rating' => 5,
                'order' => 1,
            ],
            [
                'name' => 'Marie',
                'role' => $t('Collègue', 'Colleague'),
                'content' => $t(
                    'Toujours disponible pour le support utilisateur. Un vrai atout pour l\'équipe.',
                    'Always available for user support. A real asset to the team.'
                ),
                'rating' => 5,
                'order' => 2,
            ],
        ];

        Testimonial::query()->delete();
        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
