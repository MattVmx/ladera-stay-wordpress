# Ladera Stay - Bug Reports

## BUG-INQ-001 - Past stay dates are accepted

**Status:** Resolved  
**Severity:** High  
**Priority:** High  
**Environment:** WordPress Playground, latest Chrome  
**Linked test:** TC-INQ-010  
**Found:** 2026-09-04
**Resolved:** 2026-09-04

### Steps to reproduce

1. Open the inquiry form.
2. Complete every field with otherwise valid data.
3. Enter an arrival date in the past and a later departure date that is also in the past.
4. Submit the form.

### Expected result

- The inquiry is rejected.
- A clear error message explains that past dates are not allowed.
- No inquiry is created.

### Actual result

- The success message is displayed.
- A private inquiry is created with the past dates.
- During the test, WordPress increased from one to two inquiries and stored `2026-08-10 → 2026-08-13` for `QA Past Date — Bosque Loft`.

### Technical note

The date inputs do not define a minimum date, and the server validates only that departure is later than arrival. It does not compare arrival with the current date.

### Resolution

- The arrival and departure inputs now use the current WordPress date as their minimum value.
- Server-side validation rejects an arrival date earlier than the current WordPress date.
- A specific bilingual error message was added for past dates.
- TC-INQ-010 passed on retest: the browser blocked the submission and WordPress created no inquiry (`All (0)`).

