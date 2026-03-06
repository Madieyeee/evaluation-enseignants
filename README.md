# Système d'Évaluation des Enseignants

Application Laravel pour l'évaluation des enseignants par les étudiants.

## 📋 Prérequis

- **PHP** >= 8.2
- **Composer** >= 2.0
- **Node.js** >= 18.0
- **npm** ou **yarn**

## 🚀 Installation

### 1. Cloner ou naviguer vers le projet
```bash
cd "c:\Users\***REMOVED***\evaluation-enseignants"
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

## 📁 Structure du projet

```
evaluation-enseignants/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/          # Contrôleurs admin
│   │   ├── Enseignant/     # Contrôleurs enseignant
│   │   └── Etudiant/       # Contrôleurs étudiant
│   ├── Middleware/         # Middlewares (rôles)
│   └── Models/             # Modèles Eloquent
├── database/
│   ├── migrations/         # Migrations DB
│   └── seeders/           # Seeders (données initiales)
├── resources/views/
│   ├── admin/             # Vues admin
│   ├── enseignant/        # Vues enseignant
│   └── etudiant/          # Vues étudiant
└── routes/web.php         # Routes de l'application
```

## 🔧 Fonctionnalités

### Administrateur
- ✅ CRUD Départements, Filières, Matières
- ✅ CRUD Enseignants, Étudiants
- ✅ Gestion des périodes d'évaluation
- ✅ Gestion des critères d'évaluation
- ✅ Tableau de bord avec statistiques

### Enseignant
- ✅ Consulter ses évaluations
- ✅ Voir sa moyenne par critère
- ✅ Tableau de bord personnalisé

### Étudiant
- ✅ Évaluer les enseignants
- ✅ Historique des évaluations
- ✅ Note de 1 à 5 par critère

## 📊 Base de données

### Tables principales
- `users` - Utilisateurs avec rôles (admin, enseignant, etudiant)
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

## 📝 Licence

Projet académique - L3 Génie Logiciel
