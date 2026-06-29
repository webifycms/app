# WebifyCMS Guide

A practical walkthrough of bootstrapping, configuring, and extending a
WebifyCMS application. This guide covers the infrastructure layer —
everything from environment variables and configuration to service
providers, extensions, kernels, controllers, and error handling.

---

- [Environment Variables](#environment-variables)
    - [Available Variables](#available-variables)
    - [Setup](#setup)
- [Configuration](#configuration)
    - [The Config Interface](#the-config-interface)
    - [Creating a Config Instance](#creating-a-config-instance)
    - [Reading Values](#reading-values)
    - [Immutability with `with()`](#immutability-with-with)
- [Environment](#environment)
    - [Factory Method](#factory-method)
    - [Runtime Checks](#runtime-checks)
- [Application Lifecycle](#application-lifecycle)
    - [Phase 1: Instantiation](#phase-1-instantiation)
    - [Phase 2: Bootstrap](#phase-2-bootstrap)
    - [Phase 3: Run](#phase-3-run)
- [Container Building](#container-building)
    - [Container Builder Interface](#container-builder-interface)
    - [PHP-DI Builder](#php-di-builder)
- [Service Providers](#service-providers)
    - [ServiceProviderInterface](#serviceproviderinterface)
    - [BootstrapServiceProviderInterface](#bootstrapserviceproviderinterface)
    - [Registration Methods](#registration-methods)
    - [Constructor Constraints](#constructor-constraints)
- [Extensions](#extensions)
    - [Extension Interface](#extension-interface)
    - [Registration](#registration)
- [Kernels](#kernels)
    - [HTTP Kernel](#http-kernel)
    - [Console Kernel](#console-kernel)
- [Controllers](#controllers)
    - [Structure](#structure)
    - [Registration](#registration)
- [Error Handling](#error-handling)
    - [Error Handler Interface](#error-handler-interface)
    - [Flow](#flow)
- [Complete Bootstrap Example](#complete-bootstrap-example)
- [Architecture Tests](#architecture-tests)
    - [Running Tests](#running-tests)
    - [Writing Rules](#writing-rules)

---

## Environment Variables

Sensitive and environment-specific values are managed through `.env` files
using [vlucas/phpdotenv](https://github.com/vlucas/phpdotenv). The `.env` file
is loaded **before** the config array, so `$_ENV` values are available when
`config/config.php` is evaluated.

### Available Variables

The supported variables are documented in `.env.example`:

| Variable      | Default       | Description                                         |
|---------------|---------------|-----------------------------------------------------|
| `APP_NAME`    | `WebifyCMS`   | Application name                                    |
| `APP_ID`      | `webifycms`   | Application identifier                              |
| `APP_VERSION` | `0.0.1`       | Application version                                 |
| `APP_ENV`     | `development` | Runtime environment (`production` or `development`) |
| `APP_DEBUG`   | `true`        | Enable/disable debug mode                           |

### Setup

Copy `.env.example` to `.env` and adjust as needed:

```bash
cp .env.example .env
```

> **Note:** `.env` is gitignored. Never commit secrets or environment-specific
> values to the repository.

> **Important:** Don't try to read an environment variable outside the config file,
> it should be read from the config array only.

---

## Configuration

The configuration system is built around the `ConfigInterface` and its concrete
implementation `Config`.

### The Config Interface

`ConfigInterface` (`Webify\Base\Application\Service\ConfigInterface`) defines
the application configuration contract using PHP 8.4 property hooks:

```php
interface ConfigInterface extends KeyValueReaderInterface
{
    public const string CACHE_DIR = 'cache';
    public const string LOG_DIR   = 'log';

    public string $basePath { get; }
    public string $runtimePath { get; }
    public string $configPath { get; }
    public string $cachePath { get; }
    public string $logPath { get; }
    public string $baseUrl { get; }

    public function with(array $config): ConfigInterface;
}
```

### Creating a Config Instance

The concrete implementation `Webify\Base\Infrastructure\Service\Config` accepts
an associative array and computes `cachePath` and `logPath` from `runtimePath`:

```php
use Webify\Base\Infrastructure\Service\Config;

$config = new Config([
    'basePath'    => '/var/www/app',
    'runtimePath' => '/var/www/app/var',
    'configPath'  => '/var/www/app/config',
    'baseUrl'     => 'https://example.com',
    'id'          => 'my-app',
]);
```

### Reading Values

The config also supports arbitrary key-value storage via
`get(string $key, mixed $default = null): mixed` and
`has(string $key): bool`, inherited from `KeyValueReaderInterface`.

### Immutability with `with()`

The `with()` method returns a new instance with the given configuration
merged in, enabling immutable config overrides:

```php
$config = $baseConfig->with(['debug' => true]);
```

---

## Environment

The environment is managed through `Webify\Base\Infrastructure\Environment\Environment`,
a final readonly class.

### Factory Method

The environment is created via the static factory `prepare()`:

```php
use Webify\Base\Infrastructure\Environment\Environment;
use Webify\Base\Infrastructure\Environment\Type;

$environment = Environment::prepare($config);
```

### Runtime Checks

The environment object provides several runtime checks:

```php
$environment->isProduction();   // true when Type::Production
$environment->isDevelopment();  // true when Type::Development
$environment->isDebugEnabled(); // controlled by config key 'debug'
```

The config must contain an `environment` key matching one of the `Type` enum
values (`'production'` or `'development'`). The `debug` key (boolean) enables
verbose error output.

By default these values are sourced from the `.env` file via `$_ENV['APP_ENV']`
and `$_ENV['APP_DEBUG']`. Sensible defaults are defined in `config/config.php`,
so the application works out of the box without a `.env` file during development.

---

## Application Lifecycle

`Webify\Base\Infrastructure\Service\Application` is the central bootstrap
class. Its lifecycle follows three phases.

### Phase 1: Instantiation

Validate paths and create runtime directories.

```php
$app = new Application($config, $environment);
```

### Phase 2: Bootstrap

Build the DI container and run bootstrap providers. Providers must be
registered *before* bootstrapping.

```php
$app->registerProvider(new MyServiceProvider());
$app->bootstrap(new PhpDiContainerBuilder());
```

### Phase 3: Run

Dispatch the HTTP request or console command.

```php
$app->run();         // HTTP
$app->runConsole();  // CLI (returns exit code)
```

---

## Container Building

The container is built by implementations of `ContainerBuilderInterface`.

### Container Builder Interface

```php
interface ContainerBuilderInterface
{
    public function build(Application $app): ContainerInterface;
}
```

### PHP-DI Builder

The default is `PhpDiContainerBuilder`, which uses PHP-DI. The builder
receives the `Application` instance, giving it access to the config,
environment, and any previously registered providers:

- Autowiring is enabled
- `ConfigInterface` and `Environment` are pre-registered as shared services
- Provider definitions are loaded from the `providers` config array
- Extension providers are loaded from the `extensions` config array
- In production mode, compilation and proxy file generation are enabled,
  writing to the cache path defined in config

```php
use Webify\Base\Infrastructure\Container\PhpDiContainerBuilder;

$app->bootstrap(new PhpDiContainerBuilder());
```

After bootstrapping, the PSR-11 container is available anywhere in your
application by type-hinting `Psr\Container\ContainerInterface`. The container
registers itself as a shared service, so it can be injected into constructors
of controllers, service providers, or any other class resolved by the DI
container:

```php
use Psr\Container\ContainerInterface;

final readonly class SomeService
{
    public function __construct(
        private ContainerInterface $container,
    ) {}

    public function doSomething(): void
    {
        $router = $this->container->get(Router::class);
        // ...
    }
}
```

---

## Service Providers

Service providers allow extensions to register container definitions and
perform bootstrapping logic. Two interfaces are available.

### ServiceProviderInterface

Provides container definitions **before** the container is built:

```php
use Webify\Base\Infrastructure\Contract\ServiceProviderInterface;

final class MyProvider implements ServiceProviderInterface
{
    public function getDefinitions(): array
    {
        return [
            'my.service' => DI\autowire(MyService::class),
        ];
    }
}
```

### BootstrapServiceProviderInterface

Performs bootstrapping **after** the container is built (routes, middleware,
commands, listeners):

```php
use Webify\Base\Infrastructure\Contract\BootstrapServiceProviderInterface;
use Psr\Container\ContainerInterface;
use League\Route\Router;

final class MyBootstrapProvider implements BootstrapServiceProviderInterface
{
    public function bootstrap(ContainerInterface $container): void
    {
        $router = $container->get(Router::class);
        $router->map('GET', '/hello', new HelloController());
    }
}
```

A single class may implement both interfaces. The base extension's
`BaseServiceProvider` implements `ServiceProviderInterface` and delegates
definition loading to the central `definitions.php` file:

```php
final readonly class BaseServiceProvider implements ServiceProviderInterface
{
    public function getDefinitions(): array
    {
        return require __DIR__ . '/../definitions.php';
    }
}
```

### Registration Methods

Providers can reach the application in two ways:

**Direct registration** — passed as an instance to `$app->registerProvider()`.
The provider may have any constructor dependencies because you construct it
yourself:

```php
$app->registerProvider(new MyProvider($someDependency));
```

**Config autodiscovery** — listed in the `providers` config array as a
class-string. The container builder instantiates them with `new $class()`.

```php
$config = new Config([
    'providers' => [
        MyProvider::class,
    ],
]);
```

### Constructor Constraints

Providers listed in the config `providers` array **must have a parameterless
constructor** (or no explicit constructor at all) since the builder does not
resolve their dependencies from the container.

The same applies to providers returned by an extension's `getProviders()` —
they are also instantiated with `new $class()` and must have no required
constructor parameters.

If a provider needs container services, it pulls them from the `ContainerInterface`
argument passed to `bootstrap()` — not from its own constructor.

Providers are registered before bootstrapping:

```php
$app->registerProvider(new BaseServiceProvider());
$app->registerProvider(new MyProvider());
$app->bootstrap(new PhpDiContainerBuilder());
```

---

## Extensions

Extensions represent reusable packages that bundle multiple service providers.

### Extension Interface

They implement `ExtensionInterface`:

```php
use Webify\Base\Infrastructure\Contract\ExtensionInterface;
use Webify\Base\Infrastructure\Contract\ServiceProviderInterface;

final class MyExtension implements ExtensionInterface
{
    public function getId(): string
    {
        return 'my_extension';
    }

    public function getName(): string
    {
        return 'My Extension';
    }

    /** @return array<class-string<BootstrapServiceProviderInterface|ServiceProviderInterface>> */
    public function getProviders(): array
    {
        return [
            MyExtensionServiceProvider::class,
        ];
    }

    public function getVersion(): string
    {
        return '1.0.0';
    }
}
```

### Registration

Extensions are registered via the `extensions` config array:

```php
$config = new Config([
    'extensions' => [
        MyExtension::class,
    ],
]);
```

During container building, each extension's providers are instantiated,
registered, and their definitions added to the container — just like
directly registered providers.

---

## Kernels

Two kernels handle the application's entry points.

### HTTP Kernel

`Webify\Base\Infrastructure\Kernel\Http` creates a PSR-7 server request from
PHP globals, dispatches it through the League router, and emits the response.
Errors are handled internally — logged, then passed to `ErrorHandlerInterface`
to produce an appropriate HTTP response.

In debug mode non-404 exceptions are re-thrown so a development tool like
Whoops can render a diagnostic page:

```php
// Registered automatically as 'httpKernel' in definitions.php
$app->run();
```

### Console Kernel

`Webify\Base\Infrastructure\Kernel\Console` wraps the Symfony Console
application and runs it:

```php
// Registered automatically as 'consoleKernel' in definitions.php
$app->runConsole(); // returns exit code
```

---

## Controllers

Controllers live in `Infrastructure\Presentation\Http\Controller\` and follow
a consistent pattern.

### Structure

- **Single action** — each controller is an invokable class (`__invoke`).
  No `IndexController` with five methods; use one class per route.
- **Readonly** — controllers are `final readonly class` instances.
- **PSR-7 in, PSR-7 out** — they receive `ServerRequestInterface` and return
  `ResponseInterface`.
- **Minimal dependencies** — the only injected dependency is a PSR-17 factory
  (usually `Psr17Factory`) so they can create responses and streams.

```php
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\{ResponseFactoryInterface, ResponseInterface, ServerRequestInterface, StreamFactoryInterface};

final readonly class Home
{
    public function __construct(
        private ResponseFactoryInterface $responseFactory,
        private StreamFactoryInterface $streamFactory
    ) {}

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $response = $this->responseFactory->createResponse(200);
        $body     = $this->streamFactory->createStream('Hello, world!');

        return $response
            ->withBody($body)
            ->withHeader('Content-Type', 'text/plain')
        ;
    }
}
```

### Registration

Controllers are registered as routes inside a `BootstrapServiceProvider`:

```php
public function bootstrap(ContainerInterface $container): void
{
    $router = $container->get(Router::class);
    $router->map('GET', '/', [Home::class, '__invoke']);
}
```

The PSR-17 factory is autowired by the container, so you never need to register
it — just type-hint it in the controller's constructor.

---

## Error Handling

Error handling is managed through `Webify\Base\Infrastructure\Contract\ErrorHandlerInterface`.

### Error Handler Interface

```php
use Psr\Http\Message\{ResponseInterface, ServerRequestInterface};
use Throwable;

interface ErrorHandlerInterface
{
    public function handle(ServerRequestInterface $request, Throwable $throwable): ResponseInterface;
}
```

### Flow

The interface is consumed by the HTTP kernel, not as middleware. When a
`Throwable` is caught during request dispatch:

1. The error is **logged** with full context (message, file, line, URI, method).
2. In **debug mode** (`isDebugEnabled()` returns `true`): the exception is
   re-thrown so Whoops (or a similar tool) renders a diagnostic page. 404
   exceptions are always handled gracefully and never re-thrown.
3. In **production mode**: the exception is passed to the `ErrorHandlerInterface`
   implementation, which returns an appropriate HTTP error response.

Applications provide their own `ErrorHandlerInterface` implementation. The
base extension does not ship a concrete error handler — it only defines the
contract.

---

## Complete Bootstrap Example

The following is the actual bootstrap sequence used by the application's
entry point (`public/index.php`):

```php
use Dotenv\Dotenv;
use Webify\Base\Infrastructure\Container\PhpDiContainerBuilder;
use Webify\Base\Infrastructure\Environment\Environment;
use Webify\Base\Infrastructure\Service\{Application, Config};

// 0. Load environment variables from .env (optional — falls back to defaults)
Dotenv::createImmutable(__DIR__ . '/..')->safeLoad();

// 1. Load configuration array and create the Config instance
$config = new Config(require __DIR__ . '/../config/config.php');

// 2. Environment
$environment = Environment::prepare($config);

// 3. Application
$app = new Application($config, $environment);

// 4. Register additional providers (e.g. development-only)
// Core providers (BaseServiceProvider) are auto-discovered from
// the config 'providers' array during bootstrap
$app->registerProvider(new DevelopmentServiceProvider());

// 5. Bootstrap (builds container, runs bootstrap providers)
$app->bootstrap(new PhpDiContainerBuilder());

// 6. Run
$app->run();
```

Core service providers (including `BaseServiceProvider`) are loaded
automatically from the config's `providers` array, so direct registration
via `registerProvider()` is only needed for providers outside that list
(such as environment-specific ones).

---

## Architecture Tests

Architecture rules are enforced by **phpat** as part of the PHPStan analysis
pipeline.

### Running Tests

Run them with:

```bash
vendor/bin/phpstan analyse
```

### Writing Rules

The `ArchitectureSpec` class in `test/Architecture/` defines all rules.
Tests follow a fluent pattern:

```php
public function testRuleName(): Rule
{
    return PHPat::rule()
        ->classes(Selector::inNamespace('Webify\Base\Domain'))
        ->shouldNot()
        ->dependOn()
        ->classes(Selector::inNamespace('Webify\Base\Infrastructure'))
        ->because('description of the rule');
}
```

Adding a new rule is straightforward — create a new method returning `Rule`
in `ArchitectureSpec.php`.
