<?php
/**
 * Created by PhpStorm.
 * User: zys
 * Date: 2021/5/6
 * Time: 14:12
 */

namespace really4you\Xingwen\Api\Loan58;

/**
 * 文件通知
 *
 * Class FileNotify
 * @package really4you\Xingwen\Api\Loan58
 */
class FileNotify extends Loan58
{
    const ENDPOINT_URL = '/open/api/open/Loan58/fileNotify';

    public function send()
    {
        $params = $this->buildRequest();
        $response =  $this->postJson($this->buildUrl(), $params,$this->defaultHeader());

        return $response;

        /**
         * batchNo	批次号	string	0-64
           fileName	文件名	string	0-64
           status	状态	int		0:成功入库；-1:文件不存在；-2:文件解析异常
         *  [
            "_id" => "d71c8087-54e9-4328-9dca-3d98182882c4"
            "code" => 200
            "data" => array:3 [
                "fileName" => "JER123"
                "batchNo" => "6222080200000100332"
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