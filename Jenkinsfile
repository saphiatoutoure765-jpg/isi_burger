pipeline {
    agent any

    environment {
        BRANCH_NAME = 'nom_prenom_burger'
        IMAGE_NAME  = 'isi_burger'
    }

    stages {

        stage('Pull du code depuis GitHub') {
            steps {
                echo '📥 Récupération du code depuis GitHub...'
                git branch: "${BRANCH_NAME}",
                    url: 'https://github.com/votre_username/isi_burger.git'
            }
        }

        stage('Installation des dépendances Laravel') {
            steps {
                echo '📦 Installation des dépendances Composer...'
                sh 'composer install --no-interaction --prefer-dist --optimize-autoloader'

                echo '📋 Copie du fichier .env...'
                sh 'cp .env.example .env'

                echo '🔑 Génération de la clé applicative...'
                sh 'php artisan key:generate'
            }
        }

        stage('Création de l\'image Docker') {
            steps {
                echo '🐳 Construction de l\'image Docker...'
                sh "docker build -t ${IMAGE_NAME}:latest ."
            }
        }

        stage('Déploiement') {
            steps {
                echo '🚀 Démarrage du conteneur...'
                sh "docker stop ${IMAGE_NAME} || true"
                sh "docker rm ${IMAGE_NAME} || true"
                sh """
                    docker run -d \
                        --name ${IMAGE_NAME} \
                        -p 8000:8000 \
                        ${IMAGE_NAME}:latest
                """
            }
        }

    }

    post {
        success {
            echo '✅ Pipeline terminé avec succès !'
        }
        failure {
            echo '❌ Erreur dans le pipeline.'
        }
    }
}
