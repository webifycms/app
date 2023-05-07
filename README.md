# WebifyCMS Application

WebifyCMS is a content management application that aims to simplify the 
process of crafting beautiful web applications for the end-user.

> NOTE: The application still in development stage, and it is not advisable to used in a production server.

## Installation

### Required Environment

* Web server that can run php
* php >= 8.1
* MySQL/MariaDB

### Preferred way of install

```console
# you can replace 'webifycms' as you prefer
mkdir webify
cd webify
git clone https://github.com/webifycms/app.git .
```

### Install dependencies

```console
composer install
```

### Create `.env` file

> NOTE: In case composer didn't create, you have to do it manually, otherwise skip it.

```console
cp .env.sample .env
```

> NOTE: Fill the values in `.env` file according to your environment

After you have finished all the above steps correctly point your server or 
vm to public folder in order to run the application.
