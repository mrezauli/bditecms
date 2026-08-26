---
paths:
  - app/Services/ExamineeResolver.php
---

# Services

## ExamineeResolver searches only half_passers model
The resolver only queries `half_passers` by `examinee_no`. It does NOT search `enrollments.am_exam/pm_exam`. The ExamineeController validates only `examinee_id` (no `exam_id`).
