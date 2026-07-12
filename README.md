# Portfolio Laravel — Hasina Samüela

Portfolio professionnel développé avec **Laravel 11**, design premium sombre/clair, administration complète et contenu dynamique.

## Fonctionnalités

- Pages : Accueil, À propos, Compétences, Projets, Expériences, Contact
- Mode clair / sombre avec persistance
- Animations AOS, texte animé Typed.js, compteurs animés
- Filtre et recherche de projets par technologie
- Formulaire de contact avec envoi e-mail
- Téléchargement du CV en PDF
- Administration CRUD (projets, compétences, expériences, formations, témoignages, messages, paramètres)
- SEO optimisé (meta description, keywords)
- Responsive (mobile, tablette, desktop)

## Prérequis

- PHP 8.2+
- Composer
- MySQL 8+
- Extension PHP : pdo_mysql, mbstring, openssl, tokenizer, xml, ctype, json, fileinfo

## Installation

```bash
cd c:\Users\Hasina\Desktop\hasina\portfoliohasina

# Installer les dépendances Laravel
composer install

# Configurer l'environnement
copy .env.example .env
php artisan key:generate

# Créer la base de données MySQL : portfolio_hasina
# Puis configurer DB_* dans .env

# Migrations + données de démonstration
php artisan migrate --seed

# Lien symbolique pour les uploads (images, CV)
php artisan storage:link

# Copier votre CV PDF dans le projet
powershell -ExecutionPolicy Bypass -File copy-cv.ps1

# Copier votre photo de profil
powershell -ExecutionPolicy Bypass -File copy-profile.ps1

php artisan db:seed
php artisan cache:clear

# Lancer le serveur
php artisan serve
```

Site : http://localhost:8000  
Admin : http://localhost:8000/admin/login

**Identifiants admin par défaut :**
- Email : `admin@hasina.dev`
- Mot de passe : `password`

> Changez le mot de passe après la première connexion.

## Configuration e-mail

Dans `.env`, configurez votre serveur SMTP :

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=votre@email.com
MAIL_PASSWORD=votre_mot_de_passe
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=contact@hasina.dev
```

En développement, `MAIL_MAILER=log` enregistre les e-mails dans `storage/logs/laravel.log`.

## Personnalisation

1. **Photos** : remplacez `public/images/profile.svg` et uploadez via Admin → Paramètres
2. **CV** : Admin → Paramètres → Téléverser CV (PDF)
3. **Contenu** : tout est modifiable depuis `/admin` sans toucher au code
4. **Liens GitHub/LinkedIn** : Admin → Paramètres

## Structure

```
app/Http/Controllers/     # Controllers public + admin
app/Models/               # Project, Skill, Experience, etc.
resources/views/          # Blade templates
public/css/portfolio.css  # Design premium
public/js/portfolio.js    # Thème, animations
database/seeders/         # Données Hasina Samüela
```

## Technologies

- Laravel 11 · PHP 8.2+ · MySQL
- Bootstrap 5 · Font Awesome 6
- AOS · Typed.js

---

© 2026 Hasina Samüela — Portfolio Laravel
