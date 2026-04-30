# Installer et démarrer le projet

## Premier démarrage
Cette action doit être effectuée par **un seul membre de l'équipe**. Une fois terminée, les autres membres de l'équipe pourront simplement faire un `git pull` pour récupérer le projet pleinement initialisé et avec les bons droits.

### Sur Linux / WSL

```bash
# exporter l'uid de l'utilisateur courant côté hôte (Docker en aura besoin pour les permissions)
export HOST_UID=$(id -u)

# construire et lancer les conteneurs
docker compose up -d --build

# installer le squelette d'application et le framework
# (depuis le conteneur et avec les bons droits utilisateur)
docker compose exec --user $(id -u):www-data phpfpm composer create-project yosko/watamelo-skeleton . --remove-vcs
```
_NB : le chemin `.` fera installer le projet à la racine du dossier `src/` (donc `/var/www/html/` dans le conteneur)._


### Commandes équivalente sur Windows

```powershell
# construire et lancer les conteneurs
docker compose up -d --build

# installer le squelette d'application et le framework
docker compose exec phpfpm composer create-project yosko/watamelo-skeleton . --remove-vcs
```


## Ajouter le code utile

Du code nécessaire au *backend* vous est fourni dans le dossier `fragments/` : déplacez-les vers `src/` en conservant la même arborescence (là aussi, un seul membre de l'équipe doit s'en occuper). Vous devrez fusionner certains dossiers.


## Charger les dépendances

Si un autre membre de l'équipe a déjà intégré le squelette d'application et le framework, votre `git clone` contiendra déjà presque tout ce qu'il vous faut, excepté les dépendances (le dossier `src/vendor/`).

Pour les récupérer, placez-vous dans `src/`, puis tapez :

```bash
# Reconstruire les conteneurs
docker compose up -d --build

# Installer les dépendances
docker compose exec phpfpm composer install
```