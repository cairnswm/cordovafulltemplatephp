set current=%CD%
cd \phpexec
phpunit -v "%current%"\unitTests\ >"%current%"\unitTests\testOutput.txt
cd "%current%"

