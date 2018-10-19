<?php
/**
 * Created by PhpStorm.
 * User: luojinyi
 * Date: 2018/10/18
 * Time: 下午1:56
 */

namespace Scctedu\UnifiedMessage;

use Scctedu\UnifiedMessage\Support\Config;
use Scctedu\UnifiedMessage\Traits\HasHttpRequest;
use Scctedu\UnifiedMessage\Traits\Rsa;

class UnifiedMessage
{
    use Rsa, HasHttpRequest;

    protected $config;

    protected $channel;

    protected $sendType;

    protected $groupId;

    protected $userId;

    protected $templateId;

    protected $smsData;

    protected $emailData;

    protected $pushData;

    protected $parameter;

    protected $endPointUrl;

    protected $title;

    protected $body;


    /**
     * @param mixed $channel
     */
    public function setChannel($channel)
    {
        $this->channel = $channel;
        return $this;
    }

    /**
     * @param mixed $sendType
     */
    public function setSendType($sendType)
    {
        $this->sendType = $sendType;
        return $this;
    }

    /**
     * @param mixed $groupId
     */
    public function setGroupId($groupId)
    {
        $this->groupId = $groupId;
        return $this;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @param mixed $templateId
     */
    public function setTemplateId($templateId)
    {
        $this->templateId = $templateId;
        return $this;
    }

    /**
     * @param mixed $smsData
     */
    public function setSmsData($smsData)
    {
        $this->smsData = urlencode($smsData);
        return $this;
    }

    /**
     * @param mixed $emailData
     */
    public function setEmailData($emailData)
    {
        $this->emailData = $emailData;
        return $this;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @param mixed $pushData
     */
    public function setPushData($pushData)
    {
        $this->pushData = $pushData;
        return $this;
    }

    /**
     * @param mixed $parameter
     */
    public function setParameter()
    {
        $parameter = [
            'app_id' => $this->config['app_id'],
            'channel' => $this->channel,
            'send_type' => $this->sendType,
        ];

        switch ($this->sendType) {
            case SEND_TYPE_SINGLE:
                $parameter['user_id'] = $this->userId;
                break;
            case SEND_TYPE_GROUP:
                $parameter['group_id'] = $this->groupId;
                break;
            case SEND_TYPE_BROADCAST:

                break;
        }

        switch ($this->channel) {
            case CHANNEL_SMS:
                $parameter['template_id'] = $this->templateId;
                $parameter['sms_data'] = $this->smsData;
                break;
            case CHANNEL_PUSH:
                $parameter['title'] = $this->title;
                $parameter['body'] = $this->body;
                $parameter = array_merge($parameter, $this->pushData);
                break;
            case CHANNEL_EMAIL:

                break;
            case CHANNEL_INSTANT:

                break;
            case CHANNEL_API:

                break;

        }
        //进行签名
        $parameter['sign'] = $this->setPrivateKey($this->config['private_key'])->sign($parameter);

        $this->parameter = $parameter;

        return $this;
    }

    /**
     * @param mixed $endPointUrl
     */
    public function setEndPointUrl($endPointUrl = '')
    {
        $this->endPointUrl = $this->config['base_url'] . ($endPointUrl ? '/' . $endPointUrl : '');
        return $this;
    }

    /**
     * Constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = new Config($config);
        $this->setPrivateKey($this->config['private_key']);
    }


    public function send()
    {
        return $this->get($this->endPointUrl, $this->parameter);
    }
}
