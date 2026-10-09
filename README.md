# Modular Movie Catalog Platform

A containerized web application for managing, moderating, and browsing a movie catalog. Developed incrementally for the *Web-Based Information Systems* course during my SICUE exchange at the University of Granada, Spain, in the 2024–2025 academic year.

The project evolved from a static interface into a database-driven web application featuring role-based access control (RBAC), asynchronous search, server-side validation, and security-focused development practices.

## Key Features

- Dynamic movie catalog with browsing and moderation capabilities
- Responsive interface built with HTML5 and CSS3
- Client-side interactivity using vanilla JavaScript
- Server-side rendering with PHP and Twig
- Role-based access control (RBAC)
- Session-based authentication and authorization
- Asynchronous movie search using AJAX
- MySQL database with relational integrity constraints
- Docker-based development environment
- Security controls for user input and database access

## Architecture and Implementation

### 1. Responsive Frontend

The interface uses semantic HTML5 and CSS Grid to create a responsive layout without relying on external CSS frameworks.

Vanilla JavaScript handles client-side interactions, including the comments panel and real-time filtering of prohibited words in comment input.

Client-side filtering improves the user experience but is not treated as a security boundary; input validation and output handling must also be enforced on the server.

### 2. PHP Backend and Template Rendering

The application uses PHP for server-side logic and Twig for template rendering.

Twig templates separate presentation from backend logic and support a more maintainable structure through template inheritance.

### 3. Role-Based Access Control (RBAC)

The application implements role-dependent functionality for different user types:

- Anonymous users
- Registered users
- Moderators
- Managers
- Superusers

Authorization checks are performed on the server to restrict access to protected functionality, including movie editing and comment management.

### 4. Asynchronous Search with AJAX

The search feature uses AJAX to send requests to the backend without reloading the entire page.

Search results are returned asynchronously, providing a more responsive browsing experience.

Search visibility depends on the authenticated user's role:

- Regular users can search published movies.
- Managers can search the full catalog, including unpublished movies and drafts.

This restriction is enforced by backend query logic rather than relying on client-side filtering.

## Security Practices

Security was considered throughout the application's development, with particular attention to common web application vulnerabilities.

### Cross-Site Scripting (XSS)

Twig's automatic output escaping is used to help prevent user-controlled content from being interpreted as executable HTML or JavaScript.

### Password Security

User passwords are hashed using **bcrypt** before being stored in the database, rather than being stored as plaintext.

### SQL Injection Prevention

Database operations use parameterized queries to reduce the risk of SQL injection. Server-side validation is applied independently of client-side checks.

### Server-Side Authorization

Protected operations are checked against the user's session and role on the backend. Hiding interface elements alone is not considered sufficient authorization.

### Data Integrity

MySQL constraints and triggers support database integrity and the consistency of application data.

## Tech Stack

| Category | Technologies |
|---|---|
| Backend | PHP |
| Frontend | HTML5, CSS3, Vanilla JavaScript |
| Templates | Twig |
| Asynchronous Communication | AJAX, JSON/XML |
| Database | MySQL |
| Security | RBAC, bcrypt, output escaping, parameterized queries |
| Containers | Docker, Docker Compose |
| Development Environment | Linux, Bash |

## Running the Project

The project includes Docker-based development configuration and a build script.

```bash
bash dev_build_container.sh
```

Alternatively, if the Docker Compose configuration is ready to use:

```bash
docker compose up --build
```

Refer to the repository's configuration files for any required environment variables, ports, and setup instructions.

## Functional Demo

The following video demonstrates the user interface, dynamic navigation, and application behavior in a local Docker environment.

[Watch the functional demo](https://github.com/user-attachments/assets/9d300841-50b1-44b3-b344-81834d78c541)

## Project Context

Developed as part of the *Web-Based Information Systems* course during a SICUE exchange at the University of Granada, Spain, in the 2024–2025 academic year.

The project provided practical experience in full-stack web development, database-backed applications, access control, containerization, and secure coding practices.
