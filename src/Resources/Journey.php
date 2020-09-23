<?php

namespace Yource\ExactOnlineClient\Resources;

class Journey extends ExactOnlineResource
{
    protected $endpoint = 'journeys';

    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    public function whereFrom($value)
    {
        $this->client->where('from', $value);

        return $this;
    }

    public function whereTo($value)
    {
        $this->client->where('to', $value);

        return $this;
    }
}
