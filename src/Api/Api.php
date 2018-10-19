<?php
/**
 * Created by PhpStorm.
 * User: luojinyi
 * Date: 2018/10/19
 * Time: 上午9:20
 */

namespace Scctedu\UnifiedMessage\Api;

use Scctedu\UnifiedMessage\Contracts\ApiInterface;
use Scctedu\UnifiedMessage\Support\Config;
use Scctedu\UnifiedMessage\Traits\HasHttpRequest;
use Scctedu\UnifiedMessage\Traits\Rsa;
abstract class Api implements ApiInterface
{
    use Rsa, HasHttpRequest;

    const DEFAULT_TIMEOUT = 5.0;

    protected $config;

    protected $privateKey;

    protected $timeout;

    protected $parameter;

    protected $pointUrl;

    /**
     * @return mixed
     */
    public function getPointUrl()
    {
        return $this->pointUrl;
    }

    /**
     * @param mixed $pointUrl
     */
    public function setPointUrl($pointUrl)
    {
        $this->pointUrl = $pointUrl;
    }



    /**
     * @return mixed
     */
    public function getParameter()
    {
        return $this->parameter;
    }

    /**
     * @param mixed $parameter
     */
    public function setParameter($parameter)
    {
        //进行签名
        $parameter['sign'] = $this->setPrivateKey($this->config['private_key'])->sign($parameter);
        $this->parameter = $parameter;
    }


    public function setPrivateKey($privateKey)
    {
        $this->privateKey = $privateKey;
        return $this;
    }


    public function getTimeout()
    {
        return $this->timeout ?: $this->config->get('timeout', self::DEFAULT_TIMEOUT);
    }


    public function setTimeout($timeout)
    {
        $this->timeout = floatval($timeout);

        return $this;
    }


    public function getConfig()
    {
        return $this->config;
    }


    public function setConfig(Config $config)
    {
        $this->config = $config;

        return $this;
    }

    /**
     * Constructor.
     *
     * @param array $config
     */
    public function __construct($config)
    {
        $this->config = new Config($config);
        $this->setPrivateKey($this->config['private_key']);

    }

    public function getName()
    {
        return \strtolower(str_replace([__NAMESPACE__.'\\', 'Api'], '', \get_class($this)));
    }

}
