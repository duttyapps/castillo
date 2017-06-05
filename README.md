# Castillo CMS
Castillo de Chancay's new webpage project.
This project is still in progress...
You can contribute with this source code if you want, I will be very greatful :) 

I'm using MySQL and PHP7 for programming and Smarty, jQuery and Bootstrap as framework for the frontend and backend.

## 1.- How to install
1.- Edit the configuration file "utils/configuration.php".

2.- Import the SQL file from "sql/castillo.sql".

3.- Chmod 0777 for "cookies/", "images/", "logs/" and "templates_c/" directories or you can run "permisos.php" if you don't want to do it manually.

4.- Run the script!.

## 2.- How to use
### 2.1.- FrontEnd
- If you want to add new module you need to create a new directory into "modules/" with the name of the module then you must create a new php file with the same name (e.g.: "news/" as directory and "news.php" as php file inside "news/" directory). So basically the "controller" (yourdomain.com/news) will look at the inside "modules/" directory and it will locate the module directory and file.

- The template's system is like the modules (read above). I'm using Smarty, if you want to create the template for the new module you need to create inside "templates/" the directory with the same name of the new module (e.g. "news") and create the tpl file inside there (e.g.: "news/" as directory and "news.tpl" as tpl file inside "news/" directory).

- If you want to add a custom javascript file for some module you can add it into "js/modules/". You need to create the directory with the name of the module and create a "script.js" file into. The same way for the customs css, into "css/modules".

### 2.2.- BackEnd
- In this part I didn't make any special way to programming for real. It's a simple web manager, just create the mannager's section into "section/", inside you need to create two files: "index.php" and a php file with the section's name. The "index.php" will be the view and the php file with the section's name will be who contains the php actions... :)


Lets make this system cooler together :)

Salutes.
