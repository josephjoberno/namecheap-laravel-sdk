<?php
namespace Namecheap\Laravel;
class DomainRecord
{
    public string $hostname;
    public string $type;
    public string $address;
    public int $ttl;
    public ?int $mxPref;

    public function __construct(array $data)
    {
        $this->hostname = $data['hostname'];
        $this->type = $data['type'];
        $this->address = $data['address'];
        $this->ttl = $data['ttl'] ?? 1800;
        $this->mxPref = $data['mxPref'] ?? null;
    }

    public function toArray(): array
    {
        return [
            'hostname' => $this->hostname,
            'type' => $this->type,
            'address' => $this->address,
            'ttl' => $this->ttl,
            'mxPref' => $this->mxPref,
        ];
    }
}