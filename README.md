# OneCMS Application

OneCMS is a content management application that aims to simplify the process of crafting beautiful web applications for the end-user.

> NOTE: The application still in development stage and it is not advisable to used in a production server.

## Installation

### Required Environment

* Web server that can run php
* php >= 8.1
* MySQL/MariaDB

### Preferred way of install

```console
# you can replace 'onecms' as you prefer
mkdir onecms
cd onecms
git clone https://github.com/getonecms/app.git .
```

### Run the `requirements.php` to check your environment first

```console
php requirements.php
```

> NOTE: Follow the output in the console after run above command and do the necessary steps if required.

### Install dependencies

```console
composer install
```

### Create `.env` file

```console
cp .env.sample .env
```

> NOTE: Fill the values in `.env` file according to your environment

After you have finished all the above steps correctly point your server or vm to public folder in order to run the application.
