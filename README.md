# Insta Meme 

Une plateforme de partage de mèmes inspirée d'Instagram, développée en PHP avec une interface moderne utilisant Tailwind CSS.

##  Description du projet

Insta Meme est une application web qui permet aux utilisateurs de :
- Créer un compte et se connecter
- Publier des mèmes avec des descriptions
- Liker et commenter les publications
- Rechercher d'autres utilisateurs
- Consulter les profils utilisateurs
- Partager des mèmes existants

##  Technologies utilisées

### Backend
- **PHP** - Langage principal du serveur
- **MySQL** - Base de données relationnelle
- **PDO** - Interface d'accès aux données PHP

### Frontend
- **HTML5** - Structure des pages
- **CSS3** - Styles personnalisés
- **Tailwind CSS** - Framework CSS utilitaire

### Autres
- **Sessions PHP** - Gestion de l'authentification
- **Upload de fichiers** - Gestion des images

##  Structure du projet

```
insta_meme/
├── bdd.txt                 # Script de création de la base de données
├── index.php              # Page d'accueil avec pagination
├── login.php              # Page de connexion
├── inscription.php        # Page d'inscription
├── create.php             # Création de nouveaux posts
├── content.php            # Affichage détaillé d'un contenu
├── user_ac.php            # Profil utilisateur
├── recherche.php          # Recherche d'utilisateurs
├── like.php               # Gestion des likes
├── partage.php            # Partage de mèmes
├── deco.php               # Déconnexion
├── php/
│   ├── db.php             # Connexion à la base de données
│   └── affichage.php      # Fonctions d'affichage
├── composants/
│   ├── header.php         # En-tête commun
│   ├── footer.php         # Pied de page commun
│   └── fonction.sql       # Requêtes SQL complexes
├── css/                   # Fichiers de styles
└── images/                # Dossier des images uploadées
```

##  Base de données

La base de données `insta_meme` contient 4 tables principales :

### utilisateurs
- `id` (INT, AUTO_INCREMENT, PRIMARY KEY)
- `pseudo` (VARCHAR(50), UNIQUE)
- `mot_de_passe` (VARCHAR(255), MD5)
- `date_inscription` (DATETIME)

### contenus
- `id` (INT, AUTO_INCREMENT, PRIMARY KEY)
- `id_utilisateur` (INT, FOREIGN KEY)
- `description` (TEXT)
- `chemin_image` (VARCHAR(255))
- `date_publication` (DATETIME)

### likes
- `id` (INT, AUTO_INCREMENT, PRIMARY KEY)
- `id_utilisateur` (INT, FOREIGN KEY)
- `id_contenu` (INT, FOREIGN KEY)
- `date_like` (DATETIME)
- Contrainte UNIQUE sur (id_utilisateur, id_contenu)

### commentaires
- `id` (INT, AUTO_INCREMENT, PRIMARY KEY)
- `id_contenu` (INT, FOREIGN KEY)
- `id_utilisateur` (INT, FOREIGN KEY)
- `message` (TEXT)
- `date_publication` (DATETIME)

## Installation et configuration

### Prérequis
- Serveur web (Apache/Nginx)
- PHP 7.4+
- MySQL 5.7+
- Extension PHP PDO_MYSQL

### Installation

1. **Cloner le projet**
   ```bash
   git clone https://github.com/StonksInd/insta-meme.git
   cd insta_meme
   ```

2. **Configuration de la base de données**
   - Créer une base de données MySQL
   - Importer le script `bdd.txt` pour créer les tables et données de test
   
3. **Configuration PHP**
   - Modifier les paramètres de connexion dans `php/db.php` :
   ```php
   $db = new PDO(
       'mysql:host=127.0.0.1;dbname=insta_meme;charset=utf8',
       'root',        // Votre nom d'utilisateur MySQL
       ''             // Votre mot de passe MySQL
   );
   ```

4. **Permissions**
   - Créer le dossier `images/` avec les permissions d'écriture
   ```bash
   mkdir images
   chmod 755 images
   ```

5. **Démarrage**
   - Placer les fichiers dans le répertoire web de votre serveur
   - Accéder à `http://localhost/insta_meme`

##  Fonctionnalités principales

### Authentification
- Inscription avec pseudo et mot de passe
- Connexion sécurisée avec sessions PHP
- Hachage MD5 des mots de passe

### Gestion des contenus
- Upload d'images (PNG, JPEG, JPG, GIF)
- Limitation de taille (20 Mo max)
- Génération de noms uniques pour éviter les conflits
- Descriptions personnalisées

### Interactions sociales
- Système de likes avec toggle (like/unlike)
- Commentaires en temps réel
- Compteurs de likes et commentaires

### Navigation
- Pagination sur la page d'accueil (9 posts par page)
- Recherche d'utilisateurs par pseudo
- Profils utilisateurs individuels

### Interface utilisateur
- Design responsive avec Tailwind CSS
- Navigation intuitive avec header/footer
- Feedback visuel pour les actions utilisateur

##  Fonctionnalités techniques

### Sécurité
- Requêtes préparées PDO (protection contre l'injection SQL)
- Validation des uploads de fichiers
- Gestion des sessions PHP
- Redirection automatique selon l'état de connexion

### Performance
- Pagination pour limiter les requêtes
- Requêtes optimisées avec JOINs
- Gestion efficace des compteurs de likes/commentaires

### Requêtes avancées
Le fichier `composants/fonction.sql` contient des requêtes complexes pour :
- Top utilisateurs par nombre de posts
- Contenus les plus likés/commentés
- Statistiques par date
- Analyses de contenu et d'activité

## Personnalisation

### Styles
- Fichiers CSS dans le dossier `css/`
- Classes Tailwind pour un design moderne
- Composants réutilisables (header/footer)

### Couleurs principales
- Indigo (`bg-indigo-600`) pour les boutons principaux
- Vert (`bg-green-600`) pour les actions de partage
- Gris (`bg-gray-100`) pour les arrière-plans

##  Limitations connues

- Mots de passe hachés en MD5 (considéré comme faible)
- Pas de validation côté client pour les formulaires
- Gestion d'erreurs basique
- Pas de système de modération du contenu

##  Améliorations possibles

- Migration vers password_hash() de PHP
- Validation JavaScript côté client
- Système d'administration
- API REST pour une app mobile
- Notifications en temps réel
- Système de followers/following
- Filtres et tags pour les mèmes

##  Licence

Ce projet est un exemple éducatif. Utilisez-le librement pour l'apprentissage et le développement.

---

