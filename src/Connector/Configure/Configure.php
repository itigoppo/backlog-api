<?php

namespace Itigoppo\BacklogApi\Connector\Configure;

use Itigoppo\BacklogApi\Exception\BacklogException;
use Itigoppo\BacklogApi\Traits\PrivateGetterTrait;

/**
 * @property-read string $space_id
 * @property-read string $api_key
 */
abstract class Configure implements ConfigureInterface
{
    use PrivateGetterTrait;

    /** @var string */
    private $space_id;
    /** @var string */
    private $api_key;

    /**
     * Configure constructor.
     * @param array $options
     * @throws BacklogException
     */
    public function __construct($options)
    {
        if (empty($options['space_id'])) {
            throw new BacklogException('space_id must not be null');
        }

        $this->space_id = $options['space_id'];
        $this->api_key = isset($options['api_key']) ? $options['api_key'] : null;
    }
}
