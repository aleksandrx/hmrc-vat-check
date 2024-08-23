# HMRC UK VAT Check Laravel Package

A Laravel package to check UK VAT numbers using the HMRC VAT API. This package provides an easy way to integrate VAT number validation in your Laravel application.

## Installation

You can install the package via composer. Run the following command:

```bash
composer require patrixshah-uk-vat-checker/hmrc-vat-check
```

## Configuration

After installing the package, you need to publish the configuration file to customize your API credentials and endpoint URLs.

-   Step 1: Publish Configuration File
    Run the following Artisan command to publish the configuration file:

    ```bash
    php artisan vendor:publish --provider="PatrixshahUKVatChecker\HmrcVatCheck\HmrcVatCheckServiceProvider" --tag=config
    ```

    This command will create a hmrc_vat.php configuration file in your config directory.

-   Step 2: Set Environment Variables
    Next, you need to set the required environment variables in your .env file. Add the following lines to your .env file:

    ```dotenv
    HMRC_CLIENT_ID=your-client-id
    HMRC_CLIENT_SECRET=your-client-secret
    HMRC_OAUTH2_URL=https://test-api.service.hmrc.gov.uk/oauth/token
    HMRC_GRANT_TYPE=client_credentials
    HMRC_SCOPE=read:vat
    HMRC_CHECK_VAT_NUMBER=https://test-api.service.hmrc.gov.uk/organisations/vat/check-vat-number/lookup
    ```

    Replace the placeholders with your actual HMRC API credentials and URLs.

-   Step 3: Clear Configuration Cache
    To ensure Laravel recognizes your new configuration, clear the configuration cache:

    ```bash
    php artisan config:clear
    ```

## Usage

Once you have installed and configured the package, you can use it to check VAT numbers through an API endpoint.

Example API Usage
The package provides an API endpoint that you can use to check a VAT number.

-   Step 1: Define the Route (Optional)
    If you want to define a custom route in your Laravel application, add the following to your routes/api.php file:

    ```php
    use Illuminate\Support\Facades\Route;
    use YourVendorName\HmrcVatCheck\Controllers\VatCheckController;
    Route::post('/api/vat/check', [VatCheckController::class, 'checkVatNumber']);
    ```

    If the route is already defined in the package, you can skip this step.

*   Step 2: Make an API Request
    You can now make a POST request to the /api/vat/check endpoint with the VAT number:

    ```bash
    curl -X POST http://your-app-url/api/vat/check \
     -H "Content-Type: application/json" \
     -d '{"vat_number": "GB123456789"}'
    ```

*   Step 3: Handle the Response
    If the VAT number is valid, you will receive a JSON response like this:

    ```json
    {
        "success": true,
        "data": {
            "target": {
                "name": "MS&AD Insurance",
                "vatNumber": "293129633",
                "address": {
                    "line1": "82 Clemie Close",
                    "postcode": "RM37 4KI",
                    "countryCode": "GB"
                }
            },
            "processingDate": "2024-08-23T13:14:06+01:00"
        }
    }
    ```

    If there is an error or the VAT number is invalid, you will receive a response like this:

    ```json
    {
        "success": false,
        "message": "Error checking VAT number: [Error Details]"
    }
    ```

## Customization

Configuring HMRC API Credentials
You can change the API credentials and other settings by modifying the config/hmrc_vat.php file

```php
return [
    'client_id' => env('HMRC_CLIENT_ID', 'your-client-id'),
    'client_secret' => env('HMRC_CLIENT_SECRET', 'your-client-secret'),
    'oauth2_url' => env('HMRC_OAUTH2_URL', 'https://test-api.service.hmrc.gov.uk/oauth/token'),
    'grant_type' => env('HMRC_GRANT_TYPE', 'client_credentials'),
    'scope' => env('HMRC_SCOPE', 'read:vat'),
    'check_vat_number_url' => env('HMRC_CHECK_VAT_NUMBER', 'https://test-api.service.hmrc.gov.uk/organisations/vat/check-vat-number/lookup'),
];
```

Make sure to update these values according to your needs and the environment you are working in.

## Author

-   **Name:** Pratik Shah
-   **LinkedIn:** [Pratik Shah](https://www.linkedin.com/in/patrixshah/)

## License

This package is open-source software licensed under the MIT License.
