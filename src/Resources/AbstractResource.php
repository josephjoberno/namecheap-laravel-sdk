<?php

namespace Namecheap\Laravel\Resources;

// Base Resource Class
abstract class AbstractResource
{
    protected $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    protected function get(string $command, array $params = [])
    {
        return $this->client->request($command, $params);
    }
}