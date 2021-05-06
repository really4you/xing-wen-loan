<?php
/**
 * Created by PhpStorm.
 * User: zys
 * Date: 2021/5/6
 * Time: 14:16
 */

namespace really4you\Xingwen\Api\Loan58;

/**
 * 代扣通知
 *
 * Class RepayNotify
 * @package really4you\Xingwen\Api\Loan58
 */
class RepayNotify extends Loan58
{
    const ENDPOINT_URL = '/open/api/open/Loan58/repayNotify';

    public function send()
    {
        $params = $this->buildRequest();
        $response =  $this->postJson($this->buildUrl(), $params,$this->defaultHeader());

        return $response;

        /**
         * cusNo	客户标识号	string	0-64
           status	状态	int		0成功，-1：失败
         * [
            "_id" => "c811651e-b18f-4b7e-b641-d21abd788c09"
            "code" => 200
            "data" => array:2 [
                "cusNo" => "JER123"
                "status" => 0
            ]
            "msg" => ""
           ]
         */
    }

    private function buildUrl()
    {
        return $this->getBaseUri().self::ENDPOINT_URL;
    }
}