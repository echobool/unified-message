<h1 align="center">Unified Message</h1>

<p align="center">:calling: 一款多种发送需求的统一消息通讯组件</p>

## 安装

```shell
$ composer require scctedu/unified-message"
```

## 使用案例

```php
use Scctedu\UnifiedMessage\UnifiedMessage;
    //短信发送
    public function sendSms(Request $request)
    {
        (new UnifiedMessage(config('unified-message')))
            ->setChannel(CHANNEL_SMS)
            ->setSendType(SEND_TYPE_SINGLE)
            ->setUserId(207)
            ->setTemplateId(1)
            ->setSmsData('{"code":"854586"}')
            ->setParameter()
            ->send();
    }
    //推送案例
    public function sendPush(Request $request)
    {
        (new UnifiedMessage(config('unified-message')))
            ->setChannel(CHANNEL_PUSH)
            ->setSendType(SEND_TYPE_SINGLE)
            ->setUserId(207)
            ->setTitle('推送标题')
            ->setBody('推送body')
            ->setPushData([
                //各个推送参数
            ])
            ->setParameter()
            ->send();
    }

/* push的推送参数字段   [
    'Target' => $request->get('target'),
    'TargetValue' => $request->get('target_value'),
    'DeviceType' => $request->get('device_type'),
    'PushType' => $request->get('push_type'),
    'IOSBadge' => $request->get('ios_badge'),
    'IOSMusic' => $request->get('ios_music'),
    'IOSApnsEnv' => $request->get('ios_apns_env'),
    'IOSRemind' => $request->get('ios_remind'),
    'IOSRemindBody' => $request->get('ios_remind_body'),
    'IOSExtParameters' => $request->get('ios_ext_parameters'),
    'AndroidNotifyType' => $request->get('android_notify_type'),
    'AndroidNotificationBarType' => $request->get('android_notification_bar_type'),
    'AndroidOpenType' => $request->get('android_open_type'),
    'AndroidOpenUrl' => $request->get('android_open_url'),
    'AndroidActivity' => $request->get('android_activity'),
    'AndroidMusic' => $request->get('android_music'),
    'AndroidPopupActivity' => $request->get('android_popup_activity'),
    'AndroidPopupTitle' => $request->get('android_popup_title'),
    'AndroidPopupBody' => $request->get('android_popup_body'),
    'AndroidExtParameters' => $request->get('android_ext_parameters'),
    'PushTime' => $request->get('push_time'),
    'ExpireTime' => $request->get('expire_time'),
    'StoreOffline' => $request->get('store_offline'),
]*/
```



## License

MIT
