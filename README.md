# Project Management API - README

This README file provides detailed instructions to set up and run the Laravel Project Management API. The application supports creating, updating, and managing projects and tasks via RESTful endpoints.

---

## **Prerequisites**

Ensure you have the following installed:

- PHP >= 8.1
- Composer
- MySQL
- Laravel Installer (optional but recommended)
- Postman (or any API testing tool)

---

## **Setup Instructions**

1. **Clone the Repository**
   ```bash
   git clone <repository_url>
   cd project-management
   ```

2. **Install Dependencies**
   ```bash
   composer install
   ```

3. **Environment Configuration**
   - Copy the `.env.example` file to `.env`:
     ```bash
     cp .env.example .env
     ```
   - Update the `.env` file with your database credentials:
     ```env
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=project_management
     DB_USERNAME=root
     DB_PASSWORD=your_password
     ```

4. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

5. **Run Database Migrations and Seeders**
   - Run migrations:
     ```bash
     php artisan migrate
     ```
   - Seed the database with sample data:
     ```bash
     php artisan db:seed
     ```

6. **Run the Development Server**
   ```bash
   php artisan serve
   ```
   The server will be available at: `http://127.0.0.1:8000`

---

## **API Endpoints**

### **Authentication**
- **Register:** `POST /api/register`
  - Payload:
    ```json
    {
      "name": "John Doe",
      "email": "john.doe@example.com",
      "password": "password",
      "password_confirmation": "password"
    }
    ```
  - Response:
    ```json
    {
      "message": "User registered successfully",
      "token": "<auth_token>"
    }
    ```

- **Login:** `POST /api/login`
  - Payload:
    ```json
    {
      "email": "john.doe@example.com",
      "password": "password"
    }
    ```
  - Response:
    ```json
    {
      "token": "<auth_token>"
    }
    ```

### **Projects**
- **List Projects:** `GET /api/projects`
- **Create Project:** `POST /api/projects`
  - Payload:
    ```json
    {
      "title": "New Project",
      "description": "Project description",
      "status": "open"
    }
    ```
- **Update Project:** `PUT /api/projects/{id}`
- **Delete Project:** `DELETE /api/projects/{id}`

### **Tasks**
- **List Tasks for a Project:** `GET /api/projects/{project_id}/tasks`
- **Create Task for a Project:** `POST /api/projects/{project_id}/tasks`
  - Payload:
    ```json
    {
      "title": "New Task",
      "description": "Task description",
      "assigned_to": "John Doe",
      "due_date": "2025-01-15",
      "status": "to_do"
    }
    ```
- **Update Task:** `PUT /api/projects/{project_id}/tasks/{id}`
- **Delete Task:** `DELETE /api/tasks/{id}`

---

## **Testing**

To run tests, execute the following commands:

1. Run a specific test class:
   ```bash
   php artisan test --filter=AuthProjectTaskTest
   ```

2. Run all tests:
   ```bash
   php artisan test
   ```

### **Testing Workflow**
1. Register a user using `/api/register`.
2. Log in to get the token using `/api/login`.
3. Use the token in the Authorization header for subsequent requests:
   ```
   Authorization: Bearer <auth_token>
   ```
4. Test project and task endpoints.

---

## **Folder Structure**
- **Routes:** `routes/api.php`
- **Controllers:** `App/Http/Controllers`
- **Models:** `App/Models`
- **Migrations:** `database/migrations`
- **Seeders:** `database/seeders`
