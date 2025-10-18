# 👋 Hey there, fellow contributor

> Thank you for being here and considering a contribution to WebifyCMS,
> and together we can make great software.

## Let's Set Up for Development

### Prerequisites

* An environment that can run Docker or Docker Desktop. Please make sure you have installed one.

### Installation

```bash
# create a 'webifycms-stack' folder in your home directory
mkdir -p ~/webifycms-stack && cd ~/webifycms-stack

# let's clone the application into the created folder
git clone https://github.com/webifycms/app.git # clone app into current directory

# clone the extensions that are required
git clone https://github.com/webifycms/ext-base.git # clone ext-base into the current directory
git clone https://github.com/webifycms/ext-admin.git # clone ext-admin into the current directory
git clone https://github.com/webifycms/ext-user.git # clone ext-user into the current directory
git clone https://github.com/webifycms/ext-site.git # (optional) clone ext-site into the current directory
```

> **NOTE:** At this point, you can also clone the extension that you would
> like to contribute, or if you want to start from scratch, you can clone the
> extension template and rename the folder with the extension name that you prefer.

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
    ├── ext-base
    ├── ext-admin
    └── ext-user
```

### Install Dependencies

```bash
# first checkout to the local branch in the 'app' and the 'extensions'
php composer install
```

### Run the Application

Up the containers, that's it.

```bash
docker compose up
```

### Development Workflow

1. First, always make sure your local code is up to date with the remote,
   always `git pull` before you start something, or if you're middle of something, first commit and then do
   `git pull --rebase origin main`.
2. Update your `local` branch with `git pull && git rebase main`.
3. You can start working from the `local` branch.
4. Once you finish, stash your changes `git stash`.
5. **Remember:** You must create a feature branch from the `main` always.
6. If you're trying to resolve an issue that was reported in GitHub, the branch name
   should go like this `issue-{number}-description`, Eg: `issue-20-fix-configurations`
7. From your feature/new branch, pop the changes `git stash pop`
8. Commit your changes and create a pull request after pushing the code.

> ⚠️ You should not ever push the `local` branch to the remote.