PHPStan Rules
=============

This package contains the custom rules to be used in solido-based projects.

## Configuration

When using enhanced DTOs, PHPStan should be configured with DTO namespaces:

```neon
# phpstan.neon

parameters:
    solido:
        dto_namespaces:
            - My\Application\DTO
            - App\Models
        excluded_interfaces:
            - My\Application\DTO\NonDTOInterface
```
