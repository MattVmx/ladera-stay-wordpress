# Ladera Stay - Manual QA Test Plan

## 1. Objective

Validate that the main visitor journeys work correctly and remain clear, usable, and consistent across desktop and mobile layouts.

## 2. Product under test

Ladera Stay is a fictional hospitality website built as a custom WordPress theme. The public demo runs in WordPress Playground and includes editable stays, an inquiry form, Spanish and English content, light and dark themes, and responsive navigation.

## 3. In scope

- Homepage content and navigation
- Stay cards, archive, and individual stay pages
- Inquiry form validation and successful submission
- Inquiry records saved in the WordPress dashboard
- Spanish and English content switching
- Light and dark theme switching and preference persistence
- Desktop and mobile layouts
- Mobile navigation
- Basic keyboard navigation, focus visibility, labels, and contrast review
- Common empty, invalid, and boundary inputs

## 4. Out of scope

- Real payments or confirmed reservations
- Email delivery
- Load and stress testing
- Penetration or advanced security testing
- Availability of third-party demo photographs
- Compatibility with unsupported or legacy browsers

## 5. Test environments

| Environment | Configuration |
| --- | --- |
| Desktop | Latest Chrome, 1440 x 900 viewport |
| Mobile | Latest Chrome, 390 x 844 viewport |
| CMS | Latest WordPress in WordPress Playground, PHP 8.3 |

## 6. Test data

- Guest name: `QA Test User`
- Valid email: `qa.test@example.com`
- Invalid email: `qa.test`
- Future arrival and departure dates
- Guest quantities: 2, 4, and 6
- Every available stay option
- Empty fields, long text, and dates in the wrong order

## 7. Entry criteria

- The public demo loads successfully
- The Ladera Stay theme is active
- Sample stays are visible
- The WordPress dashboard is accessible in the test session

## 8. Exit criteria

- All critical visitor journeys have been executed
- No open blocker or critical issue affects navigation or inquiries
- Every finding includes evidence and reproducible steps
- Fixed issues have been retested
- A short test summary has been completed

## 9. Severity guide

| Severity | Meaning |
| --- | --- |
| Blocker | Testing cannot continue or the site cannot be used |
| Critical | A main journey fails and no practical workaround exists |
| Major | Important behavior is incorrect, but a workaround exists |
| Minor | Small visual, content, or usability issue |

## 10. Deliverables

- Test cases with expected and actual results
- Bug reports for reproducible findings
- Evidence such as screenshots when useful
- Final test summary with coverage, results, and remaining risks

