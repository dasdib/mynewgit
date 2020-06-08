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
						//sh 'chmod +rwx /var/lib/jenkins/workspace/MyCICD/reports/unitreport.xml'
						sh label: '', script: 'phpunit --log-junit reports/unitreport.xml --coverage-clover reports/coverage.xml --coverage-html=reports -c phpunit.xml'
						
					}
				}
				stage('CloverPublisher Reporting'){		
					step([
							$class: 'CloverPublisher',
							cloverReportDir: '/var/lib/jenkins/workspace/MyCICD/reports/',
							cloverReportFileName: 'coverage.xml',
							healthyTarget: [methodCoverage: 70, conditionalCoverage: 80, statementCoverage: 80],
							unhealthyTarget: [methodCoverage: 50, conditionalCoverage: 50, statementCoverage: 50],
							failingTarget: [methodCoverage: 0, conditionalCoverage: 0, statementCoverage: 0]
						])
				}
				stage('JUnit Reporting'){
					steps{
						echo 'start JUnit reporting'
						//sh 'chmod +rwx /var/lib/jenkins/workspace/MyCICD/reports/unitreport.xml'
						step([$class: 'JUnitResultArchiver', testResults: 'reports/unitreport.xml']) 
					}	
				}	
				
				stage('SonarQube test'){
					steps{
						echo "Star sonar scanner"
						sh '/opt/sonar_scanner/bin/sonar-scanner -Dsonar.projectKey=sonarqube -Dsonar.projectName=SonarQube -Dsonar.projectVersion=1.0 -Dsonar.sources=/var/lib/jenkins/workspace/MyCICD/www' 
						
						echo 'http://3.128.22.92/dashboard?id=sonarqube'
					}
				}
			}            
        }
		stage('AWS Deployment'){	
			steps{
				echo 'start deploying'
				input 'Do you want to procced for Deployment?'
				step([$class: 'AWSCodeDeployPublisher', applicationName: 'DeliveryPipeline', awsAccessKey: '', awsSecretKey: '', deploymentConfig: 'CodeDeployDefault.OneAtATime', deploymentGroupAppspec: false, deploymentGroupName: 'CodeDeployGroup', excludes: '', iamRoleArn: '', includes: '**', proxyHost: '', proxyPort: 0, region: 'us-east-2', s3bucket: 'cicds3', s3prefix: 'deploy', subdirectory: '', versionFileName: '', waitForCompletion: false])
			}		
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
		  //cleanWs()
		}
	}
}