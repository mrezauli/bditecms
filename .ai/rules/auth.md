---
paths:
  - tests/Feature/Auth/ExamineeValidateTest.php
---

# Auth

## Examinee validate endpoint returns flat JSON
The POST /examinee/validate endpoint returns flat JSON: `{status, type_id, type_name, name, message}` — NOT nested under `data`. Use `assertJsonPath('status', ...)` not `assertJsonPath('data.status', ...)`.
