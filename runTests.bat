set current=%CD%
cd \CairnsGames\phpexec
phpunit -v "%current%"\unitTests\ >"%current%"\unitTests\testOutput.txt
cd "%current%"

