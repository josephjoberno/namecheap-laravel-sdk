<?php 
namespace Namecheap\Laravel\Resources;

use Namecheap\Laravel\Resources\AbstractResource;

class Whois extends AbstractResource
{
    public function getList(int $page = 1, int $pageSize = 100): array
    {
        return $this->get('namecheap.whoisguard.getList', [
            'Page' => $page,
            'PageSize' => $pageSize
        ]);
    }

    public function enable(int $id, string $domain): array
    {
        return $this->get('namecheap.whoisguard.enable', [
            'WhoisguardID' => $id,
            'ForwardedToEmail' => $domain
        ]);
    }

    public function disable(int $id): array
    {
        return $this->get('namecheap.whoisguard.disable', [
            'WhoisguardID' => $id
        ]);
    }
}