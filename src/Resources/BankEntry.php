<?php

namespace Yource\ExactOnlineClient\Resources;

use Yource\ExactOnlineClient\Interfaces\ExactOnlineResourceInterface;

class BankEntry extends ExactOnlineResource implements ExactOnlineResourceInterface
{
    protected string $endpoint = 'financialtransaction/BankEntries';

    /**
     * The field with the resource's primary key.
     */
    protected string $primaryKeyFieldName = 'EntryID';

    protected array $dates = [
        'Created',
        'Modified',
    ];

    protected array $relationships = [
        'BankEntryLines' => BankEntryLine::class,
    ];

    public function getEndpoint(): string
    {
        return $this->endpoint;
    }
}
