PHP Unit
========

Needless to say, Unit test is essential for the quality of the project.

The defacto standard tool for unit test in PHP is phpunit.

## 1. Create the configuration file (phpunit.xml) ##
Take the phpunit.xml as the template.

## 2. Make a bootrstrap file (phpunit.php) ##
This file just contains the a line that includes the autoloader from Composer.
It will make the unit test coding easier by freeing you from having to type all the namespace.

## 3. Build compoer autoload file and run the unit test ##
`composer dump-autoload`

`phpunit`