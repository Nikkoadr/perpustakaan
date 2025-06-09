pipeline {
  agent any

  environment {
    IMAGE_NAME = 'nikkoadr/perpustakaan'
    IMAGE_TAG = 'latest'
    CONTAINER_NAME = 'Perpustakaan'
    REMOTE_USER = 'root'               // ganti sesuai user VPS
    REMOTE_HOST = '103.156.16.157'    // IP VPS kamu
  }

  stages {
    stage('Checkout') {
      steps {
        checkout scm
      }
    }

    stage('Build Docker Image') {
      steps {
        sh "docker build -t $IMAGE_NAME:$IMAGE_TAG ."
      }
    }

    stage('Push to Docker Hub') {
      steps {
        withCredentials([usernamePassword(credentialsId: 'dockerhub-credentials', usernameVariable: 'DOCKER_USER', passwordVariable: 'DOCKER_PASS')]) {
          sh """
            echo "$DOCKER_PASS" | docker login -u "$DOCKER_USER" --password-stdin
            docker push $IMAGE_NAME:$IMAGE_TAG
          """
        }
      }
    }

    stage('Deploy to Remote Server') {
      steps {
        sshagent(['my-server-ssh']) {
        sh """
          ssh -o StrictHostKeyChecking=no root@103.156.16.157 \\
          'cd /var/docker/perpustakaan && docker compose pull && docker compose down && docker compose up -d'
        """
        }
      }
    }
  }

  post {
    success {
      echo "✅ Build & Deploy Success!"
    }
    failure {
      echo "❌ Build or Deploy Failed!"
    }
  }
}
