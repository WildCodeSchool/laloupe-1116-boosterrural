booster rural
============

A Symfony project created on December 5, 2016, 3:43 pm.

Language used: PHP/Symfony - SQL/Doctrine - HTML/CSS - JS

 Objectif:
 
 Booster rural est une application visant à mettre en relations les maires, acteurs dynamiques et citoyens présents dans les territoires ruraux.

Installation du projet:

 Requis:

    Installer composer 

 Installer le projet:
    
    git clone git@github.com:WildCodeSchool/laloupe-1116-boosterrural.git
    cd laloupe-1116-boosterrural
    composer install
    php app/console doctrine:database:create
    php app/console doctrine:schema:update --force (to update the changes)
    php app/console asset:install (to update the CSS)
    php app/console cache:clear 