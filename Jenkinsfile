pipeline {
  agent any

  environment {
    IMAGE_NAME = 'nikkoadr/perpustakaan'
    IMAGE_TAG = 'latest'
    CONTAINER_NAME = 'Perpustakaan'
    DOCKER_VOLUME = 'storage-data'
    REMOTE_USER = 'root'                  // ganti sesuai user VPS
    REMOTE_HOST = '103.156.16.157'        // ganti dengan IP VPS kamu
    DEPLOY_PORT = '80'                    // atau port custom jika ada
  }

  stages {

    stage('Checkout') {
      steps {
        checkout scm
      }
    }

    stage('Build Docker Image') {
      steps {
        sh 'docker build -t $IMAGE_NAME:$IMAGE_TAG .'
      }
    }

    stage('Push to Docker Hub') {
      steps {
        withCredentials([usernamePassword(credentialsId: 'dockerhub-credentials', usernameVariable: 'DOCKER_USER', passwordVariable: 'DOCKER_PASS')]) {
          sh '''
            echo "$DOCKER_PASS" | docker login -u "$DOCKER_USER" --password-stdin
            docker push $IMAGE_NAME:$IMAGE_TAG
          '''
        }
      }
    }

    stage('Deploy to Remote Server') {
      steps {
        sshagent(['my-server-ssh']) {
          sh """
            ssh -o StrictHostKeyChecking=no $REMOTE_USER@$REMOTE_HOST <<EOF

            docker pull $IMAGE_NAME:$IMAGE_TAG

            docker rm -f $CONTAINER_NAME || true
            docker volume create $DOCKER_VOLUME || true

            docker run -d --name $CONTAINER_NAME \\
              -v $DOCKER_VOLUME:/var/www/html/public/storage \\
              -e APP_ENV=production \\
              -e APP_DEBUG=false \\
              -e APP_KEY=base64:DwtrPn73HPko69CcOmQ/bqPRVZzuLzvxg17/EPvfgc8= \\
              -e DB_CONNECTION=mysql \\
              -e DB_HOST=103.156.16.157 \\
              -e DB_PORT=3306 \\
              -e DB_DATABASE=perpustakaan \\
              -e DB_USERNAME=root \\
              -e DB_PASSWORD=root_password \\
              -p $DEPLOY_PORT:9000 \\
              $IMAGE_NAME:$IMAGE_TAG

            docker exec $CONTAINER_NAME php artisan migrate --force
            docker exec $CONTAINER_NAME php artisan storage:link || true
            docker exec $CONTAINER_NAME php artisan config:cache

            EOF
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
