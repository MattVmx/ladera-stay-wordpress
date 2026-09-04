# Ladera Stay - Manual Test Cases

## Inquiry form

**Environment:** WordPress Playground, latest Chrome  
**Starting state:** Open the homepage, scroll to the inquiry form, and make sure no values are prefilled.  
**Current execution status:** In progress - 3 of 10 passed  
**Last execution date:** 2026-09-04

### TC-INQ-001 - Submit a complete valid inquiry

**Priority:** Critical  
**Test data:** Valid name and email, published stay, future arrival date, later departure date, 2 guests, optional message

**Steps**

1. Complete every field with valid data.
2. Select a stay and 2 guests.
3. Submit the form.

**Expected result**

- The form is submitted once.
- The visitor returns to the inquiry section.
- A success message is displayed.
- One private inquiry is created in the WordPress dashboard with the submitted values.

### TC-INQ-002 - Leave the name empty

**Priority:** Critical

**Steps**

1. Complete every required field except the name.
2. Submit the form.

**Expected result**

- The browser prevents submission.
- The name field is identified as required.
- No inquiry is created.

### TC-INQ-003 - Enter an invalid email address

**Priority:** Critical  
**Test data:** `qa.test`

**Steps**

1. Complete the form with otherwise valid data.
2. Enter the invalid email address.
3. Submit the form.

**Expected result**

- The browser prevents submission and identifies the email as invalid.
- No inquiry is created.

### TC-INQ-004 - Do not select a stay

**Priority:** Critical

**Steps**

1. Complete every other required field.
2. Leave the default stay option selected.
3. Submit the form.

**Expected result**

- The browser prevents submission.
- The stay selector is identified as required.
- No inquiry is created.

### TC-INQ-005 - Leave a date empty

**Priority:** Critical

**Steps**

1. Complete the form with valid data.
2. Leave either arrival or departure empty.
3. Submit the form.

**Expected result**

- The browser prevents submission.
- The empty date field is identified as required.
- No inquiry is created.

### TC-INQ-006 - Use the same arrival and departure date

**Priority:** High

**Steps**

1. Complete the form with valid data.
2. Enter the same date for arrival and departure.
3. Submit the form.

**Expected result**

- The inquiry is rejected.
- The visitor returns to the form with an error message.
- No inquiry is created.

### TC-INQ-007 - Set departure before arrival

**Priority:** High

**Steps**

1. Complete the form with valid data.
2. Enter a departure date earlier than the arrival date.
3. Submit the form.

**Expected result**

- The inquiry is rejected.
- The visitor returns to the form with an error message.
- No inquiry is created.

### TC-INQ-008 - Leave the optional message empty

**Priority:** Medium

**Steps**

1. Complete every required field with valid data.
2. Leave the message empty.
3. Submit the form.

**Expected result**

- The inquiry is accepted.
- A success message is displayed.
- The inquiry is saved with an empty message.

### TC-INQ-009 - Review the saved inquiry in WordPress

**Priority:** High  
**Precondition:** TC-INQ-001 passed

**Steps**

1. Open the WordPress dashboard.
2. Open the Inquiries section.
3. Find the record created by TC-INQ-001.

**Expected result**

- Exactly one matching record is present.
- Guest, stay, email, dates, guest count, and message match the submitted data.
- The record is not publicly visible as site content.

### TC-INQ-010 - Submit dates that are already in the past

**Priority:** High

**Steps**

1. Complete the form with otherwise valid data.
2. Enter an arrival date in the past and a later departure date that is also in the past.
3. Submit the form.

**Expected result**

- The inquiry is rejected because past stays cannot be requested.
- A clear error message is displayed.
- No inquiry is created.

## Execution record

| ID | Status | Actual result | Bug ID |
| --- | --- | --- | --- |
| TC-INQ-001 | Pass | Success message displayed; one private inquiry stored with the correct guest, stay, email, dates, guest count, and message. | - |
| TC-INQ-002 | Pass | Chrome blocked submission, moved focus to the required empty name field, and WordPress showed no inquiries (`All (0)`). | - |
| TC-INQ-003 | Pass | Chrome blocked submission, moved focus to the invalid email field (`qa.test`), and WordPress showed no inquiries (`All (0)`). | - |
| TC-INQ-004 | Not run | - | - |
| TC-INQ-005 | Not run | - | - |
| TC-INQ-006 | Not run | - | - |
| TC-INQ-007 | Not run | - | - |
| TC-INQ-008 | Not run | - | - |
| TC-INQ-009 | Not run | - | - |
| TC-INQ-010 | Not run | - | - |

