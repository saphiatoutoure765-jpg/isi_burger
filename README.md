# 🍔 ISI Burger - Gestion des Commandes

Application web Laravel 10 + PostgreSQL pour la gestion des commandes du restaurant ISI Burger.

## Prérequis
- PHP 8.1+  |  Composer  |  PostgreSQL

## Installation

```bash
# 1. Installer les dépendances
composer install

# 2. Configurer l'environnement
cp .env.example .env
php artisan key:generate

# 3. Créer la base PostgreSQL
# Dans psql : CREATE DATABASE isi_burger;

# 4. Configurer .env (DB_CONNECTION=pgsql, DB_DATABASE=isi_burger ...)

# 5. Migrations + Seeder
php artisan migrate --seed

# 6. Lier le storage (images burgers)
php artisan storage:link

# 7. Lancer le serveur
php artisan serve
```

## Comptes de test
| Rôle         | Email                        | Mot de passe |
|--------------|------------------------------|--------------|
| Gestionnaire | gestionnaire@isiburger.sn    | password     |
| Client       | client@isiburger.sn          | password     |

## Fonctionnalités
- Authentification avec rôles (gestionnaire / client)
- CRUD burgers avec images et gestion du stock
- Catalogue avec filtres pour les clients
- Gestion des commandes et suivi des statuts
- Envoi automatique de facture PDF par email
- Dashboard avec statistiques et graphiques Chart.js
- CI/CD avec Jenkinsfile et GitHub Actions
