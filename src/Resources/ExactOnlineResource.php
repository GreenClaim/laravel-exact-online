<?php

namespace Yource\ExactOnlineClient\Resources;

use Yource\ExactOnlineClient\Interfaces\ExactOnlineModelInterface;
use Yource\ExactOnlineClient\ExactOnlineClient;

class ExactOnlineResource implements ExactOnlineModelInterface
{
    protected $client;

    public function __construct()
    {
        $this->client = new ExactOnlineClient($this->getEndpoint());
    }

    public function getEndpoint(): string
    {
        return '';
    }

    public function where(string $field, $value)
    {
        $this->client->where($field, $value);

        return $this;
    }

    public function get()
    {
        return $this->client->get();
    }

    public function toArray()
    {
        return $this->client->toArray();
    }
}
