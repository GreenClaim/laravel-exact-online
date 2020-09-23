<?php

namespace Yource\ExactOnlineClient\Interfaces;

interface ExactOnlineModelInterface
{
    /**
     * The endpoint of the resource
     *
     * @return string
     */
    public function getEndpoint(): string;
}
