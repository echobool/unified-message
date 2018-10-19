<?php
/**
 * Created by PhpStorm.
 * User: luojinyi
 * Date: 2018/10/19
 * Time: 上午9:08
 */

namespace Scctedu\UnifiedMessage\Contracts;


interface ApiInterface
{

    public function getName();

    public function send($pointUrl,$parameter);

}
