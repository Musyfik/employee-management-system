# Employee Management System

Modern Employee Management System built with Laravel, Blade, Tailwind CSS, and MySQL.

This project was created as a personal portfolio project for learning Fullstack Development and Software Quality Assurance (SQA).

---

# Features

## Authentication
- Login
- Register
- Logout

## Dashboard
- Employee statistics
- Division statistics
- Recent employee activity

## Employee Management
- Create employee
- Read employee
- Update employee
- Delete employee
- Upload employee photo

## Search & Filter
- Search employee by name
- Filter by division

## API
- GET /api/employees
- POST /api/employees

## QA & Testing
- Manual testing
- Test case documentation
- Bug report documentation
- API testing using Postman
- Validation testing
- Negative testing

---

# Technologies Used

- Laravel
- Blade
- Tailwind CSS
- MySQL
- JavaScript
- Postman

---

# Testing Documentation

Documentation available inside:

```bash
/sqa/documentation
```
Includes:
 - test-case.md
 - bug-report.md
 - api-testing.md

Screenshots available inside:

```bash
/sqa/screenshots
```

API Testing Postman collection available inside:

```bash
/sqa/postman
```

## Installation

```bash
git clone <repository-url>

cd employee-management-system

composer install

cp .env.example .env

php artisan key:generate

php artisan migrate --seed

php artisan storage:link

php artisan serve
```

## Demo Credentials

```bash
EMAIL    : admin@company.com
PASSWORD : password
```

