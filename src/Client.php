<?php

namespace really4you\Xingwen;

use really4you\Xingwen\Support\Config;

class Client
{
    /**
     * @var \really4you\Xingwen\Support\Config
     */
    protected $config;
    protected $messenger;
    protected $strategy;
    protected $api;


    /**
     * Constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = new Config($config);
    }

    public function request(string $api)
    {
        return $this->getMessenger()->handle($this->formatApi($api));
    }

    /**
     *
     * @return Messenger
     */
    public function getMessenger()
    {
        return $this->messenger ?: $this->messenger = new Messenger($this);
    }

    /**
     *
     * @param $strategy
     * @return mixed
     */
    protected function formatApi($strategy)
    {
        $apiType = $this->config->get('default.api_type', 'Loan58');
        $strategyTemp = \sprintf(__NAMESPACE__.'\Api\\%s\\',$apiType).\ucfirst($strategy);

        if (!\class_exists($strategyTemp)) {
            throw new \InvalidArgumentException("Unsupported Api \"{$strategyTemp}\"");
        }

        $this->api = $apiType.\ucfirst($strategy);

        if (empty($this->strategy)) {
            $this->strategy = new $strategyTemp($this->config);
        }

        return $this->strategy;
    }

    public function getStrategy()
    {
        return $this->api;
    }
}