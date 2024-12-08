# **Laravel RESTful API for User, Role, and Permission Management**

This project is a RESTful API built with Laravel  and Passport for managing users, roles, and permissions.

---

## **Features**

### **User Management**
- Users can have multiple roles.
- Users can have multiple permissions, either directly assigned or inherited through roles.

### **Role Management**
- Roles can have multiple permissions.

### **Permission Management**
- CRUD operations for permissions.
- Assign permissions to roles and users.

### **Authentication**
- Secure token-based authentication using Laravel Passport.
- Routes are protected by middleware.

### **Authorization**
- Middleware verifies a user's permissions before granting access to specific API routes.

### **Clean Architecture**
- Repository Pattern ensures maintainable and testable code.
- Follows PSR coding standards for clean and consistent coding.

---

## **API Endpoints**

### **Authentication**
- **POST** `/api/register` - User registration.
- **POST** `/api/login` - User login and token generation.

### **User Management**
- **POST** `/api/users/{userId}/roles` - Assign roles to a user.
- **GET** `/api/users/{userId}/permissions` - Retrieve all permissions of a user.
- **POST** `/api/users/{userId}/permission` - Assign a permission directly to a user.

### **Role Management**
- **GET, POST, PUT, DELETE** `/api/roles` - Role CRUD operations.
- **POST** `/api/roles/{roleId}/permissions` - Assign permissions to a role.

### **Permission Management**
- **GET, POST, PUT, DELETE** `/api/permissions` - Permission CRUD operations.

---

## **Setup Instructions**

### **Step 1: Clone the Repository**
```bash
git clone https://github.com/sharif7761/laravel-user-roles-permissions.git
cd laravel-user-roles-permissions
```

### **Step 2: Install Dependencies**
Run the following command to install all required PHP dependencies for the project:

```bash
composer install
```
### **Step 3: Set Up Environment Variables**

1. Copy the `.env.example` file to `.env`:
   ```bash
   cp .env.example .env
   ```
2. Open the `.env` file and configure your database connection:
```bash
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_database_user
   DB_PASSWORD=your_database_password
```

### **Step 4: Generate Application Key**

Run the following command to generate the application key required for encryption:
```bash
php artisan key:generate
```
### **Step 5: Run Database Migrations**

Execute the following command to run the migrations and create the necessary database tables:

```bash
php artisan migrate
```


### **Step 6: Install Passport Keys**

Run the following command to generate Passport keys for token-based authentication:

```bash
php artisan passport:install
```
### **Step 7: Start the Development Server**

To start the development server, run the following command:

```bash
php artisan serve
```

### **Step 8: Import postman collection**
postman collection is attached in the mail and root of the project as `laravel-user-roles-permissions-app.postman_collection.json`. Import it in your postman and test the code
