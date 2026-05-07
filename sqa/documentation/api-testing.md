# API Testing Documentation

| ID | Endpoint | Method | Scenario | Expected Status | Result |
|----|----------|--------|----------|----------------|--------|
| API001 | /api/employees | GET | Get employee list | 200 OK | Pass |
| API002 | /api/employees | POST | Create employee valid data | 201 Created | Pass |
| API003 | /api/employees | POST | Invalid email format | 422 Validation Error | Pass |
| API004 | /api/employees | POST | Empty required field | 422 Validation Error | Pass |