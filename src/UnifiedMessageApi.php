<?php
/**
 * Created by PhpStorm.
 * User: luojinyi
 * Date: 2018/10/18
 * Time: 下午1:56
 */

namespace Scctedu\UnifiedMessage;

use Scctedu\UnifiedMessage\Api\User\CreateApi;
use Scctedu\UnifiedMessage\Contracts\ApiInterface;
use Scctedu\UnifiedMessage\Exceptions\Exception;
use Scctedu\UnifiedMessage\Exceptions\InvalidArgumentException;
use Scctedu\UnifiedMessage\Exceptions\NoGatewayAvailableException;
use Scctedu\UnifiedMessage\Support\Config;

/**
 * Class UnifiedMessage
 * @package Scctedu\UnifiedMessage
 */
class UnifiedMessageApi
{

    protected $currentApi;

    protected $pointUrl;

    /**
     * @var
     */
    protected $config;

    /**
     * @var
     */
    protected $parameter;

    /**
     * @var
     */
    protected $apiName;

    /**
     * @param mixed $pointUrl
     */
    public function setPointUrl($pointUrl)
    {
        $this->pointUrl = $pointUrl;
        return $this;
    }

    /**
     * @param mixed $parameter
     * @return mixed
     */
    public function setParameter($parameter)
    {
        $this->parameter = $parameter;
        return $this;
    }

    /**
     * @param mixed $apiName
     * @return mixed
     */
    public function setApiName($apiName)
    {
        $this->apiName = $apiName;
        return $this;
    }

    /**
     * @param mixed $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
        return $this;
    }


    public function setCurrentApi()
    {

        $this->currentApi = $this->createApi($this->apiName);

    }


    public function send()
    {
        //调用api中的send方法
        $this->setCurrentApi();

       return $this->currentApi->send($this->pointUrl,$this->parameter);
    }


    protected function createApi($name)
    {
        $className = $this->formatApiClassName($name);
        $Api = $this->makeApi($className, $this->config);

        if (!($Api instanceof ApiInterface)) {
            throw new InvalidArgumentException(sprintf('Api "%s" not inherited from %s.', $name, ApiInterface::class));
        }

        return $Api;
    }

    protected function formatApiClassName( $name)
    {
        if (class_exists($name)) {
            return $name;
        }

        $name = ucfirst(str_replace(['-', '_', ''], '', $name));

        return __NAMESPACE__ . "\\Api\\{$name}Api";
    }

    protected function makeApi($Api, $config)
    {
        if (!class_exists($Api)) {
            throw new InvalidArgumentException(sprintf('Api "%s" not exists.', $Api));
        }

        return new $Api($config);
    }
}
