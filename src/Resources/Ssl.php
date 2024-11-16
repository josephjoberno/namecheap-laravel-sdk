<?php
namespace Namecheap\Laravel\Resources;

use Namecheap\Laravel\Resources\AbstractResource;

// SSL Resource Class
class Ssl extends AbstractResource
{
    public function getList(int $page = 1, int $pageSize = 100): array
    {
        return $this->get('namecheap.ssl.getList', [
            'Page' => $page,
            'PageSize' => $pageSize
        ]);
    }

    public function create(array $data): array
    {
        return $this->get('namecheap.ssl.create', [
            'Type' => $data['type'],
            'Years' => $data['years'] ?? 1,
            'SANStoADD' => $data['sans'] ?? '',
        ]);
    }

    public function activate(int $certId, array $data): array
    {
        return $this->get('namecheap.ssl.activate', array_merge([
            'CertificateID' => $certId,
        ], $data));
    }

    public function getInfo(int $certId): array
    {
        return $this->get('namecheap.ssl.getInfo', [
            'CertificateID' => $certId
        ]);
    }
}