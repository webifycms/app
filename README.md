# WebifyCMS

> 👋 Hey there! We're still in the early stage of development, so you may not find all the features just yet.
> It's not quite ready for use in productions, but we'd love for you to give it a try,
> Don't mind to [log bugs](https://github.com/webifycms/app/issues) and help us improve it! Thanks for your support.

WebifyCMS is an application framework that enables users to craft stunning web applications.
The framework simplifies the creation process with built-in content management features.

* WebifyCMS is designed with **Clean Architecture** and **Domain Driven Design (DDD)** to separate and protect
  the business logic. It helps to maintain the entire codebase easily and makes it adaptable to technological changes.
* Each bounded context has been divided into an extension for easy development,
  and the [base](https://github.com/webifycms/ext-base) extension contains reusable 
  components and is known as shared-kernel.
* Targeting the end-user for easy customization, administrating, designing, and developing new features.
* Fully customizable user interfaces, including the admin panel with themes.

## Features

The project is currently in its early stages of development, and many features are yet to come.
Here is our roadmap of current and upcoming features for reference:

| Features                                                                    | Status          |
|-----------------------------------------------------------------------------|-----------------|
| Base extension (shared-kernel)                                              | ✅ done          |
| Application skeleton with the default configurations                        | ✅ done          |
| dev-tools package to define coding standards, to use static analyzer etc... | ✅ done          |
| Installer package to handle installation of WebifyCMS stack                 | ✅ done          |
| Admin extension                                                             | ⏳ in progress   |
| User extension                                                              | ⏳ in progress   |
| Default theme                                                               | ⏳ in progress   |
| Site extension                                                              | ✳️ yet to start |
| Blog extension                                                              | ✳️ yet to start |
| Market extension to manage extensions and themes                            | ✳️ yet to start |

## Quick Start

The following instructions will help you to get a copy of WebifyCMS up and running on your local machine
for development and testing purposes.

### Prerequisites

* An environment that can run PHP built-in web server.
* Composer to manage dependencies.
* PHP 8.4 or higher.

### Installation

Use WebifyCMS [installer](https://github.com/webifycms/installer) package to install WebifyCMS.

### Run the application

You can use PHP's built-in web server:

```bash
php -S localhost:8000 -t public/
```

The application is now available at `http://localhost:8000`.

> **Note:** The built-in server is single-threaded and intended for development
> only. Use a dedicated web server (Nginx, Caddy, etc.) in production.

[//]: # (## Contributors)

[//]: # (> A huge thanks to the brilliant minds helping us prove that together, we can make great software.)

[//]: # ()
[//]: # (<a href="https://github.com/webifycms/app/graphs/contributors">)

[//]: # (  <img src="https://contrib.rocks/image?repo=webifycms/app"  alt="WebifyCMS Contributors"/>)

[//]: # (</a>)

## 🤝 Like to contribute?

Contributions, issues, and feature requests are welcome! Feel free to check the following pages:

* [Wiki Page](https://github.com/webifycms/app/wiki)
* [Project](https://github.com/orgs/webifycms/projects/4)
* [Contribution notes](https://github.com/webifycms/app/blob/main/CONTRIBUTING.md).
* [Issues page](https://github.com/webifycms/app/issues).
* [Code of conduct notes](https://github.com/webifycms/app/blob/main/CODE_OF_CONDUCT.md).

## ⭐️ Show your support

If this project interests you, please consider giving it a ⭐️!

## Author

👤 **Mohammed Shifreen** (Project Lead)

* Website: <https://mshifreen.com/>
* Github: [@Shifrin](https://github.com/Shifrin)
* LinkedIn: [@https://www.linkedin.com/in/mshifreen/](https://linkedin.com/in/https://www.linkedin.com/in/mshifreen/)

## License

WebifyCMS is licensed under MIT license, see the [LICENSE.md](https://github.com/webifycms/app/blob/main/LICENSE.md)
file for details.