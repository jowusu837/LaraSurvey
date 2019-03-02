So I wanted to try out the latest version of Laravel, which as at now is 5.8, and I decided to build a simple survey application with it.
Major emphasis on this project is the keen adherence to best practices. I went all the way from database design, through migrations, models, controllers, views, frontend scaffolding with React, and then integration testing. It is a simple application so there aren't so many files; this makes it easy for anyone to go through with ease.

## Setup
First, you must clone the project onto your dev machine with this command
``git clone https://github.com/jowusu837/LaraSurvey.git``

Then you must install the project dependencies by running ``composer install`` from the project root.

After that, you must install all the frontend dependencies too since React was also used in the project. Run ``npm install`` from the project root to do that.

Then remember to edit your env file and set database configurations. Make sure to create a database for the application to run. Database used here is MySql. After you've setup your database, run ``php artisan migrate`` to run all migrations.

Now, run ``php artisan passport:keys`` to initialize Passport.

You should be good to go. Run ``php artisan serve`` to get the inbuilt web server started and enjoy!


## Contributing
Feel free to buzz me if you need any help setting this up. You can also make changes to the readme file and I will gladly merge your changes. Who knows, maybe this might be the next big survey application :)

