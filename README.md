# Paystack-Mpesa
This repository features a system for account creation and deposits via Paystack, showcasing M-Pesa integration with a modern Tabular UI for an intuitive user experience.
To set up your Paystack payment integration system, follow these steps:

1. **Clone the Repository**: Start by cloning the repository to your local machine using the command:
    ```bash
   git clone https://github.com/Maithy-a/Paystack-Mpesa.git
   ```

2. **Set Up API Keys**: create a `.env` file in your project directory and define your database details,Paystack secret and public keys. These keys are necessary for integration and can be obtained from your Paystack account. Reference these variables later in your `config.php` file. Add the following lines to your `.env` file:
   ```env
    DB_HOST=your_host_name /ip (e.g.localhost)
    DB_USER=user
    DB_PASSWORD='your_password'
    DB_NAME=database_nem
    DB_PORT=3306
    
    #PAYSTACK KEYS
    PAYSTACK_SECRET_KEY='your_paystack_secret_key'
    PAYSTACK_PUBLIC_KEY='your_paystack_public_key'
   ```
- Ensure the fetch package is installed to read environment variables from the `.env` file. Use the following command to install it:
  ```bash
  composer require vlucas/phpdotenv
  ```

3. **Run the Code**: After configuring your API keys, run the code on your local server. If you're using PHP, you can start a local server with:
   ```bash
   php -S localhost:8000
   ```

4. **Set Up Ngrok (Optional)**: If you want to test webhooks or callbacks, you can use Ngrok to expose your local server to the internet. Run Ngrok with the following command:
   ```bash
   ngrok http 8000
   ```
   This will provide you with a public URL that you can use as your callback URL in Paystack.

5. **Testing**: Use the provided public URL from Ngrok as your callback URL in Paystack's dashboard for testing purposes. Ensure that all functionalities work as expected, including user account creation and payment processing.

By following these steps, you'll have a functioning Paystack payment integration system ready for further development and testing.

Snippets:
![screencapture-localhost-3000-registration-php-2025-01-13-00_16_19](https://github.com/user-attachments/assets/6556aa7c-c77d-40a7-bd24-001be816b764)
![screencapture-localhost-3000-index-2025-01-13-00_15_07](https://github.com/user-attachments/assets/c13eccee-1cab-47d7-af49-6fe42127ab3d)
![screencapture-localhost-3000-home-php-2025-01-13-00_27_50](https://github.com/user-attachments/assets/2714c2da-2c0b-4e04-aba5-81d7ae4c8366)
![screencapture-localhost-3000-home-php-2025-01-12-12_11_33](https://github.com/user-attachments/assets/71408d8a-33c0-4ef8-8f9e-1265ea1dc000)
![Screenshot 2025-01-11 064020](https://github.com/user-attachments/assets/a4c51434-e459-4ae8-a8ef-ed042411708a)
![Screenshot 2025-01-11 063959](https://github.com/user-attachments/assets/ac9a30cb-adcd-44c8-9124-d69fcc45f967)






