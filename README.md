# Système d'Évaluation des Enseignants

Application Laravel pour l'évaluation des enseignants par les étudiants avec un design premium style dashboard (Linear/shadcn).

## 📋 Prérequis

- **PHP** >= 8.2
- **Composer** >= 2.0
- **Node.js** >= 18.0
- **npm** ou **yarn**

## 🚀 Installation

### 1. Cloner ou naviguer vers le projet
```bash
cd "C:\Users\...\evaluation-enseignants"
```

### 2. Installer les dépendances PHP
```bash
composer install
```

### 3. Installer les dépendances JavaScript
```bash
npm install
```

### 4. Copier le fichier d'environnement
```bash
copy .env.example .env
```

### 5. Générer la clé d'application
```bash
php artisan key:generate
```

### 6. Configurer la base de données

Le projet utilise **SQLite** par défaut. La base de données est créée automatiquement dans `database/database.sqlite`.

### 7. Exécuter les migrations et les seeders
```bash
php artisan migrate:fresh --seed
```

### 8. Compiler les assets
```bash
npm run build
```

## 🏃 Démarrage du serveur

### Option 1 : Serveur Laravel
```bash
php artisan serve
```
L'application sera accessible à : **http://localhost:8000**

### Option 2 : Avec Vite (développement)
```bash
# Terminal 1 - Serveur Laravel
php artisan serve

# Terminal 2 - Vite pour le hot reload
npm run dev
```

## 👤 Comptes par défaut

| Rôle | Email | Mot de passe |
|------|-------|--------------|
| Admin | admin@evaluation.sn | password |

**Note** : Créez les comptes enseignants et étudiants via l'interface admin.

## 🎨 Design System

### Thèmes
- **Light/Dark mode** avec persistance localStorage
- Design tokens CSS variables (couleurs, radius, ombres)
- Police Inter Variable

### Composants UI (`<x-ui.*>`)
- `card` - Cartes avec variantes interactives
- `button` - Boutons primary/secondary/ghost/danger
- `badge` - Badges avec variants soft/outline
- `input` - Inputs avec icônes et validation
- `dropdown` / `dropdown-item` - Menus déroulants
- `avatar` - Avatars avec initiales
- `notification-bell` - Cloche notifications temps réel
- `chart-line` / `chart-bar` / `chart-radar` - Graphiques Chart.js

### Composants Layout (`<x-layout.*>`)
- `sidebar` - Sidebar responsive (offcanvas mobile, collapsible desktop)

## 📁 Structure du projet

```
evaluation-enseignants/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/          # Contrôleurs admin
│   │   ├── Api/            # Contrôleurs API (notifications)
│   │   ├── Enseignant/     # Contrôleurs enseignant
│   │   └── Etudiant/       # Contrôleurs étudiant
│   ├── Notifications/      # Classes de notifications
│   ├── Middleware/         # Middlewares (rôles)
│   ├── Models/             # Modèles Eloquent
│   └── Exports/            # Exports PDF/Excel
├── database/
│   ├── migrations/         # Migrations DB
│   └── seeders/           # Seeders (données initiales)
├── resources/
│   ├── css/app.css         # Design tokens + composants
│   ├── js/app.js           # Alpine.js + Chart.js config
│   └── views/
│       ├── admin/          # Vues admin
│       ├── components/     # Composants Blade
│       │   ├── ui/         # Composants UI réutilisables
│       │   └── layout/     # Composants layout
│       ├── enseignant/     # Vues enseignant
│       ├── etudiant/       # Vues étudiant
│       └── notifications/  # Vues notifications
└── routes/web.php         # Routes de l'application
```

## 🔧 Fonctionnalités

### Administrateur
- ✅ CRUD Départements, Filières, Matières
- ✅ CRUD Enseignants, Étudiants
- ✅ Gestion des périodes d'évaluation
- ✅ Gestion des critères d'évaluation
- ✅ Tableau de bord avec statistiques
- ✅ **Exports PDF** (enseignants, étudiants, évaluations)
- ✅ **Exports Excel** (enseignants, étudiants, évaluations)

### Enseignant
- ✅ Consulter ses évaluations
- ✅ Voir sa moyenne par critère
- ✅ Tableau de bord personnalisé

### Étudiant
- ✅ Évaluer les enseignants
- ✅ Historique des évaluations
- ✅ Note de 1 à 5 par critère

### Notifications
- ✅ Notifications temps réel (polling)
- ✅ Composant notification-bell dans la topbar
- ✅ Page liste des notifications
- ✅ Types: NouvelleEvaluation, FeedbackEnseignant, RapportDisponible

## 📊 Base de données

### Tables principales
- `users` - Utilisateurs avec rôles (admin, enseignant, etudiant)
- `notifications` - Notifications stockées en base
- `enseignants` - Profils enseignants
- `etudiants` - Profils étudiants
- `matieres` - Matières enseignées
- `criteres` - Critères d'évaluation
- `evaluations` - Évaluations globales
- `notes` - Notes par critère
- `periode_evaluations` - Périodes d'évaluation
- `departements` - Départements
- `filieres` - Filières

## 🛠️ Commandes utiles

```bash
# Réinitialiser la base de données
php artisan migrate:fresh --seed

# Vider le cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Lister les routes
php artisan route:list

# Mode maintenance
php artisan down
php artisan up
```

## 📦 Dépendances principales

### Backend (Composer)
- `laravel/framework` ^12.0
- `laravel/fortify` - Authentification
- `barryvdh/laravel-dompdf` - Exports PDF
- `maatwebsite/excel` - Exports Excel
- `blade-ui-kit/blade-lucide-icons` - Icônes Lucide

### Frontend (npm)
- `tailwindcss` ^3.4 - CSS framework
- `alpinejs` ^3.14 - Réactivité
- `chart.js` ^4.4 - Graphiques
- `@fontsource-variable/inter` - Police Inter

## 📝 Licence

Projet académique - L3 Génie Logiciel
