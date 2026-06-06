# 📝 Plateforme de Suivi et Gestion des Stages — BUT MMI Meaux

> **Projet Universitaire (SAÉ)** — Application officielle fictive de suivi et de gestion des stages et des soutenances pour le département **MMI (Métiers du Multimédia et de l'Internet)** de l'IUT de Meaux (**Université Gustave Eiffel**).

---

## 🚀 Présentation du Projet

Ce projet a été développé dans le cadre des situations d'apprentissage et d'évaluation (SAÉ) du BUT MMI. L'objectif est de proposer une interface web moderne, intuitive et scannable permettant de faire le pont entre l'administration de l'IUT (secrétariat, enseignants référents) et les étudiants durant leurs démarches de stages.

L'application intègre deux espaces distincts :

1. **Espace Étudiant :** Inscription, connexion authentifiée et accès aux offres de stages.
2. **Espace Administration :** Gestion complète des fiches entreprises (vue en grille moderne), planification des soutenances, publication de nouvelles offres et suivi des dossiers étudiants.

---

## 🎨 Aperçu de l'Interface & Charte Graphique

L'application respecte les conventions UI/UX actuelles à l'aide d'un design épuré, asymétrique et aéré :

* **Typographie & Base :** Fond neutre `bg-gray-50` associé à la police sans-serif native pour un confort visuel optimal.
* **Espace Étudiant :** Identifié par une palette de **Bleus académiques** (`bg-blue-900`, `bg-blue-600`) symbolisant la rigueur et le sérieux universitaire.
* **Espace Administration :** Une navbar dotée d'un badge distinctif **`ADMIN`** rouge pour éviter toute confusion d'espace, et des grilles de cartes d'entreprises modernes avec visuels intégrés.

---

## 📁 Architecture des Fichiers Front-End

Voici l'organisation des fichiers développés pour ce prototype d'application :

```text
├── connexion.html             # Page de connexion de l'espace Étudiant (avec passerelle admin)
├── connexion-admin.html       # Page de connexion sécurisée pour le corps enseignant/secrétariat
├── inscription.html           # Formulaire de création de compte Étudiant
├── entreprise-admin.html      # Vue Admin : Grille de cartes des entreprises partenaires (style moderne avec images)
├── nouvelle-entreprise.html   # Formulaire d'ajout d'une nouvelle structure d'accueil
├── voir-stage-admin.html      # Vue Admin : Tableau de bord du catalogue des offres de stages (Vide par défaut)
├── nouvelle-offre.html        # Formulaire de dépôt et de publication d'une fiche de poste
├── soutenance-admin.html      # Vue Admin : Grille horaire et planification des examens (Vide par défaut)
├── nouvelle-soutenance.html   # Formulaire d'affectation des jurys, salles et horaires de passage
├── etudiant-admin.html        # Vue Admin : Cartes de suivi de l'état d'avancement des étudiants (Inspiré UI de référence)
└── profil-admin.html          # Paramètres de compte, sécurité (CAS) et préférences de l'administrateur

```

---

## 🛠️ Technologies Utilisées

* **HTML5 / CSS3 :** Structure sémantique et mise en page fluide.
* **Tailwind CSS (v4) :** Framework CSS utilitaire utilisé via CDN (`@tailwindcss/browser@4`) pour un prototypage ultra-rapide et un responsive design sans faille (Mobile, Tablette, Desktop).
* **PHP / MySQL (Environnement cible) :** Architecture prévue pour un hébergement mutualisé standard de l'IUT, gérant dynamiquement les sessions applicatives (`session_start()`) et la persistance des données.
* **JavaScript :** L'utilisation de Js permet des animations fluide et raffine pour plus de reactivite.
---

