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
						echo "Running PHPUnit Test"
					}
				}
			}            
        }
        post {
            always{
					step([$class: 'JUnitResultArchiver', testResults: 'results/phpunit/phpunit.xml'])
				}
			failure {
					mail to: 'ddas446@its.jnj.com',
					subject: "Failed Pipeline: ${currentBuild.fullDisplayName}",
					body: "Something is wrong with ${env.BUILD_URL}"
				}
			success {
				step([$class: 'AWSCodeDeployPublisher', applicationName: 'DeliveryPipeline', awsAccessKey: '', awsSecretKey: '', deploymentConfig: 'CodeDeployDefault.OneAtATime', deploymentGroupAppspec: false, deploymentGroupName: 'CodeDeployGroup', excludes: '', iamRoleArn: '', includes: '**', proxyHost: '', proxyPort: 0, region: 'us-east-2', s3bucket: 'cicds3', s3prefix: 'deploy', subdirectory: '', versionFileName: '', waitForCompletion: false])
				
			}
			cleanup{
				cleanWs()
			}			
		}

       
    }
}