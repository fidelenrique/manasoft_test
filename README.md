# ManaSoft test in Docker

##### Maintained by: [Fidel Reyes](freyesllerena33@gmail.com)

This is the Git repository of [ManaSoft test Docker Image](https://github.com/fidelenrique/manasoft_test.git), it build four containers among which : MySql, PHPMyAdmin, Nginx and PHP.

## Requirements
To work with this project, you need to have :
- Docker Desktop Version 3.4.0 (3.4.0.5223)
- a terminal like Git Bash on Windows or Terminal on Mac
- at least **8GB** of memory
- a good Internet connexion
  
## Resources Advanced Docker
-  CPUs: **4**
-  Memory: **2.00 GB**
-  Swap: **1 GB**
-  Disk image size: **59.6 GB (8.6 GB used)**

## How it works ?
To install the project properly you need to follow this [documentation](https://dev.tribvn-hc.com/confluence/display/AT/TeleSlide+5+sous+Docker).

## Images
manasoft_nginx (nginx:1.19.0-alpine)
manasoft_php (tests_php)
manasoft_mysql (mysql:8.0)
manasoft_phpmyadmin (phpmyadmin/phpmyadmin)

## Sites & Tools
- Database : http://localhost:8080/index.php  (user : manasoft  -   pwd : manasoft)
- APP (front) : http://localhost/
- API (back for the front) : http://localhost/api

## More commands
We built some shortcuts commands to help you to do quickly some operations. These command need to be executed on the root of tests folder, in your terminal. Here these commands:

- Up all images : **docker-compose up -d**
- Build images : **docker-compose build**

## More commands GIT
- CLONE APPLUCATION : git clone https://github.com/fidelenrique/manasoft_test.git
- git reset --soft head~1
- UPADTE APPICATION : git pull
- git reset --hard head~1
- git log NOMBRANCH..develop

Have a nice day!