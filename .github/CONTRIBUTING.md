# 👋 Hey there, fellow contributor

> Thank you for being here and considering a contribution to WebifyCMS,
> and together we can make great software.

## Let's Set Up for Development

### Prerequisites

* An environment that can run Docker or Docker Desktop. Please make sure you have installed one.

### Installation

Use WebifyCMS [installer](https://github.com/webifycms/installer) package to install WebifyCMS.

### Create .env file

```bash
cd app && cp .env.sample .env
```

> **NOTE:** The above command will create a `.env` file from the sample file provided
> in the project root and fill the values in the file according to your needs.
> And make sure the `APP_ENVIRONMENT` is set to 'development' and `APP_DEBUG`
> is set to `false`.

> **NOTE:** There are some other default values, and you can change them as needed.
> Add the configured `APP_BASE_URL` value to the host file.

At this point, the expected folder structure will be like this:

```
.
└── webifycms-stack/
    ├── app/
    │   ├── ...
    │   ├── .env
    │   ├── .env.sample
    │   └── ...
    ├── extensions
    │   ├── ext-base
    ├── themes
    │   ├── theme-canvas
```

### Install Dependencies

```bash
# first checkout to the local branch in the 'app' and the 'extensions'
php composer install
```

### Run the Application

You can use PHP's built-in web server:

```bash
php -S localhost:8000 -t public/
```

The application is now available at `http://localhost:8000`.

> **Note:** The built-in server is single-threaded and intended for development
> only. Use a dedicated web server (Nginx, Caddy, etc.) in production.