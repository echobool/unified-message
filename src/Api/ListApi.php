<?php
/**
 * Created by PhpStorm.
 * User: luojinyi
 * Date: 2018/10/19
 * Time: 上午9:37
 */

namespace Scctedu\UnifiedMessage\Api;


class ListApi extends Api
{
    protected $endPointUrl;

    public function setEndPointUrl($pointUrl)
    {
        $this->endPointUrl = $this->config['base_url'] . $pointUrl;
    }

    public function send($pointUrl, $parameter)
    {
        $this->setParameter($parameter);

        $this->setEndPointUrl($pointUrl);

        return $this->get($this->endPointUrl, $this->parameter);
    }
}
