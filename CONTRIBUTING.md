# 👋 Hey there fellow contributor

> Thank you for being here and considering contribution to WebifyCMS, 
> and together we can make a great software.

## Let's Setup for Development

### Prerequisites

* An environment that can run Docker or Docker Desktop 
and ensure you have installed one.

### Installation

```bash
# create a 'webifycms-stack' folder in your home directory
mkdir ~/webifycms-stack
cd ~/webifycms-stack

# let's clone the application into the created folder
git clone https://github.com/webifycms/app.git .

# clone the extensions that is required
git clone https://github.com/webifycms/ext-base.git .
git clone https://github.com/webifycms/ext-admin.git .
git clone https://github.com/webifycms/ext-site.git . # (optional)
```

> **NOTE:** At this point you can also clone the extension that you would 
> like to contribute or if you want to start from a scratch, you can clone the 
> extension template and rename the folder with the extension name that you prefer.

### Create .env file

```bash
cp .env.sample .env
```

> **NOTE:** The above command will create a `.env` file from the sample file provided 
> in the project root and fill the values in the file according to your needs.
> And make sure the `APP_ENVIRONMENT` is set to 'development' and `APP_DEBUG` 
> is set to `false`.

> **NOTE:** There are some other default values, and you can change them as needed. 
> Add the configured `APP_BASE_URL` value to the host file.

### Install Dependencies

```bash
# first checkout to the local branch in the 'app' and the 'extensions'
php composer install
```

### Run the Application

Up the containers and that's it.

```bash
docker compose up
```

### Development Workflow

1. First always make sure your local code is up to date with the remote, 
always `git pull` before you start something or if you're middle of something do 
`git pull --rebase origin main`.
2. Update your `local` branch with `git pull && git rebase main`. 
3. You must create a feature branch from the `main` always.
4. If you're trying to resolve an issue that reported in GitHub, the branch name 
should goes like this `issue-{number}-description`, Eg:- `issue-20-fix-configurations`
5. Update the documents if needed.
6. Once you finish the development create a pull-request after push the code.

> ⚠️ You should not ever push `local` branch to the remote.