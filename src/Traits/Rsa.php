<?php

namespace Scctedu\UnifiedMessage\Traits;


/**
 * Trait Rsa
 * @package Scctedu\UnifiedMessage\Traits
 */
trait Rsa
{

    /**
     * @var
     */
    protected $privateKey;

    /**
     * @param mixed $privateKey
     */
    public function setPrivateKey($privateKey)
    {
        $this->privateKey = openssl_get_privatekey($privateKey);
        return $this;
    }

    /**
     * 生成签名
     *
     * @param string 签名材料
     * @param string 签名编码（base64/hex/bin）
     * @return mixed
     */
    public function sign($data, $code = 'base64')
    {
        //去掉这空的项
        foreach ($data as $key => $value) {
            if (empty($value)) unset($data[$key]);
        }

        ksort($data);

        $ret = false;
        if (openssl_sign(http_build_query($data,'&'), $ret, $this->privateKey)) {
            $ret = base64_encode($ret);
        }
        return $ret;
    }

}
