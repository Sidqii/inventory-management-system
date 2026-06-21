# Inventory Management System

A refactored and simplified Inventory Management System based on a project developed during my previous internship. This project focuses on inventory tracking, stock movement management, approval workflows, and operational reporting.

## Features

### Authentication & Authorization

* Authentication with Laravel Sanctum
* Email Verification
* Role-Based Access Control (RBAC)

### Master Data

* Categories
* Products
* Warehouses
* Suppliers

### Inventory Management

* Stock Management
* Stock Requests
* Stock Movement Tracking
* Stock Approval Workflow
* Request Fulfillment Process

### Reporting

* Excel Export for Stock Movement Reports

### Developer Experience

* Interactive API Documentation with Scramble

## Database Design

ERD Diagram:
[dbdiagram.io](https://dbdiagram.io/d/inventaris_pamsis-6a04006b54a51d93d310b7ad)

## Business Workflow

Workflow Diagram:
[plantUML.com](https://www.planttext.com/?text=dPLTRvim58Rl8-K_7ELcLwsQZoRjr4L516sHybK-klNIWXFYZTZCDjcYQV-zXWAf24YXliAl7vzZlpusZr8HeP9zrEr4k5MWE0WQxXG4LA2lA6VTJhT3VCK56C6UigBZABBTbfqaHd6WaekKJYSI5aO8lJax8DF44PQ4aH3tkWVEKIhSz-1V2eDkd-1BKok0fU6ubWqpmpKkd9D8z8dKQtZB39v48Nj097XclnunYSAG2ue5DsW8nQWga64zyfq8t76j5joedji87YH-6UssXINprRErSjVsIrj3dYd-qUV7_Lzvrd45C0Lg9zuGiF5tWbBbwAI2Ud74IG26KiJVfQURStSLpeXZmG_rCUyhh8q_TGNLelsR5WOvBxfcbh2nrwRbE9RJrgUlo52SZ5ZgzR_RORzQH5uSdE2dX315rR60gvMKMsma0LMmu671LSifEwkIAkjtrC86mzH50hQrCDpvUkLycsykTIAxy71rDJrTcVVIu5mQdakZS-cs9dove-nXoTNnkJGfkVBDoKVk6_IqPce7ngqkcxdmPjQ7RDHBW-lhR2bz-0mF3vJvKHBWT5gCQpq71lL06M3O4E2c4RXuYzOFrrhDFhZ3kpp_94kFVnMo8Ct-lzjvr9_w1_CA)

## API Documentation

This project uses Scramble to automatically generate interactive API documentation.

After running the application locally:

```bash
php artisan serve
```

Open:

```txt
http://127.0.0.1:8000/docs/api
```

The documentation includes available endpoints, authentication requirements, request parameters, and response examples.
