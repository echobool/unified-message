<?php
/**
 * Created by PhpStorm.
 * User: luojinyi
 * Date: 2018/10/19
 * Time: 上午9:37
 */

namespace Scctedu\UnifiedMessage\Api;

class CreateApi extends Api
{

    protected $endPointUrl;


    public function setEndPointUrl($pointUrl)
    {
        $this->endPointUrl = $this->config['base_url'] . $pointUrl;
    }

    //加密处理都在这里面

    public function send($pointUrl,$parameter)
    {
        $this->setParameter($parameter);

        $this->setEndPointUrl($pointUrl);

        return $this->post($this->endPointUrl, $this->parameter);
    }
}
