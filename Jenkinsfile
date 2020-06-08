/**
 * Jenkinsfile (Declarative Pipeline)
 */
 pipeline {
    agent any

    stages {
        stage('Build') {
            steps {
                echo 'Building..'
            }
        }
        stage('Test') {
			parallel{
				stage('PHPUnit test'){
					steps{
						echo "Running PHPUnit Test"
						sh label: '', script: 'phpunit8 --log-junit results/phpunit/phpunit.xml -c phpunit.xml'
					}
				}
				stage('SonarQube test'){
					steps{
						echo "Need to work"
					}
				}
			}            
        }
		stage('Deploy & Reporting'){
            stage('JUnit Reporting'){
					step([$class: 'JUnitResultArchiver', testResults: 'results/phpunit/phpunit.xml'])
				}
			stage('JUnit Reporting'){
				step([$class: 'AWSCodeDeployPublisher', applicationName: 'DeliveryPipeline', awsAccessKey: '', awsSecretKey: '', deploymentConfig: 'CodeDeployDefault.OneAtATime', deploymentGroupAppspec: false, deploymentGroupName: 'CodeDeployGroup', excludes: '', iamRoleArn: '', includes: '**', proxyHost: '', proxyPort: 0, region: 'us-east-2', s3bucket: 'cicds3', s3prefix: 'deploy', subdirectory: '', versionFileName: '', waitForCompletion: false])
				
			}
		}
		post {
			success {
			  echo "Success"
			}
			failure {
			   echo "failure"
			}
			aborted {
			  echo "aborted"
			}
			always {
			  echo '... clean workspace when done'
			  cleanWs()
			}
		}
  }
}