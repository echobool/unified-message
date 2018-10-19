<?php
/**
 * Created by PhpStorm.
 * User: luojinyi
 * Date: 2018/10/19
 * Time: 上午9:37
 */

namespace Scctedu\UnifiedMessage\Api;


class DeleteApi extends Api
{

    protected $endPointUrl;

    public function setEndPointUrl($pointUrl)
    {
        $this->endPointUrl = $this->config['base_url'] . $pointUrl. '/' . $this->parameter['id'];
    }


    public function send($pointUrl,$parameter)
    {
        $this->setParameter($parameter);

        $this->setEndPointUrl($pointUrl);

        return $this->delete($this->endPointUrl, $this->parameter);
    }

    protected function delete($endpoint, $params = [], $headers = [])
    {
        return $this->request('delete', $endpoint, [
            'headers' => $headers,
            'form_params' => $params,
        ]);
    }

}