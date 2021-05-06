<?php
require "vendor/autoload.php";

// 每次请求都会产生不同的id，如果客户希望掌控这个id，客户端可以在请求参数中添加一个特殊的参数：__reqId=xxxx
//$config = [
//    'bankNumber'=>6222080200000100332, //	银行账号	string		是	1-64
//    'carNumber'=>'JER123', // 车牌号	string		是	1-64
//    'cusNo'=>'zys', // 客户标识号	string		是	1-64
//    'idCard'=>168894196211028189, // 	身份证号	string		是	1-64
//    'idCardAddress'=>'地址', // 身份证地址	string		是	1-64
//    'name'=>'便咋遍', // 姓名	string		是	1-64
//    'phone'=>13811787301, // 联系电话	string		是	1-64
//    'productName'=>'insure58', // 产品名称	string	默认： insure58	是	1-64
//    'regionCode'=>123456, // 行政编码	string		是	1-64
//];


//$config = [
//    'batchNo'=>6222080200000100332,  // 批次号	string		是	1-64
//    'fileName'=>'JER123',  // 文件名	string		是	1-64
//    'fileType'=>'zys', // 文件类型	string		是	1-64	0，对账文件；1，用车数据;2.电子合同
//];


$config = [
    'amount'=>6222080200000100332,  // 扣款金额	long	0	是		单位：分
    'cusNo'=>'JER123',  // 客户标识号	string		是	1-64
    'finishTime'=>'zys', // 扣款完成时间	string		是	1-64	yyyy-MM-dd hh:mm:ss
];

$client = new \really4you\Xingwen\Client($config);
//$result = $client->request('apply');
//$result = $client->request('fileNotify');
$result = $client->request('repayNotify');
dd($result);