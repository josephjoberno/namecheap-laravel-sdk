<?php 
namespace Namecheap\Laravel\Resources;

use Namecheap\Laravel\Resources\AbstractResource;



class Dns extends AbstractResource
{
    public function getRecords(string $domain): array
    {
        [$sld, $tld] = $this->parseDomain($domain);
        return $this->get('namecheap.domains.dns.getHosts', [
            'SLD' => $sld,
            'TLD' => $tld
        ]);
    }

    public function setRecords(string $domain, array $records): array
    {
        [$sld, $tld] = $this->parseDomain($domain);
        $params = ['SLD' => $sld, 'TLD' => $tld];

        foreach ($records as $index => $record) {
            $params = array_merge($params, [
                "HostName{$index}" => $record['hostname'],
                "RecordType{$index}" => $record['type'],
                "Address{$index}" => $record['address'],
                "TTL{$index}" => $record['ttl'] ?? 1800,
                "MXPref{$index}" => $record['mxPref'] ?? null,
            ]);
        }

        return $this->get('namecheap.domains.dns.setHosts', $params);
    }

    protected function parseDomain(string $domain): array
    {
        $parts = explode('.', $domain);
        return [
            array_shift($parts),
            implode('.', $parts)
        ];
    }
}
