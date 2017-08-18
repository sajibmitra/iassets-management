## Iassets-Management

Iassets-Management is a web application for ICT Inventory/Assets Management System. Iassets-Management was developed using Laravel Framework version 5.3.29.

### Requirements

#### In case of VM (Homestead)

Vagrant, Virtual box or other VM tools, Homestead  

#### Without out VM Support

**php 7.0** (or latest version), **mysql** database server, **nginx** or **apache2** web server 

### Basic Installation and Running Web Page

#### Download Source Code and Install Required Packages

`$git clone https://github.com/sajibmitra/iassets-management.git`

`$cd iassets-management`

`$composer install`

#### Rename `.env.example` file to `.env`

`$php artisan key:generate`

`$php artisan serve` 

**Laravel development server started on http://127.0.0.1:8000/**

#### Web Server Configuration

##### With Using Virtual Machine (**Homestead**)

If you are using Homestead install following package:

`$composer require laravel/homestead`

If you already have vagrant & laravel/homestead installation 

`$vagrant init && homestead make`

`$vagrant up`

Check out on browser with server IP: 192.168.10.10. 

If anything wrong run following command:

`$vagrant provision` 

##### Without Using VM

Link your web server to **public/** directory.  

#### Database Migration 

Write down Your Database Server correctly in **.env** file:

`DB_HOST=<DB Server name/IP address>`

Create `homestead`  user and `homestead` database with password (as defined in **.env** file) in **mysql** database in Database Server. 

$php artisan migrate

**Go to web page http://192.168.10.10 and click on Register**

Enjoy
## License
The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
