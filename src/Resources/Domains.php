<?php
namespace Namecheap\Laravel\Resources;

use Namecheap\Laravel\Resources\AbstractResource;

class Domains extends AbstractResource
{
    public function getList(int $page = 1, int $pageSize = 100): array
    {
        return $this->get('namecheap.domains.getList', [
            'Page' => $page,
            'PageSize' => $pageSize
        ]);
    }

    public function check(string|array $domains): array
    {
        $domains = is_array($domains) ? $domains : [$domains];
        return $this->get('namecheap.domains.check', [
            'DomainList' => implode(',', $domains)
        ]);
    }

    public function create(array $data): array
    {
        return $this->get('namecheap.domains.create', [
            'DomainName' => $data['DomainName'],
            'Years' => $data['Years'] ?? 1,
            'RegistrantFirstName' => $data['RegistrantFirstName'],
            'RegistrantLastName' => $data['RegistrantLastName'], 
            'RegistrantAddress1' => $data['RegistrantAddress1'],
            'RegistrantCity' => $data['RegistrantCity'],
            'RegistrantStateProvince' => $data['RegistrantStateProvince'],
            'RegistrantPostalCode' => $data['RegistrantPostalCode'],
            'RegistrantCountry' => $data['RegistrantCountry'],
            'RegistrantPhone' => $data['RegistrantPhone'],
            'RegistrantEmailAddress' => $data['RegistrantEmailAddress'],
            'TechFirstName' => $data['TechFirstName'],
            'TechLastName' => $data['TechLastName'],
            'TechAddress1' => $data['TechAddress1'], 
            'TechCity' => $data['TechCity'],
            'TechStateProvince' => $data['TechStateProvince'],
            'TechPostalCode' => $data['TechPostalCode'],
            'TechCountry' => $data['TechCountry'],
            'TechPhone' => $data['TechPhone'],
            'TechEmailAddress' => $data['TechEmailAddress'],
        ]);
    }

    public function renew(string $domain, int $years = 1): array
    {
        return $this->get('namecheap.domains.renew', [
            'DomainName' => $domain,
            'Years' => $years
        ]);
    }

    public function getInfo(string $domain): array
    {
        return $this->get('namecheap.domains.getInfo', [
            'DomainName' => $domain
        ]);
    }
}