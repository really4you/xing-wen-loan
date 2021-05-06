<?php

namespace really4you\Xingwen;

use really4you\Xingwen\Contracts\StrategyInterface;
use really4you\Xingwen\Exceptions\InvalidArgumentException;

class Messenger
{
    const STATUS_SUCCESS = 'success';

    const STATUS_FAILURE = 'failure';

    /**
     * @var \really4you\Xingwen\Client
     */
    protected $client;

    /**
     *
     * Messenger constructor.
     * @param \really4you\Xingwen\Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function handle(StrategyInterface $strategy)
    {
        try {
            return $strategy->send();

        }  catch (\Throwable $e) {
            $results = [
                'strategy' => $this->client->getStrategy(),
                'status' => self::STATUS_FAILURE,
                'exception' => $e->getMessage(),
            ];

            throw new InvalidArgumentException(json_encode($results));
        }
    }
}