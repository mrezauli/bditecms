---
paths:
  - 'tests/**'
---

# Tests

## bootstrap/cache/config.php must not exist in test environments
If a baked `bootstrap/cache/config.php` exists with hardcoded `env=prod`, it overrides phpunit.xml's `env=testing` and causes tests to hit the dev DB instead of sqlite :memory:. Delete it and `config:clear` to prevent this. Never recreate it.
