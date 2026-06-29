# WebifyCMS Architecture

The document covers the architecture of the WebifyCMS application and
provides a reference for developers who want to extend the application or
build a new extension.

---

- [Architecture](#architecture)
    - [Dependency Rules](#dependency-rules)
    - [Adding Classes to a Layer](#adding-classes-to-a-layer)
    - [Architecture Tests](#architecture-tests)
- [Directory Structure](#directory-structure)
- [Design Patterns](#design-patterns)
    - [Domain Layer](#domain-layer)
    - [Application Layer](#application-layer)
    - [Infrastructure Layer](#infrastructure-layer)
    - [Contract Layer](#contract-layer)

---

## Architecture

The extension follows a **Domain-Driven Design (DDD)** layered architecture with
a **Clean Architecture** dependency rule set. The source code is organised into
four top-level namespaces under `Webify\Base`:

| Layer              | Namespace                    | Purpose                                                                                                                                       |
|--------------------|------------------------------|-----------------------------------------------------------------------------------------------------------------------------------------------|
| **Domain**         | `Webify\Base\Domain`         | Enterprise business rules — entities, value objects, domain events, domain services, and domain contracts (interfaces defined by the domain). |
| **Application**    | `Webify\Base\Application`    | Application-level contracts such as `ConfigInterface`. Thin glue; no infrastructure references. |
| **Infrastructure** | `Webify\Base\Infrastructure` | Framework and library implementations — container, kernels, error handling, database repositories, Symfony/League integrations. |
| **Contract**       | `Webify\Base\Contract`       | Technical utilities and interfaces (e.g. `Collection`, `KeyValueReaderInterface`, `ArraySearchHelper`) that any layer may use. Depends on no layer. |

### Dependency Rules

The following rules are enforced by automated architecture tests
(see [Architecture Tests](#architecture-tests)):

```
┌──────────┐
│ Contract │  ← used by any layer, depends on nothing
└──────────┘

  ┌───────────┐
  │  Domain   │  ← innermost — entities, business rules
  └─────┬─────┘
        │
  ┌─────▼───────┐
  │ Application │  ← thin glue, no infrastructure
  └─────┬───────┘
        │
  ┌─────▼──────────┐
  │ Infrastructure │  ← implements domain & app contracts
  └────────────────┘
```

| Rule                                                                | Description                                                                                                                                                |
|---------------------------------------------------------------------|------------------------------------------------------------------------------------------------------------------------------------------------------------|
| **Domain** must not depend on **Application** or **Infrastructure** | The domain layer is the innermost ring. It may use **Contract** utilities but must not reference application or infrastructure code.                       |
| **Application** must not depend on **Infrastructure**               | Application interfaces sit between domain and infrastructure. They define contracts (e.g. `ConfigInterface`) without referencing concrete implementations. |
| **Contract** must not depend on any layer                           | Contract contains purely technical utilities. It must be completely independent of domain, application, and infrastructure code.                           |
| **Infrastructure** may depend on any layer                          | Infrastructure implements domain and application interfaces. This is the Dependency Inversion Principle in action.                                         |

### Adding Classes to a Layer

When extending the application or building a new extension, place your classes
in the appropriate namespace:

**Domain layer** — business logic, entities, and domain-specific interfaces:

```php
namespace Webify\Base\Domain\ValueObject;

use Webify\Base\Domain\Service\SomeDomainInterface;

final readonly class SomeValueObject
{
    public function __construct(
        private string $value,
    ) {}

    public function asString(): string
    {
        return $this->value;
    }
}
```

**Application layer** — application-level contracts:

```php
namespace Webify\Base\Application\Service;

interface SomeAppInterface
{
    public function execute(string $input): string;
}
```

**Infrastructure layer** — framework implementations of domain or application contracts:

```php
namespace Webify\Base\Infrastructure\Service;

use Webify\Base\Application\Service\SomeAppInterface;

final readonly class SomeImplementation implements SomeAppInterface
{
    public function execute(string $input): string
    {
        return strtoupper($input);
    }
}
```

**Contract layer** — technical utilities with zero dependencies on other layers:

```php
namespace Webify\Base\Contract;

interface SomeTechnicalInterface
{
    public function transform(mixed $input): mixed;
}
```

### Architecture Tests

Architecture rules live in `test/Architecture/ArchitectureSpec.php` and are
enforced through [phpat](https://github.com/phpat/phpat), running as part of
the PHPStan analysis pipeline:

```bash
vendor/bin/phpstan analyse
```

phpat rules use a fluent API. Example:

```php
public function testDomainDoesNotDependOnApplicationOrInfrastructure(): Rule
{
    return PHPat::rule()
        ->classes(Selector::inNamespace('Webify\Base\Domain'))
        ->shouldNot()
        ->dependOn()
        ->classes(
            Selector::inNamespace('Webify\Base\Application'),
            Selector::inNamespace('Webify\Base\Infrastructure'),
        )
        ->because('Domain is the innermost layer and must not depend on outer layers');
}
```

When you add a new class, ensure it does not introduce unwanted dependencies
between layers. The architecture tests will flag violations.

---

## Directory Structure

```
src/
├── Application/
│   └── Service/
│       └── ConfigInterface.php              ← Application-wide contracts
│
├── Contract/
│   ├── ArraySearchHelper.php               ← Dot-notation array access trait
│   ├── KeyValueReaderInterface.php          ← Read-only key-value contract
│   ├── Collection/
│   │   └── Collection.php                  ← Generic type-safe collection
│   ├── Exception/
│   │   ├── InvalidCollectionIndexException.php
│   │   ├── InvalidCollectionItemTypeException.php
│   │   └── TranslatableExceptionInterface.php
│   └── Translation/
│       └── ExceptionTranslation.php        ← i18n exception DTO
│
├── Domain/
│   ├── Contract/                           ← Domain-defined interfaces
│   │   ├── Authentication/                 ← Credentials, strategies, ACL
│   │   ├── Authorization/                  ← Resources, subjects, rules
│   │   ├── Identity/                       ← Password hashing
│   │   └── Translation/                    ← i18n-ready exceptions
│   ├── Entity/
│   │   └── AggregateRoot.php               ← Base aggregate with event recording
│   ├── Event/
│   │   ├── DomainEventInterface.php
│   │   └── DomainEventPublisherInterface.php
│   ├── Exception/                          ← Domain-specific exceptions
│   ├── Service/                            ← Domain service contracts
│   │   ├── SlugifyInterface.php
│   │   └── UlidGeneratorInterface.php
│   └── ValueObject/                        ← Immutable self-validating wrappers
│
└── Infrastructure/
    ├── Container/                          ← DI container building
    │   ├── ContainerBuilderInterface.php
    │   └── PhpDiContainerBuilder.php
    ├── Contract/                           ← Infrastructure-level contracts
    │   ├── BootstrapServiceProviderInterface.php
    │   ├── ErrorHandlerInterface.php
    │   ├── ExtensionInterface.php
    │   └── ServiceProviderInterface.php
    ├── Environment/                        ← Runtime environment detection
    │   ├── Environment.php
    │   └── Type.php
    ├── Event/                              ← Domain event publishing (League)
    │   └── LeagueDomainEventPublisher.php
    ├── Exception/                          ← Infrastructure exceptions
    │   ├── ApplicationException.php
    │   └── ApplicationEnvironmentException.php
    ├── Kernel/                             ← Entry points (HTTP, Console)
    │   ├── Http.php
    │   └── Console.php
    ├── Provider/                           ← Service providers
    │   └── BaseServiceProvider.php
    ├── Service/                            ← Implementations (config, slug, ULID)
    │   ├── Application.php
    │   ├── Config.php
    │   ├── SymfonyAsciiSlugify.php
    │   └── SymfonyUlidGenerator.php
    └── definitions.php                     ← PHP-DI wiring
```

---

## Design Patterns

Each layer follows consistent patterns that make the code predictable and
easy to extend.

### Domain Layer

| Pattern                   | Where                                                           | Description                                                                                                                                                                           |
|---------------------------|-----------------------------------------------------------------|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| **Value Object**          | `Domain\ValueObject\*`                                          | Immutable wrappers that validate on construction. `Email`, `Slug`, `AggregateId`, `DateTime`, `SecureToken` all enforce their own invariants and expose behaviour — not just getters. |
| **Aggregate**             | `Domain\Entity\AggregateRoot`                                   | Base entity that records domain events during a transaction and releases them for publishing after the transaction completes.                                                         |
| **Domain Event**          | `Domain\Event\*`                                                | Immutable records of something that happened in the domain (`DomainEventInterface`). Published via `DomainEventPublisherInterface` so side effects are decoupled from business logic. |
| **Factory Method**        | `Domain\Exception\*`                                            | Static named constructors replace guesswork. Exceptions like `AccessDeniedException::deniedFor()` and `DateTimeException::forInvalidDatetime()` encode intent directly in the call.   |
| **Strategy**              | `Domain\Contract\Authentication\*`                              | Authentication strategies (`PasswordBaseInterface`, `ChallengeBasedInterface`) are interchangeable algorithms selected at runtime through `StrategyInterface`.                        |
| **Anti-Corruption Layer** | `Domain\Contract\Authentication\UserCredentialsLookupInterface` | Shields the domain from external user-store implementations by defining a narrow, domain-specific interface.                                                                          |
| **Translation DTO**       | `Domain\Contract\Translation\*`                                 | `ExceptionTranslation` carries a group, key, and parameters so exceptions can produce translated messages without coupling to any i18n library.                                       |

### Application Layer

| Pattern               | Where                   | Description                                                                                                    |
|-----------------------|-------------------------|----------------------------------------------------------------------------------------------------------------|
| **Service Interface** | `Application\Service\*` | Thin contracts like `ConfigInterface` that abstract infrastructure details behind a stable, non-framework API. |

### Infrastructure Layer

| Pattern                  | Where                                            | Description                                                                                                                                                                                                    |
|--------------------------|--------------------------------------------------|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| **Adapter**              | `Infrastructure\Service\*`                       | Wraps library classes behind domain interfaces. `SymfonyAsciiSlugify` → `SlugifyInterface`, `SymfonyUlidGenerator` → `UlidGeneratorInterface`, `LeagueDomainEventPublisher` → `DomainEventPublisherInterface`. |
| **Service Provider**     | `Infrastructure\Provider\*`                      | Two-phase registration: `getDefinitions()` adds container bindings, `bootstrap()` wires routes, middleware, and commands after the container is built.                                                         |
| **Error Handler**       | `Infrastructure\Contract\ErrorHandlerInterface` | Defines a contract for generating error responses. The HTTP kernel catches exceptions, logs them, and delegates to the `ErrorHandlerInterface` implementation to produce an appropriate response.               |
| **Builder**              | `Infrastructure\Container\PhpDiContainerBuilder` | Encapsulates the construction of a fully configured PHP-DI container: autowiring, compilation mode, provider loading, and extension discovery.                                                                 |
| **Invokable Controller** | `Infrastructure\Presentation\Http\Controller\*`  | Controllers are single-action `__invoke(ServerRequestInterface): ResponseInterface` classes. Their only dependency is the PSR-17 factory, injected via constructor.                                             |
| **Dependency Injection** | `Infrastructure\definitions.php`                 | Central PHP-DI definitions file that wires all PSR-7 factories, the router, logger, event dispatcher, domain event publisher, console application, and kernels.                                                |

### Contract Layer

| Pattern                 | Where                              | Description                                                                                                                                                                                |
|-------------------------|------------------------------------|--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| **Collection**          | `Contract\Collection\Collection`   | Generic abstract collection with type-safe `add`, `map`, `filter`, `reduce`, `merge`, `find`, `contains`, and iteration. The type of contained items is enforced in the concrete subclass. |
| **Key-Value Reader**    | `Contract\KeyValueReaderInterface` | Read-only key-value access (`has`, `get`) that keeps callers decoupled from the storage mechanism.                                                                                         |
| **Array Search Helper** | `Contract\ArraySearchHelper`       | Reusable trait for recursive dot-notation array lookups. Used by the `Config` implementation.                                                                                              |
