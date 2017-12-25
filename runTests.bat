set current=%CD%
cd D:\CairnsGames\phpexec
phpunit -v "%current%"\unitTests\ >"%current%"\unitTests\testOutput.txt
cd "%current%"

