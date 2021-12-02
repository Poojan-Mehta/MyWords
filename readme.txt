Steps to install laravel and run this project
=============================================
---------------------------------
Step 1: (install and run laravel)
---------------------------------

composer create-project laravel/laravel example-app
cd example-app
npm install
php artisan serve

-----------------------------------------
Step 2: (check installed laravel version)
-----------------------------------------

php artisan --version
Laravel Framework 8.68.1

-----------------------------
Step 3: (setup the database)
-----------------------------
create database in phpmyadmin
admin_user_auth_system

In.env file
DB_DATABASE=admin_user_auth_system
DB_USERNAME: whatever the username you have in phpmyadmin (Ex. root).
DB_PASSWORD: whatever the password you have in phpmyadmin

--------------------------------------------------------------------------------------
Step 4: (User auth system default register and login system provide by laravel/breeze)
--------------------------------------------------------------------------------------

composer require laravel/breeze
>> it will create fresh user auth system.

php artisan breeze:install
> it will publish fresh files.

npm install
>> to create node_module folder to compile js and css. it uses tailwind css.

php artisan migrate 
>> to get the default tables created with the laravel installation.

php artisan serve
>> to run the laravel app, go to the given link and you can see the login and register page.

--------------------------------
Step 5: (Basic folder structure)
--------------------------------

app folder
>> http folder: all the controller is defined there.
>> Model folder: Model files is defined there.

resource folder
>> all the view file is defined there.

routes folder
>> web and api routing we should write here.

------------------------
Step 6: (Basic commands)
------------------------

create table with migration
>> php artisan make:migrate create_post_table
>> you will find the migration files in database/migration folder.

create controller
>> php artisan make:controller Post
>> you will find in app/http/controller

--------------------------------------------------
How to generate fake data using factory and tinker
--------------------------------------------------
php artisan make:factory User

follow the link below.
https://stackoverflow.com/questions/63824410/unable-to-use-laravel-factory-in-tinker

--------------------
How to use of seeder
--------------------
>> create seeder to insert value like, if we want to add some role name in our roles project than we can do this using seeder

Steps to make seeder
php artisan make:seeder Rolesseeder

Database/seeders/Rolesseeder.php

public function run()
{
	$roles = ['role_name'=>'Editor'];

	Roles::create($roles); //import roles model to insert the data.
}

Than call in DatabaseSeeder.php

public function run()
{
	// \App\Models\User::factory(10)->create();
	$this->call([RolesSeeder::class]);
}

then run this command in cmd
php artisan db:seed 

and check in your database table you will find the record.

---------------------------------------------------------------------------------

---------------------------------------------------------------------------------
