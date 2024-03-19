# analyzenbd Laravel 10 CRUD Application

Laravel Recruitment Assessment



## Installation 
Make sure that you have setup the environment properly. You will need minimum PHP 8.1, MySQL/MariaDB, and composer.

1. Download the project (or clone using GIT)
2. Copy `.env.example` into `.env` and configure your database credentials
3. Go to the project's root directory using terminal window/command prompt
4. Run `composer install`
5. Run `npm install`
6. Run `npm run dev`
7. Set the application key by running `php artisan key:generate`
8. Storage Link the application by running `php artisan storage:link`
9. Run migrations `php artisan migrate`
10. Start local server by executing `php artisan serve`
11. User Unit Test Check the application by running `php artisan test --testsuite=Unit`
12. Visit here [http://127.0.0.1:8000](http://127.0.0.1:8000) to test the application


# Instruction

* Register main user Login
* Create view, edit and delete Custom user
* see the customer list
* When delete is clicked, the data will be moved to a soft delete custom user list page.
* You will see options to Restore or Permanently Delete the data on the Soft delete list page. Clicking the Restore button will restore the data, while clicking the Permanently Delete button will remove the data from the database table row.
