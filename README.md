Landingpage
=======================

Introduction
------------
This is a simple sign up form application. Registered users will be assigned to a campaign by reading
the GET query parameter 'camp'. If camp is not given the user will be assigned to the campaign 'DEFAULT'

Example calls
------------

    http://landingpage
    http://landingpage?camp=google


Installation
------------
    git clone https://github.com/ATDDWorkshop/landingpage.git

Assuming you already have Composer:

    composer.phar install

Add a alias to your /etc/hosts

    127.0.0.1   landingpage    

### PHP CLI Server

The simplest way to get started if you are using PHP 5.4 or above is to start the internal PHP cli-server in the root directory:

    php -S 0.0.0.0:8080 -t public/ public/index.php

This will start the cli-server on port 8080, and bind it to all network
interfaces.

**Note: ** The built-in CLI server is *for development only*.

### Apache Setup

To setup apache, setup a virtual host to point to the public/ directory of the
project and you should be ready to go! It should look something like below:

    <VirtualHost *:80>
        ServerName landingpape
        DocumentRoot /path/to/landingpage/public
        SetEnv APPLICATION_ENV "development"
        <Directory /path/to/landingpage/public>
            DirectoryIndex index.php
            AllowOverride All
            Order allow,deny
            Allow from all
        </Directory>
    </VirtualHost>
