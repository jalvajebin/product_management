# product_management

## Admin Seeder

To set up the initial admin user in your database, follow these steps:

### 1. **Run the Admin Seeder**

To seed the database with an admin user, run the admin seeder.

## Application URL

The application's URL for the login page can be accessed via the following route:

- **Login Page URL:** `/admin/login`

#### Admin Credentials:
- **url*: `https://example.com/admin/login`
- **Email**: `admin@gmail.com`
- **Password**: `password`

#### Steps to Run the Seeder:
1. Ensure that your database is set up and your `.env` file is correctly configured.
2. Run the following Artisan command to execute the seeder and insert the admin user into your database:

   ```bash
   php artisan db:seed 
3. Create a Storage Link
To ensure that the public directory can access the files stored in the storage folder, create a symbolic link using the following Artisan command:

php artisan storage:link
This will create a symbolic link from public/storage to storage/app/public, allowing public access to your stored files (like product images, documents, etc.).


### Explanation:
- The `php artisan storage:link` command creates a symbolic link between `public/storage` and `storage/app/public`. This allows files stored in `storage/app/public` to be publicly accessible via URLs, such as images or other assets.

