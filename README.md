# P6_Symfony_SnowTricks

PROJECT 6 SnowTricks - Application developer PHP/Symfony.

## OBJECTIF 
<https://openclassrooms.com/fr/paths/59/projects/42/assignment>


## CONTENT PROJECT
• UML Diagrams
• Database
• Development project (use Issue & Pull request)

## Prerequisite in your workplace <https://www.java.com/fr/download/help/path.html>
- Php 7.4  (x64 Non Thread Safe) or (x86 pour les versions 32 bits) <https://windows.php.net/download#php-7.4>
- Composer  <https://getcomposer.org/download/> (to manage dependencies and libraries)
- Symfony command <https://symfony.com/doc/current/the-fast-track/fr/1-tools.html#symfony-cli>

### Install in your workplace PHP, Composer and Symfony (variable environment)
- exemple : <https://www.twilio.com/blog/2017/01/how-to-set-environment-variables.html>
- Then check with next command in your terminal whatever where path :

    • <code>php -v</code>

    • <code>composer -V</code>

    • <code>symfony -V</code>

- Database (

    • Postgresql <https://www.postgresql.org/download/>

    • Mysql <https://www.mysql.com/fr/downloads/>
)
- Git <https://git-scm.com/download/win>
- Terminal (

  • By default with Visual studio code (ctrl+ù OR view -> terminal)
  
  • Hyper <https://hyper.is/>
  
  • Git bash <https://gitforwindows.org/>
  
  )

# HOW TO INSTALL

## Step 1 ( Recover the project ) :
- Choose where you want to install the project in your Computer and open your terminal.
- Clone it with the next command : <https://github.com/SiProdZz/P6_Symfony_SnowTricks.git>

## Step 2 ( Connect your project at your database ) :
- create a file ".env.local" in the same directory as ".env" and complet it to acces at your database
    exemple : DATABASE_URL=postgres://postgres:password!@127.0.0.1:5432/name_database

## Step 3 ( Update composer to your project ) [optional] :
- use <code>composer install</code> in your terminal to install and update all dependencies and libraries 

## Step 4 ( Create your database and add Fixtures ) :
- Open your terminal and use the next command to install and prepare your database

    • <code>symfony console doctrine:database:create</code> to create your database

    • <code>symfony console make:migration</code> to create a migration file

    • <code>symfony console doctrine:migrations:migrate</code> to create dababase table

    • <code>symfony console doctrine:fixtures:load</code> to generate fixtures in your database create already in the project

## Step 5 ( Run symfony server and open your project ) :
-Start your terminal, and go in the path where is the project and run next command :
    • <code>symfony server:start -d</code>

# IDE ( Visual studio code ) 
Installer VScode https://code.visualstudio.com/

  --- Extensions conseillées :

    • PHP Intelephense - Code php intelligent

    • PHP Namespace Resolver - Gérer les namespaces automatiquement

    • Twig Language 2 - Twig
    
    
  --- Configurations conseillées :

    • Settings -> rechercher "Suggest basic" -> Décocher "PHP: Suggest:basic - Enlève des éléments pour l'auto complétion

    • Settings -> rechercher "format" -> Décocher "EDITOR: format on save" - Lors d'une sauvegarde d'un fichier, l'indente automatiquement correctement

    • Settings -> rechercher "emmet" -> Dans "Emmet Include Languages" - value = langage concerné | item = formater au langage souhaité

      -> item = "twig", value = "html"
