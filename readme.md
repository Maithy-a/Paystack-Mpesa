# Paystack-Mpesa
This repository features a system for account creation and deposits via Paystack, showcasing M-Pesa integration with a modern Tabular UI for an intuitive user experience.
To set up your Paystack payment integration system, follow these steps:

1. **Clone the Repository**: Start by cloning the repository to your local machine using the command:
    ```bash
   git clone https://github.com/Maithy-a/Paystack-Mpesa.git
   ```

2. **Configure API Keys**: Open the `config.php` file in your project directory. Here, you will need to set your Paystack secret key and public key. These keys can be obtained after creating an account with Paystack. Add the following lines to `config.php`:
   ```php
     <?php
       $SecretKey = "you_secret_key";
       $PublicKey = "your_public_key"; 
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
