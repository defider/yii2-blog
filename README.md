Yii 2 Blog Project
==========================

A blog powered by Yii 2 Basic Project Template.

DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      migrations/         contains database migrations
      models/             contains model classes
      modules/            contains the admin module
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources



REQUIREMENTS
------------

The minimum requirement by this application that your Web server supports PHP 5.6.0.


INSTALLATION
------------

### Install via Composer


You can install the application using the following commands:

~~~
git clone https://github.com/defider/yii2-blog.git
cd yii2-blog
composer install
~~~

If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).


GETTING STARTED
---------------

After installing the application, you should take the following steps. You only need to do this once.

1. Create the `yii2blog` database.


2. Open a console terminal, apply migrations with the following command: 
   
   ```
   /path/to/yii2-blog/yii migrate
   ```
   
3. Set document roots of your Web server: 

   `/path/to/yii2-blog/web/` and using the URL `http://yii2-blog/`

**NOTES:**
- Yii won't create the database for you, this has to be done manually before you can access it.
- The database configuration can be found at `config/db.php`.  
- Check and edit the other files in the `config/` directory to customize your application as required.