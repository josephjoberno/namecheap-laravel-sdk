<?php

namespace Namecheap\Laravel;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;
use Namecheap\Laravel\Resources\Dns;
use Namecheap\Laravel\Resources\Ssl;
use Namecheap\Laravel\Resources\Users;
use Namecheap\Laravel\Resources\Whois;
use Namecheap\Laravel\Resources\Domains;

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

    protected function getBaseUrl()
    {
        return $this->sandbox
            ? 'https://api.sandbox.namecheap.com/xml.response'
            : 'https://api.namecheap.com/xml.response';
    }

    protected function buildQueryParams(array $params = [])
    {
        return array_merge([
            'ApiUser' => $this->apiUser,
            'ApiKey' => $this->apiKey,
            'UserName' => $this->username,
            'ClientIp' => $this->clientIp,
        ], $params);
    }

    public function request($command, array $params = [])
    {
        $response = Http::get($this->getBaseUrl(), $this->buildQueryParams(array_merge([
            'Command' => $command,
        ], $params)));

        $xml = simplexml_load_string($response->body());

        return json_decode(json_encode($xml), true);
    }

    // Domains API Methods
    public function getDomainList($page = 1, $pageSize = 100)
    {
        return $this->request('namecheap.domains.getList', [
            'Page' => $page,
            'PageSize' => $pageSize
        ]);
    }

    public function checkDomainAvailability($domains)
    {
        if (!is_array($domains)) {
            $domains = [$domains];
        }

        return $this->request('namecheap.domains.check', [
            'DomainList' => implode(',', $domains)
        ]);
    }

    public function getDomainInfo($domain)
    {
        return $this->request('namecheap.domains.getInfo', [
            'DomainName' => $domain
        ]);
    }

    // DNS API Methods
    public function getDnsRecords($domain)
    {
        $parts = explode('.', $domain);
        $sld = $parts[0];
        $tld = implode('.', array_slice($parts, 1));

        return $this->request('namecheap.domains.dns.getHosts', [
            'SLD' => $sld,
            'TLD' => $tld
        ]);
    }

    public function setDnsRecords($domain, array $records)
    {
        $parts = explode('.', $domain);
        $sld = $parts[0];
        $tld = implode('.', array_slice($parts, 1));

        $params = [
            'SLD' => $sld,
            'TLD' => $tld
        ];

        foreach ($records as $index => $record) {
            $params = array_merge($params, [
                "HostName{$index}" => $record['hostname'],
                "RecordType{$index}" => $record['type'],
                "Address{$index}" => $record['address'],
                "TTL{$index}" => $record['ttl'] ?? 1800,
            ]);
        }

        return $this->request('namecheap.domains.dns.setHosts', $params);
    }

    // Resource Accessors
    public function domains(): Domains
    {
        return $this->domains;
    }

    public function dns(): Dns
    {
        return $this->dns;
    }

    public function ssl(): Ssl
    {
        return $this->ssl;
    }

    public function users(): Users
    {
        return $this->users;
    }

    public function whois(): Whois
    {
        return $this->whois;
    }
}
