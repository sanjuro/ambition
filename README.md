Zend Framekwork 2 API with Angular JS Client
=======================

Introduction
------------
This is a simple, user registration application using the ZF2 MVC layer and module
systems wiht Angular JS. 

Installation
------------

    cd my/project/dir
    git clone git://github.com/sanjuro/ambition
    cd ambition
    php composer.phar self-update
    php composer.phar install
    Run the data/ambition_2014-02-26.sql, this will setup your DB.
    Update the ZF install and up the configs with your DB credentials.


Web Server Setup
----------------

### PHP CLI Server

The simplest way to get started if you are using PHP 5.4 or above is to start the internal PHP cli-server in the root directory:

	cd my/project/dir/public <-- must be in this directory
    php -S 127.0.0.1:8000

This will start the cli-server on port 8000, and bind it to all network
interfaces.

**Note: ** The built-in CLI server is *for development only*.

Open a Browser and goto http://127.0.0.1:8000/app/index.html