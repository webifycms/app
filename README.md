# WebifyCMS

![WebifyCMS_Logo](https://github.com/webifycms/app/assets/7717399/25fbf644-c5bd-47a8-a03d-526e9e984e99)

> 👋 Hey there! We're still in the early stage of development, so you may not find all the features just yet. It's not quite ready for use in productions, but we'd love for you to give it a try, Don't mind to [log bugs](https://github.com/webifycms/app/issues) and help us improve it! Thanks for your support.

WebifyCMS is an application framework that enables users to craft stunning web applications. The framework simplifies the creation process with built-in content management features.

* WebifyCMS is designed with **Clean Architecture** and **Domain Driven Design (DDD)** to separate and protect the business logic. It helps to maintain the entire codebase easily and makes it adaptable to technological changes.
* Each bound context has been divided into an extension for easy development, and the base extension contains reusable components.
* Develop with [Yii](https://www.yiiframework.com/) framework to handle the infrastructure without reinventing the wheel.
* Targeting the end-user for easy customization, administrating, designing, and developing new features.
* Fully customizable user interfaces, including the admin panel and theme support.

## Features

The project is currently in its early stages of development, and many features are yet to come. Here is our roadmap of current and upcoming features for reference:

| Feature                                                                            | Status          |
|------------------------------------------------------------------------------------|-----------------|
| Develop a base extension for reusable components                                   | ✅ done          |
| Create application skeleton with the default configurations                        | ✅ done          |
| Create dev-tools package to define coding standards, to use static analyzer etc... | ✅ done          |
| Implement Docker with Docker compose                                               | ✅ done          |
| Develop an admin extension                                                         | ⏳ in progress   |
| Develop an user extension                                                          | ⏳ in progress   |
| Develop a default theme                                                            | ⏳ in progress   |
| Develop a site extension                                                           | ✳️ yet to start |
| Develop a blog extension                                                           | ✳️ yet to start |
| Develop a market extension to manage extensions and themes                         | ✳️ yet to start |

## Quick Start

The following instructions will help you to get a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

* An environment that can run Docker or Docker Desktop and ensure you have installed one.

### Installation

```console
# you can replace 'webifycms' folder name as you prefer
mkdir webifycms
cd webifycms
# let's clone the application into the created folder
git clone https://github.com/webifycms/app.git .
```

### Create `.env` file

```console
cp .env.sample .env
```

> The above command will create a .env file from the sample file provided in the project root and fill the values in the file according to your needs. There are some default values and you can change them if needed. Add the configured `APP_BASE_URL` value to the host file.

### Time to run the containers

```console
docker compose up -d
```

### Run the application

Navigate to the `APP_BASE_URL` value you configured in any browsers you prefer.

## 🤝 Like to contribute?

Contributions, issues and feature requests are welcome! Feel free to check the following pages:

* [Contribution notes](https://github.com/webifycms/app/blob/main/CONTRIBUTING.md).
* [Issues page](https://github.com/webifycms/app/issues).
* [Code of conduct notes](https://github.com/webifycms/app/blob/main/CODE_OF_CONDUCT.md).

## ⭐️ Show your support

If this project interests you, please consider giving it a ⭐️!

## Authors

👤 **Mohammed Shifreen** (Project Lead)

* Website: <https://mshifreen.com/>
* Github: [@Shifrin](https://github.com/Shifrin)
* LinkedIn: [@https://www.linkedin.com/in/mshifreen/](https://linkedin.com/in/https://www.linkedin.com/in/mshifreen/)

## License

WebifyCMS is licensed under MIT license, see the [LICENSE.md](https://github.com/webifycms/app/blob/main/LICENSE.md) file for details.
