Based on the code snippets provided, I'll help create a comprehensive README section for the DNS, Domains, and other resources in the Namecheap Laravel SDK. Here's the addition to your README:

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
```

This documentation is based on the following code references:


```13:40:packages/namecheap/src/NamecheapClient.php
class NamecheapClient
{
    protected $apiKey;
    protected $username;
    protected $apiUser;
    protected $clientIp;
    protected $sandbox;

    protected $domains;
    protected $dns;
    protected $ssl;
    protected $users;
    protected $whois;

    public function __construct($apiKey, $username, $apiUser, $clientIp, $sandbox = true)
    {
        $this->apiKey = $apiKey;
        $this->username = $username;
        $this->apiUser = $apiUser;
        $this->clientIp = $clientIp;
        $this->sandbox = $sandbox;

        $this->domains = new Domains($this);
        $this->dns = new Dns($this);
        $this->ssl = new Ssl($this);
        $this->users = new Users($this);
        $this->whois = new Whois($this);
    }
```



```1:4:packages/namecheap/src/Resources/Dns.php
<?php 
namespace Namecheap\Laravel\Resources;

use Namecheap\Laravel\Resources\AbstractResource;
```


The documentation provides examples for each main resource type available in the SDK, making it easy for developers to understand how to use each component. The structure follows the actual implementation shown in the NamecheapClient class where these resources are initialized.