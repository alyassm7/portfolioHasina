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
                'Process, Tools & Performance IT | Support & Laravel',
                'Process, Tools & Performance IT | Support & Laravel'
            ),
            'hero_greeting' => $t('Bonjour,', 'Hello,'),
            'hero_name' => 'Ralison Hasiniaina Aimée Samuëla',
            'hero_roles' => $t(
                'Process Tools & Performance,Support Utilisateur,Gestionnaire de Parc IT,Odoo (Appro / Entrepôt),Développeuse Laravel',
                'Process Tools & Performance,User Support,IT Asset Manager,Odoo (Purchase / Warehouse),Laravel Developer'
            ),
            'about_text' => $t(
                "Professionnelle de l'informatique titulaire d'un Master II de l'École Nationale d'Informatique (ENI), j'occupe le poste de Support Utilisateur & Gestionnaire de Parc Informatique à l'ONG PIVOT. Je combine support technique, gestion du parc IT, Odoo (développement + Approvisionnement, Entrepôt, Contacts), suivi des incidents/SLA et développement Laravel pour structurer les processus, automatiser les outils et améliorer la performance des équipes IT.",
                'IT professional with a Master II from the National School of Informatics (ENI), I work as User Support & IT Asset Manager at NGO PIVOT. I combine technical support, IT asset management, Odoo (development + Purchase, Warehouse, Contacts), incident/SLA tracking and Laravel development to structure processes, automate tools and improve IT team performance.'
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
            'meta_keywords' => 'Laravel, PHP, MySQL, Process Tools Performance, SLA, Zabbix, Grafana, Support Informatique, Gestion Parc Informatique, Yas Madagascar, ONG PIVOT, ENI',
        ];

        foreach ($settings as $key => $value) {
            Setting::set($key, $value);
        }

        $skills = [
            ['name' => $t('Support utilisateur', 'User support'), 'percentage' => 95, 'icon' => 'fas fa-headset', 'category' => $t('Support IT', 'IT Support')],
            ['name' => $t('Gestion de parc IT', 'IT asset management'), 'percentage' => 95, 'icon' => 'fas fa-laptop', 'category' => $t('Support IT', 'IT Support')],
            ['name' => $t('Gestion des incidents & SLA', 'Incident & SLA management'), 'percentage' => 90, 'icon' => 'fas fa-ticket-alt', 'category' => $t('Process & Performance', 'Process & Performance')],
            ['name' => $t('KPI & tableaux de bord', 'KPI & dashboards'), 'percentage' => 88, 'icon' => 'fas fa-chart-line', 'category' => $t('Process & Performance', 'Process & Performance')],
            ['name' => $t('Amélioration continue', 'Continuous improvement'), 'percentage' => 85, 'icon' => 'fas fa-sync-alt', 'category' => $t('Process & Performance', 'Process & Performance')],
            ['name' => 'Odoo', 'percentage' => 85, 'icon' => 'fas fa-cubes', 'category' => $t('ERP & Métier', 'ERP & Business')],
            ['name' => $t('Approvisionnement Odoo', 'Odoo Purchase'), 'percentage' => 82, 'icon' => 'fas fa-shopping-cart', 'category' => $t('ERP & Métier', 'ERP & Business')],
            ['name' => $t('Entrepôt & Stocks Odoo', 'Odoo Warehouse & Stock'), 'percentage' => 82, 'icon' => 'fas fa-warehouse', 'category' => $t('ERP & Métier', 'ERP & Business')],
            ['name' => 'Python', 'percentage' => 78, 'icon' => 'fab fa-python', 'category' => $t('Développement', 'Development')],
            ['name' => 'Laravel', 'percentage' => 90, 'icon' => 'fab fa-laravel', 'category' => $t('Développement', 'Development')],
            ['name' => 'PHP', 'percentage' => 90, 'icon' => 'fab fa-php', 'category' => $t('Développement', 'Development')],
            ['name' => 'MySQL', 'percentage' => 88, 'icon' => 'fas fa-database', 'category' => $t('Bases de données', 'Databases')],
            ['name' => 'Livewire', 'percentage' => 82, 'icon' => 'fas fa-bolt', 'category' => $t('Développement', 'Development')],
            ['name' => 'JavaScript / Chart.js', 'percentage' => 85, 'icon' => 'fab fa-js', 'category' => $t('Développement', 'Development')],
            ['name' => $t('Supervision (Zabbix)', 'Monitoring (Zabbix)'), 'percentage' => 75, 'icon' => 'fas fa-server', 'category' => $t('Outils & Supervision', 'Tools & Monitoring')],
            ['name' => 'Grafana', 'percentage' => 72, 'icon' => 'fas fa-chart-area', 'category' => $t('Outils & Supervision', 'Tools & Monitoring')],
            ['name' => $t('REST API', 'REST API'), 'percentage' => 80, 'icon' => 'fas fa-plug', 'category' => $t('Outils & Supervision', 'Tools & Monitoring')],
            ['name' => $t('Git & GitHub', 'Git & GitHub'), 'percentage' => 90, 'icon' => 'fab fa-github', 'category' => $t('Outils', 'Tools')],
            ['name' => $t('Linux (Debian)', 'Linux (Debian)'), 'percentage' => 78, 'icon' => 'fab fa-linux', 'category' => $t('Systèmes', 'Systems')],
            ['name' => 'Windows', 'percentage' => 92, 'icon' => 'fab fa-windows', 'category' => $t('Systèmes', 'Systems')],
            ['name' => 'Docker', 'percentage' => 70, 'icon' => 'fab fa-docker', 'category' => $t('Outils', 'Tools')],
        ];

        Skill::query()->delete();
        foreach ($skills as $i => $skill) {
            Skill::create(array_merge($skill, ['order' => $i + 1]));
        }

        $bi = fn (string $fr, string $en) => ['fr' => $fr, 'en' => $en];
        $biList = fn (array $fr, array $en) => ['fr' => $fr, 'en' => $en];

        $projects = [
            [
                'title' => $t('IT Process & Performance Hub', 'IT Process & Performance Hub'),
                'slug' => 'it-process-performance-hub',
                'description' => $t(
                    'Plateforme web moderne de gestion, supervision et amélioration des processus IT : incidents, SLA, KPI, automatisations, documentation HSSE et intégrations Zabbix / Grafana. Conçue pour démontrer les compétences d’un Process, Tools & Performance Assistant (contexte télécom / Yas Madagascar).',
                    'Modern web platform for IT process management, supervision and continuous improvement: incidents, SLAs, KPIs, automations, HSSE documentation and Zabbix / Grafana integrations. Designed to demonstrate Process, Tools & Performance Assistant skills (telecom / Yas Madagascar context).'
                ),
                'technologies' => ['Laravel', 'PHP 8.2', 'MySQL', 'Livewire', 'Bootstrap', 'Chart.js', 'REST API', 'Zabbix', 'Grafana', 'Docker', 'Git'],
                'features' => $list(
                    [
                        'Dashboard performance IT & KPI',
                        'Gestion des incidents & SLA',
                        'Supervision Zabbix + dashboards Grafana',
                        'Automatisations, processus & documentation HSSE',
                        'Plans d’action & audit des processus',
                        'Rôles : Admin, IT Manager, Technicien, Process Manager',
                    ],
                    [
                        'IT performance dashboard & KPIs',
                        'Incident & SLA management',
                        'Zabbix monitoring + Grafana dashboards',
                        'Automations, processes & HSSE documentation',
                        'Action plans & process audits',
                        'Roles: Admin, IT Manager, Technician, Process Manager',
                    ]
                ),
                'case_study' => [
                    'subtitle' => $bi(
                        'Supervision, automatisation, processus et performance IT',
                        'IT supervision, automation, processes and performance'
                    ),
                    'problem' => $bi(
                        "Dans un environnement télécom/IT, les équipes jonglent souvent entre outils dispersés : tickets sans SLA clair, supervision séparée, documentation peu versionnée et peu de KPI actionnables. Cela ralentit la résolution, complique le reporting et freine l’amélioration continue.",
                        'In a telecom/IT environment, teams often juggle scattered tools: tickets without clear SLAs, siloed monitoring, poorly versioned documentation and few actionable KPIs. This slows resolution, complicates reporting and hinders continuous improvement.'
                    ),
                    'solution' => $bi(
                        "IT Process & Performance Hub centralise la supervision, le suivi des incidents, le management des SLA, les automatisations, la documentation des processus/HSSE et les tableaux de bord KPI. L’objectif : standardiser les procédures, mesurer la performance du support et transformer les écarts en plans d’action.",
                        'IT Process & Performance Hub centralizes monitoring, incident tracking, SLA management, automations, process/HSSE documentation and KPI dashboards. The goal: standardize procedures, measure support performance and turn gaps into action plans.'
                    ),
                    'modules' => $biList(
                        [
                            'Dashboard Performance IT — tickets, SLA, disponibilité, MTTR, tendances Chart.js',
                            'Gestion des incidents — priorités, impact, technicien, commentaires, pièces jointes, historique',
                            'SLA Management — Critique 4h / Haute 8h / Moyenne 24h / Faible 48h + alertes',
                            'Supervision IT — architecture API Zabbix (CPU, RAM, stockage, alertes)',
                            'Monitoring Grafana — page dédiée aux dashboards d’infrastructure',
                            'Automatisations — seuils SLA, tickets auto, emails critiques, rapports hebdo',
                            'Processus IT — étapes, entrées/sorties, outils, KPI, versioning',
                            'Documentation IT / HSSE — PDF/Word/Excel, validation, publication, recherche',
                            'KPI & Performance — MTTR, MTTA, disponibilité, backlog, satisfaction',
                            'Plan d’action — cycle PROBLÈME → ANALYSE → ACTION → SUIVI → VALIDATION',
                            'Audit des processus — conformité, observations, actions correctives',
                            'Utilisateurs & rôles — Administrateur, IT Manager, Technicien, Process Manager, Utilisateur',
                        ],
                        [
                            'IT Performance Dashboard — tickets, SLAs, availability, MTTR, Chart.js trends',
                            'Incident management — priority, impact, technician, comments, attachments, history',
                            'SLA Management — Critical 4h / High 8h / Medium 24h / Low 48h + alerts',
                            'IT monitoring — Zabbix API architecture (CPU, RAM, storage, alerts)',
                            'Grafana monitoring — dedicated infrastructure dashboard page',
                            'Automations — SLA thresholds, auto tickets, critical emails, weekly reports',
                            'IT processes — steps, I/O, tools, KPIs, versioning',
                            'IT / HSSE docs — PDF/Word/Excel, validation, publishing, search',
                            'KPI & Performance — MTTR, MTTA, availability, backlog, satisfaction',
                            'Action plan — PROBLEM → ANALYSIS → ACTION → FOLLOW-UP → VALIDATION',
                            'Process audits — compliance, observations, corrective actions',
                            'Users & roles — Administrator, IT Manager, Technician, Process Manager, User',
                        ]
                    ),
                    'architecture' => $bi(
                        "Architecture Laravel propre : Models, Controllers, Services (ZabbixClient, GrafanaEmbed, AutomationEngine), Jobs & Notifications, Policies/Requests, API Resources REST, Migrations & Seeders. Flux : équipements/alertes Zabbix → tickets & SLA → KPI dashboard → plans d’action. Grafana pour la visualisation temps réel ; Laravel pour la gouvernance processus et le reporting métier.",
                        'Clean Laravel architecture: Models, Controllers, Services (ZabbixClient, GrafanaEmbed, AutomationEngine), Jobs & Notifications, Policies/Requests, REST API Resources, Migrations & Seeders. Flow: Zabbix assets/alerts → tickets & SLAs → KPI dashboard → action plans. Grafana for real-time visualization; Laravel for process governance and business reporting.'
                    ),
                    'documentation' => $bi(
                        "Documentation projet : catalogue de processus IT (incidents, demandes, équipements, maintenance, accès, sauvegardes, changements, problèmes), référentiel KPI (MTTR, MTTA, SLA, disponibilité), conventions techniques (PHP 8.2+, MySQL, Livewire, Chart.js, Docker). Données de démonstration réalistes pour présentation entretien.",
                        'Project documentation: IT process catalog (incidents, requests, assets, maintenance, access, backups, changes, problems), KPI framework (MTTR, MTTA, SLA, availability), technical conventions (PHP 8.2+, MySQL, Livewire, Chart.js, Docker). Realistic demo data for interview presentation.'
                    ),
                    'results' => $bi(
                        "Résultats attendus : réduction du temps de résolution, meilleure conformité SLA, visibilité unique sur la disponibilité des services, procédures standardisées, documentation HSSE traçable, et capacité à prioriser les actions d’amélioration à partir de données mesurables.",
                        'Expected outcomes: shorter resolution time, better SLA compliance, single view of service availability, standardized procedures, traceable HSSE documentation, and the ability to prioritize improvement actions from measurable data.'
                    ),
                    'skills_demonstrated' => $biList(
                        [
                            'Process mapping & standardisation IT',
                            'Outils de support, SLA et performance',
                            'Supervision (Zabbix) & visualisation (Grafana)',
                            'Automatisation et reporting',
                            'Développement Laravel / API / dashboards',
                            'Amélioration continue & audit',
                        ],
                        [
                            'IT process mapping & standardization',
                            'Support tools, SLAs and performance',
                            'Monitoring (Zabbix) & visualization (Grafana)',
                            'Automation and reporting',
                            'Laravel / API / dashboard development',
                            'Continuous improvement & audit',
                        ]
                    ),
                ],
                'github_url' => 'https://github.com/alyassm7',
                'demo_url' => '#',
                'is_featured' => true,
                'order' => 1,
            ],
            [
                'title' => $t('Gestion Parc Informatique', 'IT Asset Management'),
                'slug' => 'gestion-parc-informatique',
                'description' => $t(
                    'Plateforme complète de gestion du parc informatique (ITAM) : inventaire des équipements, QR Code, affectations, check-in/check-out, maintenance, alertes de garantie, historique et tableaux de bord — conçue pour un contexte ONG / entreprise avec traçabilité forte.',
                    'Complete IT asset management (ITAM) platform: equipment inventory, QR codes, assignments, check-in/check-out, maintenance, warranty alerts, history and dashboards — built for NGO/enterprise contexts with strong traceability.'
                ),
                'technologies' => ['Laravel', 'Livewire', 'PHP 8.2', 'MySQL', 'Bootstrap', 'Chart.js', 'QR Code', 'REST API', 'Git'],
                'features' => $list(
                    [
                        'Inventaire multi-catégories (PC, écrans, imprimantes, réseaux…)',
                        'QR Code & fiche équipement',
                        'Check-in / Check-out & affectation utilisateurs',
                        'Maintenance préventive & corrective',
                        'Alertes garantie / fin de vie',
                        'Historique & audit des mouvements',
                        'Tableau de bord & statistiques temps réel',
                        'Export rapports (CSV / PDF)',
                        'Rôles & permissions',
                        'Recherche & filtres avancés',
                    ],
                    [
                        'Multi-category inventory (PCs, monitors, printers, network…)',
                        'QR Code & asset sheet',
                        'Check-in / Check-out & user assignment',
                        'Preventive & corrective maintenance',
                        'Warranty / end-of-life alerts',
                        'Movement history & audit trail',
                        'Real-time dashboard & statistics',
                        'Report exports (CSV / PDF)',
                        'Roles & permissions',
                        'Advanced search & filters',
                    ]
                ),
                'case_study' => [
                    'subtitle' => $bi(
                        'Inventaire, traçabilité et performance du parc IT',
                        'IT asset inventory, traceability and performance'
                    ),
                    'problem' => $bi(
                        "Sans outil centralisé, le parc IT est géré via Excel ou des notes dispersées : équipements non inventoriés, affectations floues, pannes non historisées, garanties oubliées et difficulté à produire un état fiable pour l’audit ou le budget. Les pertes, doublons et délais de support augmentent.",
                        'Without a central tool, IT assets are managed via spreadsheets or scattered notes: untracked equipment, unclear assignments, undocumented failures, forgotten warranties and no reliable status for audits or budgeting. Losses, duplicates and support delays increase.'
                    ),
                    'solution' => $bi(
                        "Une application Laravel / Livewire centralise le cycle de vie des actifs : enregistrement, étiquetage QR, affectation aux utilisateurs/sites, mouvements check-in/check-out, interventions de maintenance, alertes (garantie, stock critique) et reporting. L’équipe Support dispose d’une vision claire du parc pour accélérer le diagnostic et la planification.",
                        'A Laravel / Livewire application centralizes the asset lifecycle: registration, QR labeling, assignment to users/sites, check-in/check-out movements, maintenance work, alerts (warranty, critical stock) and reporting. The Support team gets a clear asset view to speed up diagnosis and planning.'
                    ),
                    'modules' => $biList(
                        [
                            'Inventaire des équipements — catégories, marques, modèles, n° série, statut (disponible, affecté, en réparation, réformé)',
                            'Fiche détaillée — caractéristiques techniques, localisation, utilisateur, photos, documents',
                            'QR Code — génération, impression d’étiquettes, scan pour accès rapide à la fiche',
                            'Affectation & Check-out — remise à un utilisateur / service avec date et signature numérique',
                            'Restitution & Check-in — retour, contrôle d’état, mise à jour du statut',
                            'Sites & localisation — bâtiments, bureaux, départements',
                            'Maintenance préventive — planning, rappels, interventions planifiées',
                            'Maintenance corrective — tickets liés à un équipement, pièces, durée, technicien',
                            'Alertes & notifications — fin de garantie, fin de vie, stock bas, matériel non retourné',
                            'Historique & audit — journal complet des mouvements et modifications',
                            'Tableau de bord — parc total, disponibles, en panne, affectés, tendances Chart.js',
                            'Statistiques — répartition par catégorie, âge du parc, taux d’utilisation',
                            'Rapports & exports — inventaire CSV/PDF, rapports mensuels pour la direction',
                            'Utilisateurs & rôles — Admin, Gestionnaire parc, Technicien, Lecture seule',
                            'Recherche & filtres — par statut, site, catégorie, utilisateur, n° série',
                            'API REST — endpoints pour intégration future (tickets, supervision, RH)',
                        ],
                        [
                            'Equipment inventory — categories, brands, models, serial numbers, status (available, assigned, under repair, retired)',
                            'Detailed asset sheet — specs, location, user, photos, documents',
                            'QR Code — generation, label printing, scan for quick asset access',
                            'Assignment & Check-out — hand-over to user/department with date and digital acknowledgment',
                            'Return & Check-in — return, condition check, status update',
                            'Sites & locations — buildings, rooms, departments',
                            'Preventive maintenance — schedule, reminders, planned interventions',
                            'Corrective maintenance — equipment-linked tickets, parts, duration, technician',
                            'Alerts & notifications — warranty end, end of life, low stock, unreturned assets',
                            'History & audit — full journal of movements and changes',
                            'Dashboard — total assets, available, down, assigned, Chart.js trends',
                            'Statistics — by category, asset age, utilization rate',
                            'Reports & exports — inventory CSV/PDF, monthly management reports',
                            'Users & roles — Admin, Asset Manager, Technician, Read-only',
                            'Search & filters — by status, site, category, user, serial number',
                            'REST API — endpoints for future integration (tickets, monitoring, HR)',
                        ]
                    ),
                    'architecture' => $bi(
                        "Architecture Laravel : Models (Equipment, Category, Assignment, Maintenance, Site, User), Controllers & Livewire Components pour les écrans dynamiques, Services (QrCodeService, AssetReportService, AlertService), Jobs de notification, Policies par rôle, Migrations MySQL normalisées, Seeders de démonstration. Flux : création équipement → QR → affectation → usage → maintenance → réforme / archivage.",
                        'Laravel architecture: Models (Equipment, Category, Assignment, Maintenance, Site, User), Controllers & Livewire components for dynamic screens, Services (QrCodeService, AssetReportService, AlertService), notification Jobs, role Policies, normalized MySQL migrations, demo Seeders. Flow: create asset → QR → assignment → usage → maintenance → retirement / archive.'
                    ),
                    'documentation' => $bi(
                        "Documentation projet : processus d’entrée en stock, procédure d’affectation, check-list de restitution, workflow de maintenance, règles de statut, indicateurs (taux d’affectation, âge moyen du parc, % hors garantie). Données de démo réalistes (postes, portables, écrans, imprimantes, switchs) pour présentation entretien Support / Process Tools.",
                        'Project documentation: inbound stock process, assignment procedure, return checklist, maintenance workflow, status rules, KPIs (assignment rate, average asset age, % out of warranty). Realistic demo data (desktops, laptops, monitors, printers, switches) for Support / Process Tools interview demos.'
                    ),
                    'results' => $bi(
                        "Résultats attendus : inventaire fiable à jour, réduction des pertes, affectations traçables, maintenance mieux planifiée, alertes de garantie anticipées, reporting rapide pour audits et budgets, et support utilisateur plus efficace grâce à l’identification immédiate du matériel.",
                        'Expected outcomes: reliable up-to-date inventory, fewer losses, traceable assignments, better planned maintenance, early warranty alerts, fast reporting for audits and budgets, and more efficient user support via immediate hardware identification.'
                    ),
                    'skills_demonstrated' => $biList(
                        [
                            'Gestion de parc informatique (ITAM)',
                            'Traçabilité & processus opérationnels',
                            'Développement Laravel / Livewire / MySQL',
                            'QR Code & automatisation métier',
                            'Tableaux de bord & reporting',
                            'Rôles, sécurité et audit',
                        ],
                        [
                            'IT asset management (ITAM)',
                            'Traceability & operational processes',
                            'Laravel / Livewire / MySQL development',
                            'QR Code & business automation',
                            'Dashboards & reporting',
                            'Roles, security and audit',
                        ]
                    ),
                ],
                'github_url' => 'https://github.com/alyassm7',
                'demo_url' => '#',
                'is_featured' => true,
                'order' => 2,
            ],
            [
                'title' => $t('Gestion des Tickets & SLA', 'Ticket & SLA Management'),
                'slug' => 'gestion-tickets',
                'description' => $t(
                    'Système de tickets de support informatique avec priorités, assignation, suivi de statut et logiques SLA pour mesurer le respect des délais de réponse et de résolution.',
                    'IT support ticket system with priorities, assignment, status tracking and SLA logic to measure response and resolution deadline compliance.'
                ),
                'technologies' => ['Laravel', 'Livewire', 'MySQL', 'Chart.js'],
                'features' => $list(
                    ['Tickets & priorités', 'Assignation technicien', 'Suivi SLA', 'Notifications'],
                    ['Tickets & priorities', 'Technician assignment', 'SLA tracking', 'Notifications']
                ),
                'github_url' => '#',
                'demo_url' => '#',
                'is_featured' => true,
                'order' => 3,
            ],
            [
                'title' => $t('Gestion Flotte SIM', 'SIM Fleet Management'),
                'slug' => 'gestion-flotte-sim',
                'description' => $t(
                    'Système de suivi et gestion des cartes SIM de l\'entreprise (inventaire, attribution, historique) — pertinent dans un contexte télécom.',
                    'System for tracking and managing company SIM cards (inventory, assignment, history) — relevant in a telecom context.'
                ),
                'technologies' => ['Laravel', 'MySQL', 'Bootstrap'],
                'features' => $list(
                    ['Inventaire SIM', 'Attribution', 'Historique'],
                    ['SIM inventory', 'Assignment', 'History']
                ),
                'github_url' => '#',
                'demo_url' => '#',
                'is_featured' => false,
                'order' => 4,
            ],
            [
                'title' => $t('Dashboard Odoo — Appro, Entrepôt & Contacts', 'Odoo Dashboard — Purchase, Warehouse & Contacts'),
                'slug' => 'dashboard-odoo',
                'description' => $t(
                    'Personnalisation et développement Odoo orientés métier : tableaux de bord KPI, module Approvisionnement, gestion d’entrepôt / stocks, Contacts et reporting opérationnel — développement + paramétrage des processus Appro, Entrepôt et Contacts.',
                    'Business-oriented Odoo customization and development: KPI dashboards, Purchase module, warehouse / stock management, Contacts and operational reporting — development plus process configuration for Purchase, Warehouse and Contacts.'
                ),
                'technologies' => ['Odoo', 'Python', 'XML', 'JavaScript', 'PostgreSQL', 'QWeb', 'OWL', 'REST API', 'Git'],
                'features' => $list(
                    [
                        'Dashboard KPI personnalisé',
                        'Approvisionnement (demandes, RFQ, bons de commande)',
                        'Entrepôt & stocks (réceptions, transferts, inventaires)',
                        'Contacts (clients, fournisseurs, adresses)',
                        'Reporting & exports',
                        'Automatisations & notifications',
                        'Vues, menus et droits d’accès',
                        'Intégration API / exports',
                    ],
                    [
                        'Custom KPI dashboard',
                        'Purchase (requests, RFQ, POs)',
                        'Warehouse & stock (receipts, transfers, inventories)',
                        'Contacts (customers, vendors, addresses)',
                        'Reporting & exports',
                        'Automations & notifications',
                        'Views, menus and access rights',
                        'API integration / exports',
                    ]
                ),
                'case_study' => [
                    'subtitle' => $bi(
                        'Développement Odoo + processus Appro, Entrepôt et Contacts',
                        'Odoo development + Purchase, Warehouse and Contacts processes'
                    ),
                    'problem' => $bi(
                        "Les équipes Appro et Entrepôt avaient besoin d’une vision claire des stocks, des commandes fournisseurs et des contacts métier. Les indicateurs étaient dispersés, les processus d’achat / réception peu standardisés, et le reporting manuel. Un besoin fort de dashboards fiables et de paramétrage Odoo adapté au terrain.",
                        'Purchase and Warehouse teams needed a clear view of stock, vendor orders and business contacts. KPIs were scattered, purchase/receipt processes poorly standardized, and reporting was manual. Strong need for reliable dashboards and Odoo configuration fitted to operations.'
                    ),
                    'solution' => $bi(
                        "Intervention sur Odoo couvrant à la fois le développement (dashboard, vues, automatisations) et la configuration métier des modules Approvisionnement, Entrepôt et Contacts : flux d’achat, réceptions, mouvements de stock, fiches partenaires, indicateurs et droits utilisateurs pour un usage quotidien fluide.",
                        'Odoo work covering both development (dashboard, views, automations) and business configuration of Purchase, Warehouse and Contacts: purchase flows, receipts, stock moves, partner records, KPIs and user rights for smooth daily use.'
                    ),
                    'modules' => $biList(
                        [
                            'Dashboard Odoo — KPI stocks, commandes en cours, retards fournisseurs, réceptions du jour, alertes rupture',
                            'Approvisionnement — demandes d’achat, appels d’offres (RFQ), bons de commande, validation multi-niveaux',
                            'Suivi fournisseurs — délais, montants, historique des commandes, relances',
                            'Entrepôt — emplacements, zones, réceptions, livraisons internes, transferts inter-dépôts',
                            'Stocks — quantités disponibles, réservées, entrées/sorties, inventaires physiques',
                            'Valorisation & traçabilité — lots / séries si besoin, mouvements liés aux documents',
                            'Contacts — partenaires (clients, fournisseurs), adresses, contacts, tags, catégories',
                            'Fiches partenaires enrichies — infos Appro / logistique, conditions de paiement, contacts dédiés',
                            'Reporting — états périodiques Appro & stock, exports Excel/PDF pour la direction',
                            'Automatisations — alertes stock bas, rappels validation commande, notifications réception',
                            'Droits & rôles — Approvisionneur, Magasinier, Manager, Lecture seule',
                            'Personnalisation UI — menus, vues liste/formulaire/kanban, filtres et groupes',
                            'Développement Python / XML — modèles étendus, champs métier, méthodes métier',
                            'JavaScript / OWL — widgets dashboard, graphiques, interactions dynamiques',
                            'API & intégrations — échanges de données, exports, connexion outils externes si requis',
                            'Recette & formation — scénarios test Appro → Entrepôt → Contacts, guides utilisateurs',
                        ],
                        [
                            'Odoo dashboard — stock KPIs, open POs, vendor delays, daily receipts, stockout alerts',
                            'Purchase — purchase requests, RFQs, purchase orders, multi-level approval',
                            'Vendor tracking — lead times, amounts, order history, follow-ups',
                            'Warehouse — locations, zones, receipts, internal transfers, inter-warehouse moves',
                            'Stock — on-hand, reserved, in/out moves, physical inventories',
                            'Valuation & traceability — lots/serials when needed, moves linked to documents',
                            'Contacts — partners (customers, vendors), addresses, contacts, tags, categories',
                            'Enriched partner cards — purchase/logistics info, payment terms, dedicated contacts',
                            'Reporting — periodic purchase & stock statements, Excel/PDF exports for management',
                            'Automations — low stock alerts, PO approval reminders, receipt notifications',
                            'Rights & roles — Purchaser, Warehouse clerk, Manager, Read-only',
                            'UI customization — menus, list/form/kanban views, filters and groups',
                            'Python / XML development — extended models, business fields, methods',
                            'JavaScript / OWL — dashboard widgets, charts, dynamic interactions',
                            'API & integrations — data exchange, exports, external tools when required',
                            'UAT & training — Purchase → Warehouse → Contacts test scenarios, user guides',
                        ]
                    ),
                    'architecture' => $bi(
                        "Stack Odoo : modules Purchase (purchase), Inventory/Stock (stock), Contacts (res.partner). Extensions Python (models, wizards, scheduled actions), vues XML/QWeb, dashboard JS/OWL, PostgreSQL. Flux métier : Contact fournisseur → Demande / RFQ → Bon de commande → Réception entrepôt → Mise à jour stock → Reporting dashboard.",
                        'Odoo stack: Purchase (purchase), Inventory/Stock (stock), Contacts (res.partner). Python extensions (models, wizards, cron), XML/QWeb views, JS/OWL dashboard, PostgreSQL. Business flow: Vendor contact → Request / RFQ → Purchase order → Warehouse receipt → Stock update → Dashboard reporting.'
                    ),
                    'documentation' => $bi(
                        "Documentation : processus Appro (demande → commande → réception), procédures magasin (réception, transfert, inventaire), gestion des Contacts, indicateurs dashboard (stock critique, commandes ouvertes, délais fournisseurs), rights matrix et guide utilisateur Appro / Entrepôt.",
                        'Documentation: Purchase process (request → order → receipt), warehouse procedures (receipt, transfer, inventory), Contacts management, dashboard KPIs (critical stock, open POs, vendor lead times), rights matrix and Purchase / Warehouse user guide.'
                    ),
                    'results' => $bi(
                        "Résultats attendus : processus Appro et Entrepôt standardisés, stocks plus fiables, contacts fournisseurs mieux structurés, dashboards actionnables pour le management, moins de reporting manuel et meilleure collaboration entre Appro, magasin et support métier.",
                        'Expected outcomes: standardized Purchase and Warehouse processes, more reliable stock, better structured vendor contacts, actionable management dashboards, less manual reporting and stronger collaboration between Purchase, warehouse and business support.'
                    ),
                    'skills_demonstrated' => $biList(
                        [
                            'Développement & personnalisation Odoo',
                            'Processus Approvisionnement',
                            'Gestion d’entrepôt & stocks',
                            'Module Contacts / partenaires',
                            'Dashboards KPI & reporting',
                            'Paramétrage, droits et formation utilisateurs',
                        ],
                        [
                            'Odoo development & customization',
                            'Purchase processes',
                            'Warehouse & stock management',
                            'Contacts / partners module',
                            'KPI dashboards & reporting',
                            'Configuration, rights and user training',
                        ]
                    ),
                ],
                'github_url' => '#',
                'demo_url' => '#',
                'is_featured' => true,
                'order' => 5,
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
                'order' => 6,
            ],
            [
                'title' => $t('Gestion des Utilisateurs & Rôles', 'User & Role Management'),
                'slug' => 'gestion-utilisateurs',
                'description' => $t(
                    'Module de gestion des utilisateurs avec rôles, permissions et journal d’audit pour sécuriser les accès aux outils IT.',
                    'User management module with roles, permissions and audit log to secure access to IT tools.'
                ),
                'technologies' => ['Laravel', 'MySQL', 'Bootstrap'],
                'features' => $list(
                    ['Rôles', 'Permissions', 'Audit log'],
                    ['Roles', 'Permissions', 'Audit log']
                ),
                'github_url' => '#',
                'demo_url' => '#',
                'is_featured' => false,
                'order' => 7,
            ],
        ];

        foreach ($projects as $project) {
            $features = $project['features'];
            unset($project['features']);
            $caseStudy = $project['case_study'] ?? null;
            unset($project['case_study']);
            Project::updateOrCreate(['slug' => $project['slug']], array_merge($project, [
                'features' => json_decode($features, true),
                'case_study' => $caseStudy,
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
