
## User Management System

This is a laravel example project. 

# How to Install

1. `composer install`
2.  `change .env.example File to .env and setup .env database information`
3. run command : `php artisan key:generate`
4. run command : `php artisan migrate`
5. run command : `php artisan passport:install --force`
6. run command : `php artisan serve`
7. open web server and setup username and password for admin & login.

Done !

# Backend Framework : Laravel 5.8

Backend Used Libraries :
- https://github.com/laravel/passport ( For safe api authentication )

Frontend Used libraries :
- https://github.com/harvesthq/chosen/
- https://github.com/DataTables/DataTables
- https://github.com/ColorlibHQ/AdminLTE
- Bootstrap3 https://github.com/twbs/bootstrap


# Task: User management system
We have designed a coding task that is intentionally vague and open-ended in its specification so that you have the opportunity to take it in almost any direction you wish.
Stories.

- As an admin I can add users — a user has a name.
- As an admin I can delete users.
- As an admin I can assign users to a group they aren’t already part of. • As an admin I can remove users from a group.
- As an admin I can create groups.
- As an admin I can delete groups when they no longer have members.
-  Design a convenient API that other developers would love to use for the tasks above.
