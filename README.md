Yarg
--

Yet Another Resume Builder

What is it ?
============
This is a simple Resume generator.
It also provide a simple page to create your CV(s). 
You can choose to publish your CV or not and to display it on the homepage.

Incoming features:
- PDF export (and pdf permalink)
- Read Only PAI (to integrate your CV on your own website.

You can look at the issue page to see all incoming features.

How to installe ?
=================

First, install [composer](http://getcomposer.org) if you don't have it yet.

Then, get the source code.

    git clone https://lab.bacardi55.org/bacardi55/yarg.git
    cd yarg

/!\ Don't forget to add the right permissions on your yarg directory.

Install dependencies:

    php composer.php update --no-dev

And answer the question (DB configuration) or edit manually app/config/parameters.yml

Generate the database schema:

    php app/console doctrine:schema:update --force
    
The assets are already in the web directory in order to not need to compile less files on the prod server.


/!\ Then install your vhost. The index file needs to be app.php.


Powered by
==========
Build with Symfony2, doctrine, fosuserbundle, fosrestbundle, and all there dependencies :)

Tests are written and tested using behat and mink.