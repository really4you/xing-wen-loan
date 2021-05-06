<?php

namespace really4you\Xingwen\Api\Loan58;

use really4you\Xingwen\Contracts\StrategyInterface;
use really4you\Xingwen\Support\Config;
use really4you\Xingwen\Traits\HasHttpRequest;

abstract class Loan58 implements StrategyInterface
{
    use HasHttpRequest;

    const DEFAULT_TIMEOUT = 5.0;

    /**
     * @var Config
     */
    protected $config;

    /**
     * @var array
     */
    protected $options;

    /**
     * @var float
     */
    protected $timeout;


    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function getBaseUri()
    {
        return $this->getLoan58DefaultConfig()['base_uri'] ?? null;
    }

    public function buildRequest()
    {
        $param = $this->config->getConfig();
        $param['appId']     = $this->getLoan58DefaultConfig()['app_id'] ?? null;
        $param['signature'] = $this->buildSignature($param);

        return $param;
    }

    public function defaultHeader()
    {
        return ['Accept'=>'application/json; charset=UTF-8'];
    }

    /**
     * get Signature for loan58
     *
     * @param array $params
     *
     * @return string
     */
    public function signature(array $params) :string
    {
        ksort($params);
        $signature = "";

        foreach ($params as $k => $v) {
            $signature .= $k . "=" . $v . "&";
        }

        return trim($signature, "&");
    }

    public function buildSignature(array $params)
    {
        $signature = $this->signature($params);

        return $this->getSign($signature,$this->getLoan58DefaultConfig()['private_key'] ?? null);
    }

    /**
     * 生成签名
     *
     * @param    string     $signString 待签名字符串
     * @param    [type]     $priKey     私钥
     *
     * @return   string     base64结果值
     */
    public function getSign($signString,$priKey)
    {
        $priKey = "-----BEGIN RSA PRIVATE KEY-----\n" .$priKey."\n-----END RSA PRIVATE KEY-----";
        $privKeyId = openssl_pkey_get_private($priKey);

        openssl_sign($signString,$sign,$privKeyId,OPENSSL_ALGO_MD5);
        return base64_encode($sign);
    }


    /**
     * Return timeout.
     *
     * @return int|mixed
     */
    public function getTimeout()
    {
        return $this->timeout ?: $this->config->get('timeout', self::DEFAULT_TIMEOUT);
    }

    /**
     * Set timeout.
     *
     * @param int $timeout
     *
     * @return $this
     */
    public function setTimeout($timeout)
    {
        $this->timeout = floatval($timeout);

        return $this;
    }

//    public function getLoan58Config()
//    {
//        return $this->config;
//    }
//
//
//    public function setLoan58Config(Config $config)
//    {
//        $this->config = $config;
//
//        return $this;
//    }

    public function setGuzzleOptions($options)
    {
        $this->options = $options;

        return $this;
    }

    public function getGuzzleOptions()
    {
        return $this->options ?: $this->config->get('options', []);
    }

    protected function getLoan58DefaultConfig()
    {
        $source = realpath(dirname(dirname(__DIR__)).'/config.php');

        if (is_file($source)) {
            $source = include $source;
        }

        return $source['defaults_loan58'] ?? null;
    }
}
