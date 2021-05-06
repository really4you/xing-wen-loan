<?php
/**
 * Created by PhpStorm.
 * User: zys
 * Date: 2021/5/6
 * Time: 14:12
 */

namespace really4you\Xingwen\Api\Loan58;

/**
 * 申请借款
 *
 * Class apply
 * @package really4you\Xingwen\Api\Loan58
 */
class Apply extends Loan58
{
    const ENDPOINT_URL = '/open/api/open/Loan58/apply';

    public function send()
    {
        $params = $this->buildRequest();
        $response =  $this->postJson($this->buildUrl(), $params,$this->defaultHeader());

        return $response;

        /**
         * status	状态	int	0:成功放款；-1:放款异常；-2:超时
         * [
            "_id" => "44f49fb3-359b-445b-bb5b-267bb1af39eb"
            "code" => 200
            "data" => array:1 [
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