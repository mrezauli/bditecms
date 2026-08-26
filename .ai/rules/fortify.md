---
paths:
  - app/Actions/Fortify/CreateNewUser.php
---

# Fortify

## Registration enforces opposite-session type via ExamineeResolver
CreateNewUser uses ExamineeResolver to resolve the examinee ID, then enforces: (1) type_id must belong to the same exam, (2) if resolver returns `remainingTypeId`, the submitted type_id must match it, (3) if resolver returns a name, the submitted name must match it. The resolver merges `enrollments.am_exam/pm_exam` + `half_passers.examinee_no` sources.

## type_id is required for FE, nullable for IP
IP exams have no types in the database. The blade hides the Type field for IP and sends an empty hidden input. CreateNewUser sets `type_id` rule to `nullable` when not FE, `required` scoped to FE exam when FE. `Enrollment::create()` uses `$input['type_id'] ?? null`.
