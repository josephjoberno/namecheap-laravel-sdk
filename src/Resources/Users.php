<?php 
namespace Namecheap\Laravel\Resources;

use Namecheap\Laravel\Resources\AbstractResource;

// Users Resource Class
class Users extends AbstractResource
{
    public function getBalances(): array
    {
        return $this->get('namecheap.users.getBalances');
    }

    public function getPricing(string $type = 'DOMAIN'): array
    {
        return $this->get('namecheap.users.getPricing', [
            'ProductType' => $type
        ]);
    }

    public function getAddressInfo(): array
    {
        return $this->get('namecheap.users.address.getInfo');
    }
}