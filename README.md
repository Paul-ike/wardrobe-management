# Wardrobe Management Backend

## Project Name

Wardrobe Management Backend

## Author Information

This backend project was created by:

- Paul Wanyoike Ngugi
- Date: 26th February, 2025

## Setup/Installation Requirements

1. **Clone the Repository:**

```
git clone https://github.com/Paul-ike/wardrobe-management-backend.git
```

2. **Install Dependencies:**

Ensure you have PHP and Composer installed. Then, run:

```
composer install
```

3. **Create a Database:**
Use MySQL Workbench or another tool to create a database named `wardrobe_management`.

4. **Update `.env` File:**
Configure your database settings in the `.env` file.

5. **Run Migrations:**

```
php artisan migrate
```

6. **Start the Server:**

```
php artisan serve
```

## Project Structure

The project is built using Laravel. Key directories include:

*   `app/`: Contains all the Eloquent models and controllers.
*   `config/`: Contains application configuration files.
*   `database/`: Contains database migrations and seeders.
*   `public/`: Contains static assets like images, etc.
*   `routes/`: Contains API routes defined in `api.php`.

## Technologies Used

*   **Laravel:** A PHP framework for building robust web applications.
*   **MySQL:** A relational database management system.
*   **Docker:** Used for containerization.

## API Endpoints

The following endpoints are available for interacting with the backend:

### GET /api/wardrobe

- **Purpose**: List all wardrobe items.
- **Response Format**: JSON

### POST /api/wardrobe

- **Purpose**: Create a new wardrobe item.
- **Request Body**: JSON object with item details.
- **Response Format**: JSON

### GET /api/wardrobe/{id}

- **Purpose**: Show a specific wardrobe item.
- **Response Format**: JSON

### PUT /api/wardrobe/{id}

- **Purpose**: Update a wardrobe item.
- **Request Body**: JSON object with updated item details.
- **Response Format**: JSON

### DELETE /api/wardrobe/{id}

- **Purpose**: Delete a wardrobe item.
- **Response Format**: JSON

## Models

- **WardrobeItem**: Represents a single item in the wardrobe.
- **User**: Represents a user who can manage their wardrobe.

## Relationships

- A **User** has many **WardrobeItems**.
- A **WardrobeItem** belongs to a **User**.

![Screenshot](./public/Screenshot%20(983).png)
[![ERD Link](link)](https://dbdiagram.io/d)

## Validations

- **WardrobeItem**: Must have a name and description.
- **User**: Must have a username and email.

## Known Issues and TODOs

*   **Deployment**: Currently not deployed to a production environment.
*   **Testing**: Additional tests are needed for comprehensive coverage.
*   **Security**: Review and implement additional security measures.

## Support and Contact Information

For questions or support, please contact:

- Email: [paulnyoiken@gmail.com](mailto:paulnyoiken@gmail.com)

## License and Copyright Information

Copyright 2025 Paul Wanyoike Ngugi.

This project is open source and available under the [MIT License](LICENSE).
