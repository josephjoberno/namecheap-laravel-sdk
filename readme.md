```markdown
# Namecheap Laravel SDK

A Laravel SDK for interacting with the Namecheap API.

## Installation

You can install the package via composer:

```bash
composer require josephjoberno/namecheap-laravel-sdk
```

## Requirements

- PHP ^7.4|^8.0
- Laravel ^8.0|^9.0|^10.0

## Configuration

1. After installing the package, register the service provider in your `config/app.php` (Laravel will auto-discover the provider in most cases):

```php
'providers' => [
    // ...
    Namecheap\Laravel\NamecheapServiceProvider::class,
];
```

2. Add the facade to your aliases:

```php
'aliases' => [
    // ...
    'Namecheap' => Namecheap\Laravel\Facades\Namecheap::class,
];
```

3. .env
``` bash \
NAMECHEAP_API_KEY=
NAMECHEAP_USERNAME=
NAMECHEAP_API_USER=
NAMECHEAP_CLIENT_IP=
NAMECHEAP_SANDBOX=
```
## Usage

You can use the Namecheap facade to interact with the Namecheap API:

```php
use Namecheap\Laravel\Facades\Namecheap;

// Example usage
$response = Namecheap::domains()->getList();
```

```markdown
## Available Resources

### Domains

The Domains resource allows you to manage domain names through the Namecheap API.

```php
use Namecheap\Laravel\Facades\Namecheap;

// Get list of domains
$domains = Namecheap::domains()->getList();

// Check domain availability
$available = Namecheap::domains()->check('example.com');

// Register a domain
$result = Namecheap::domains()->create([
    'DomainName' => 'example.com',
    'Years' => 1
]);
```

### DNS

The DNS resource provides methods to manage DNS records for your domains.

```php
use Namecheap\Laravel\Facades\Namecheap;

// Get DNS records for a domain
$records = Namecheap::dns()->getList('example.com');

// Set DNS hosts for a domain
$result = Namecheap::dns()->setHosts('example.com', [
    [
        'HostName' => '@',
        'RecordType' => 'A',
        'Address' => '192.0.2.1',
        'TTL' => '1800'
    ]
]);
```

### SSL Certificates

Manage SSL certificates through the Namecheap API.

```php
use Namecheap\Laravel\Facades\Namecheap;

// Get list of SSL certificates
$certificates = Namecheap::ssl()->getList();

// Purchase a new SSL certificate
$result = Namecheap::ssl()->create([
    'Type' => 'PositiveSSL',
    'Years' => 1
]);
```

### Users

Manage user account information and settings.

```php
use Namecheap\Laravel\Facades\Namecheap;

// Get user address information
$address = Namecheap::users()->getAddress();

// Get pricing information
$pricing = Namecheap::users()->getPricing();
```

### Whois

Query and manage WHOIS information for domains.

```php
use Namecheap\Laravel\Facades\Namecheap;

// Get WHOIS information for a domain
$whois = Namecheap::whois()->getInfo('example.com');

// Update WHOIS information
$result = Namecheap::whois()->update('example.com', [
    'FirstName' => 'John',
    'LastName' => 'Doe',
    'EmailAddress' => 'john@example.com'
]);
```

Each resource is accessible through the Namecheap facade and provides a clean, fluent interface to interact with the Namecheap API. For more detailed information about available methods and parameters, please refer to the [Namecheap API documentation](https://www.namecheap.com/support/api/intro/).

## Features

- Easy integration with Laravel projects
- Clean and simple API interface
- Support for all Namecheap API endpoints

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## Security

If you discover any security-related issues, please email josephjoberno@email.com instead of using the issue tracker.

## Credits

- [josephjoberno](https://github.com/josephjoberno)
- [sylainx](https://github.com/sylainx)
## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

