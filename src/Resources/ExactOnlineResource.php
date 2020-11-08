<?php

namespace Yource\ExactOnlineClient\Resources;

use BadMethodCallException;
use Exception;
use Yource\ExactOnlineClient\ExactOnlineClient;
use Yource\ExactOnlineClient\Concerns\HasAttributes;

abstract class ExactOnlineResource
{
    use HasAttributes;

    /**
     * Create a new resource instance.
     *
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        $this->fill($attributes);
    }

    /**
     * Dynamically retrieve attributes on the resource.
     *
     * @param  string  $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->getAttribute($key);
    }

    /**
     * Dynamically set attributes on the resource.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return void
     */
    public function __set($key, $value)
    {
        $this->setAttribute($key, $value);
    }

    /**
     * Determine if an attribute or relation exists on the resource.
     *
     * @param  string  $key
     * @return bool
     */
    public function __isset($key)
    {
        return $this->offsetExists($key);
    }

    /**
     * Magically call the resource we want to do a request to
     */
    public function __call(string $method, array $parameters)
    {
        return $this->forwardCallTo($this->newClient(), $method, $parameters);
    }

    public static function __callStatic($method, $parameters)
    {
        return (new static)->$method(...$parameters);
    }

    /**
     * Convert the resource instance to an array.
     *
     * @return array
     */
    public function toArray()
    {
        return array_merge($this->attributesToArray());
    }

    public function newClient(): ExactOnlineClient
    {
        return new ExactOnlineClient($this);
    }

    /**
     * Forward a method call to the given object.
     *
     * @param  string  $method
     * @param  array  $parameters
     *
     * @throws BadMethodCallException
     */
    protected function forwardCallTo($client, $method, $parameters)
    {
        try {
            return $client->{$method}(...$parameters);
        } catch (Exception $e) {
            $pattern = '~^Call to undefined method (?P<class>[^:]+)::(?P<method>[^\(]+)\(\)$~';

            if (! preg_match($pattern, $e->getMessage(), $matches)) {
                throw $e;
            }

            if ($matches['class'] != get_class($client) ||
                $matches['method'] != $method) {
                throw $e;
            }

            static::throwBadMethodCallException($method);
        }
    }

    /**
     * Throw a bad method call exception for the given method.
     *
     * @param  string  $method
     * @return void
     *
     * @throws BadMethodCallException
     */
    protected static function throwBadMethodCallException($method)
    {
        throw new BadMethodCallException(sprintf(
            'Call to undefined method %s::%s()',
            static::class,
            $method
        ));
    }
}
