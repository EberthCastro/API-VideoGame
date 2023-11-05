# Api-Videogame

**Api-Videogame** is a Laravel-based API project that allows users to interact with a collection of video game skins. It provides various API routes for users to access and manage video game skins, including viewing available skins, purchasing skins, managing owned skins, changing skin colors, and deleting owned skins.

## Getting Started

To set up and run this project locally, follow these instructions:

### Prerequisites

- PHP 8.0 or higher
- Composer
- Laravel (check the latest version)
- MySQL or other compatible database (if you choose to use a database)

### Installation

1. Clone the repository to your local machine:

   ```shell
   git clone https://github.com/EberthCastro/API-VideoGame.git

2. Navigate to the project directory:

   cd Api-Videogame

3. Install project dependencies using Composer:

   composer install

4. Configure your database connection in the .env file:

   DB_CONNECTION=mysql  
   DB_HOST=127.0.0.1  
   DB_PORT=3306  
   DB_DATABASE=your_database  
   DB_USERNAME=your_username  
   DB_PASSWORD=your_password

5. Run database migrations to create the necessary tables:

   php artisan migrate

6. Start the development server:
  
   php artisan serve

   The API will be available at http://127.0.0.1:8000/api.

## API Routes

The following API routes are available for interacting with video game skins:

GET /skins/available: Retrieve a list of available skins for purchase.

POST /skins/buy: Purchase a skin and store it in the database. You need to provide a skin_id in the request payload to specify the skin to purchase.

GET /skins/myskins: View a list of skins you own.

PUT /skins/color/{id}: Change the color of a skin you own. Replace {id} with the ID of the skin you want to modify.

DELETE /skins/delete/{id}: Delete a skin you own. Replace {id} with the ID of the skin you want to delete.

GET /skin/getskin/{id}: Retrieve details of a specific skin. Replace {id} with the ID of the skin you want to view.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

