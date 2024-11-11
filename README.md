# Product Management System

This project is a comprehensive Laravel-based dashboard that enables administrators to efficiently manage products. It includes both a web-based admin dashboard and an API, allowing for flexible product management capabilities across different platforms.

The system supports secure admin login functionality, enabling administrators to log in and access product management tools through the dashboard or via API. With this project, administrators can create, read, update, and delete product entries, ensuring that inventory and product details are always up-to-date.

## Key Features

- **Admin Dashboard**: A user-friendly dashboard that allows administrators to log in and manage product data, including adding, updating, and deleting products.
- **API Access**: An API interface to allow admins to manage products remotely, ensuring product data can be integrated or managed from external applications.
- **Secure Authentication**: Only authenticated administrators can access the dashboard and API endpoints.
- **CRUD Operations**: Full Create, Read, Update, and Delete functionalities for effective product management.

This setup offers a unified solution for managing products, supporting both direct dashboard interactions and remote API access for greater flexibility.

## Features

- Product management with CRUD operations
- User authentication and access control
- User-friendly, responsive interface

---

## Installation

### Requirements

- PHP >= 8.0
- Composer
- MySQL
- Laravel 10.x

### Steps to Install the Project

1. **Clone the Repository**
2. **Set Up Environment **
3. **Generate Application Key**
4. **Run Migrations**
	- Run the migration command to create all necessary tables and a default user with the (email: admin@app.test and password: password).
5. **Seed the Database** (optional)
	- Run the seeder to create 100 fake products for testing.
