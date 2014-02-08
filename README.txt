Notice
======

This source code was taken from a live website (http://axiom.apertus.org/index.php?site=donate) 
then cleaned up and had all credentials removed.
So the resulting code was not tested to be functional on an actual website.

Please report any issues: http://www.apertus.org/contact


Installation
============

MYSQL Database structure:
install the database by running the SQL query in MYSQL-DB.sql


I know its cumbersome but currently the MYSQL DB connection details have to be manually added in most PHP source files. Maybe someone can streamline that as contribution.

Please use only the 1.7.2 version of Jquery/JqueryUI as older or newer versions are known to break certain functions used on the donation page.


External Classes (already prepacked with this repository)
===============

-) PayPal IPN Listener PHP class by https://github.com/Quixotix/PHP-PayPal-IPN
-) MeektroDB class by Sergey Tsalkov (http://www.meekro.com/)