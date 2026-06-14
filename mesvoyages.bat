SonarScanner.MSBuild.exe begin /k:"mesvoyages" /d:sonar.host.url="http://localhost:9000" /d:sonar.token="sqp_767db2e1db7f2a2a8b61d98d24516899273cf054"
MsBuild.exe /t:Rebuild
SonarScanner.MSBuild.exe end /d:sonar.token="sqp_767db2e1db7f2a2a8b61d98d24516899273cf054"