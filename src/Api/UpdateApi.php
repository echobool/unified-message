<?php
/**
 * Created by PhpStorm.
 * User: luojinyi
 * Date: 2018/10/19
 * Time: 上午9:37
 */

namespace Scctedu\UnifiedMessage\Api;


class UpdateApi extends Api
{


    protected $endPointUrl;


    public function setEndPointUrl($pointUrl)
    {
        $this->endPointUrl = $this->config['base_url'] . $pointUrl . '/' . $this->parameter['id'];
    }



    public function send($pointUrl,$parameter)
    {
        $this->setParameter($parameter);

        $this->setEndPointUrl($pointUrl);

        return $this->put($this->endPointUrl, $this->parameter);
    }


}
