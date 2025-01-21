Larapay - PayU Payment Integration for Laravel
Larapay is a simple and easy-to-use Laravel package for integrating the PayU payment gateway. This package supports Laravel versions 8, 9, and 10, and provides an efficient way to handle PayU payments, store transaction details in the database, and manage the PayU response.

Features
Easy PayU Integration: Integrate PayU payment gateway with minimal configuration.
Transaction Data Storage: Automatically store payment details in your database.
Fully Configurable: Configure PayU credentials in the .env file.
Laravel Support: Compatible with Laravel 8, 9, and 10.
Installation
Step 1: Install the Package
You can install the package via Composer by running the following command:

bash
Copy
Edit
composer require larapay/payu
Step 2: Publish Configuration
After installing the package, publish the configuration file using the following command:

bash
Copy
Edit
php artisan vendor:publish --provider="Larapay\Payu\PayuServiceProvider" --tag="larapay-config"
This will generate the larapay.php configuration file in your config directory.

Step 3: Run Database Migrations
The package includes a migration file that creates a payu_transactions table to store payment details. Run the following command to migrate the database:

bash
Copy
Edit
php artisan migrate
Step 4: Add PayU Credentials to .env
You need to configure your PayU credentials in the .env file. Add the following lines:

env
Copy
Edit
PAYU_KEY=your_payu_key
PAYU_SALT=your_payu_salt
PAYU_BASE_URL=https://test.payu.in  # Use production URL for live environment
Replace your_payu_key and your_payu_salt with the credentials provided by PayU.

Usage
Step 1: Define Routes
You need to define routes to handle the payment process. Add the following route in routes/web.php:

php
Copy
Edit
use Larapay\Payu\Http\Controllers\PayuController;

Route::post('/payu/process-payment', [PayuController::class, 'processPayment']);
Step 2: Send Payment Data
To initiate a payment, send a POST request to /payu/process-payment with the necessary payment data. The payment data should look like the following example:

json
Copy
Edit
{
  "amount": 500.00,
  "product": "Product Name",
  "user_info": {
    "name": "John Doe",
    "email": "john@example.com"
  }
}
Step 3: Handle Response
After PayU processes the payment, the response will be returned and stored in the payu_transactions table in your database. You can access this data from the table to check the payment status or other transaction details.

Database Schema
The payu_transactions table is used to store transaction details. Here is an overview of the schema:

transaction_id: The unique transaction ID.
amount: The total amount processed.
status: The current status of the payment.
response_data: The full response from PayU stored as JSON.
created_at: Timestamp when the transaction was created.
updated_at: Timestamp when the transaction was last updated.
Example Migration:
php
Copy
Edit
  Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id');
            $table->decimal('amount', 10, 2);
            $table->string('status');
            $table->json('response_data');
            $table->string('email'); // Add email column
            $table->string('mobile_number'); // Add mobile number column
            $table->timestamps();
        });
License
This package is open-source and available under the MIT License.

Troubleshooting
PayU API Not Responding: Verify that the PAYU_BASE_URL is correct and ensure the PayU gateway is operational.
Invalid Credentials: Ensure that PAYU_KEY and PAYU_SALT in your .env file are correct.
Migration Issues: If you face any issues with migrations, you can try running php artisan migrate:refresh.
Contributing
We welcome contributions to this package. If you'd like to improve or add features to Larapay, please follow these steps:

Fork the repository.
Make your changes.
Create a pull request with a description of the changes you've made.
Please ensure that you follow Laravel’s coding standards and write tests for any new features.

Support
If you encounter any issues or have any questions, please open an issue on the GitHub repository.
