<?php

namespace app\admin\model;

use think\Model;
USE think\Db;

class Order extends Model
{
    public function __construct(){
        parent::__construct();

        import('yeepay.YopClient3', EXTEND_PATH, '.php');

        $this->parentMerchantNo = '10026912451';//config('parentMerchantNo');
        $this->merchantNo = '10027419272';//config('merchantNo');
        $this->private_key = 'MIIEugIBADANBgkqhkiG9w0BAQEFAASCBKQwggSgAgEAAoIBAQDAVCOCDnslcJceuxavrLswc9WPU9b7yBTVadL8dPVD+Qqpd1xcFQm1FyxIZRbgEAV4MT8oSdhMYqV7bKSyt5PrT9oU5bzJytdJQwxe3eX7WYMldHNv9EHr1uJAQhgWPwqRndRoKHiCxcgy6ps10HGE8Qj0IsAyTL/Og6idcYekVlbVj9w0kotq0kPmRkda0wS8lYD6mH6qq9C36FnEWV3qVKdcO/hJ2AG9e5m75HuAU99BbfwYr0uStZcimpYLtOj0/Cn4v5B//Gthc/Cgf3LJ5FuiKmPKoxfnNoB4TB5ALRcDaovacT7SsMhXFwbfRkt2OfZVYqFtiiuyzUYefU+ZAgMBAAECgf90cn0NQbdN892Lvbr+opazv26OWTTRPVNf47LbJ/VYMnFCKgLBvfsiqeUl8A7pmsm0/BxBSHStywxmrmEJ1By7XJ2uCWtEwouW0AGtbqzQgmHlS5yZLEq9gF18iogK8CB2ChmQ9vAAPb/5FBLlgk85Lrc9Gc1EpzN61jxBF3wJAy/2AL0Q+NYpq6TOWXWoEYFnjQtStq7AaJOh4/K0RhmFvVapyXL4i7fWddWW2jZ//AzIOe5ok5VD7YdxPKXRSxCjlS5JTDVDAZ3KY72i4+oVpeqffF5XR3MdAai+66wHI3eH0QKf6Qz56wyH9yFwSzBEValeWV29SP+MOhjcqI0CgYEA8NxL2kzVh8Kdygkm9pJB3Gxd9ZUPw9oKEdWusZSKLvIs36KPY6qYB5xsF03lmZoe0HvtBLUL03J/D2BVDChHbv2pT5wxKkHU0vkw5ojRiEnMpWbvE6skndeZEA1DD6E4+RSL10siAjXoSKifHzaEu7s1Km30hWqsRBdzXir3gNMCgYEAzGrpqkFnSnQq4sepnL9v247ikjYJi80tly1tjMdkJww9exX1EOSgSMXtXgMof99GUTipFBHe8PRtX4I+yI9K/I4zxRtaYgP+gZ7BVgYe98E6ZNrGD/8LNbJfDbsBwrtYDE/Y23hRbLJOPN/+PocF5LA+uJMuIni1DDfh7MJgymMCgYB+cskHtCqt+UgpVyCzdhlJhULWuQjrwz5iGpJ5/AeHmfBg/9DTfC4QYNiGa4jMWRMwVL8cJ4gr3AJEqkg797F43YbTmqZdDu6SS+yWOuH18PiVJTMCWmkAzL04ph28yOFGMrkvr+wMyQxHiO7wzghlHmVM/yjOGjCSFtWkbF4/rQKBgDI+8VKdIvOFHGmD5GgYEjmopH6F89C+TT+EthHNjQugEZiorAVL/S4GILNkGVddHV6ni7/YKLGXky7Px/jqZ+cuWQFRGOVQ0AUybZlkhcYmY+EYeWjDKxE21/B7EBK6lAjqs4Y2y+To6xxBfrAF5mfw/mnGG6fzfaUUM19L5Bi7AoGAVI8iQ5NP0iZtCdSnQPkjKZMDifwVLwdfcaEjRYop7cfe9IYak+QPC/LQGkjKH5G8t2OAsbC9wExwM3Lhd9DKRBDlqcCPxaTD5Wxq1UDXDcARWarWOpDF7l3Gt7StAsGo9QRb8d0w9CRFLCDzxj1CKGwVz12XfrpL/OdVqtHe/EI=';//config('private_key');
        $this->yop_public_key = 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA6p0XWjscY+gsyqKRhw9MeLsEmhFdBRhT2emOck/F1Omw38ZWhJxh9kDfs5HzFJMrVozgU+SJFDONxs8UB0wMILKRmqfLcfClG9MyCNuJkkfm0HFQv1hRGdOvZPXj3Bckuwa7FrEXBRYUhK7vJ40afumspthmse6bs6mZxNn/mALZ2X07uznOrrc2rk41Y2HftduxZw6T4EmtWuN2x4CZ8gwSyPAW5ZzZJLQ6tZDojBK4GZTAGhnn3bg5bBsBlw2+FLkCQBuDsJVsFPiGh/b6K/+zGTvWyUcu+LUj2MejYQELDO3i2vQXVDk7lVi2/TcUYefvIcssnzsfCfjaorxsuwIDAQAB';//config('yop_public_key');

        $this->merHmacKey = '877X5o8A1ku3rCG03N0N5587e8l64WA5506K127X08201y777MM04z3D10r1';//config('merHmacKey');

        $this->notifyUrl = 'http://47.104.30.132/callback.php';
    }
    

    //数据库
    protected $connection = 'database';
    // 表名
    protected $name = 'wk_order';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'type_text',
        'add_time_text',
        'update_time_text'
    ];
    

    
    public function getTypeList()
    {
        return ['1' => __('Type 1'), '2' => __('Type 2')];
    }

    public function getOrder_statusList()
    {
        return ['1' => __('Order_status 1'), '2' => __('Order_status 2'),  '3' => __('Order_status 3')];
    }


    public function getTypeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['type']) ? $data['type'] : '');
        $list = $this->getTypeList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getAddTimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['add_time']) ? $data['add_time'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getUpdateTimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['update_time']) ? $data['update_time'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }

    protected function setAddTimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }

    protected function setUpdateTimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }


    public function wkuser()
    {
        return $this->belongsTo('WkUser', 'user_id', 'id', [], 'LEFT')->setEagerlyType(0);
    }

    public function test()
    {
        return $this->notifyUrl;
    }

    public function pay($type,$amount,$user_id="2",$goods_name="goods",$sn=""){

//        $type = input('post.type');//1支付宝2微信
//        $user_id = input('post.userid')?:2;
//        $amount = input('post.amount');//订单金额
//        $goods_name = input('post.goods_name')?:'goods';
//        $payType = array('1'=>'ALIPAY','2'=>'WECHAT');
//        $sn = input('post.sn');//设备sn

        $payType = array('1'=>'ALIPAY','2'=>'WECHAT');
        $request = new \YopRequest("OPR:".$this->parentMerchantNo, $this->private_key, "https://open.yeepay.com/yop-center",$this->yop_public_key);

        if($user_id == 1){$user_id = 2;}

        $user = Db::name('wk_user')->where(['id'=>$user_id])->field('user_name,merchant_no,divide_rate')->find();
        if(!$user){
            return json(['status'=>0,'msg'=>'用户不存在']);
        }else{
            $yeepay_in = round(bcmul($amount,0.003,10),2);
            $platform_in = round(bcsub($user['divide_rate'],0.003,10)*$amount,2);
            if($platform_in < 0){
                return json(['status'=>0,'msg'=>'金额计算错误']);
            }
            $user_in = bcsub($amount,bcadd($yeepay_in,$platform_in,10),2);
            $request->addParam("divideDetail",'[{"ledgerNo":"'.$user['merchant_no'].'","ledgerName":"'.$user['user_name'].'", "amount":"'.$user_in.'"}]');
            $request->addParam("fundProcessType", 'SPLIT_ACCOUNT_IN');
        }

        $data=array();
        $data['parentMerchantNo']=$this->parentMerchantNo;
        $data['merchantNo']=$this->merchantNo;
        $data['orderId']=$this->getOrderId();
        $data['orderAmount']=$amount;
        $data['notifyUrl']=$this->notifyUrl;

        $goods = array(
            'goodsName'=>$goods_name,
        );

        $request->addParam("parentMerchantNo", $data['parentMerchantNo']);
        $request->addParam("merchantNo", $data['merchantNo']);
        $request->addParam("orderId", $data['orderId']);
        $request->addParam("orderAmount", $data['orderAmount']);
        $request->addParam("timeoutExpress", 7200);//过期时间 默认72小时， 最小1秒， 最大5年
        $request->addParam("timeoutExpressType", 'SECOND');//过期时间单位：SECOND("秒"), MINUTE("分"), HOUR("时"), DAY("天")
        $request->addParam("requestDate", $this->getDate());
        $request->addParam("notifyUrl", $this->notifyUrl);
        $request->addParam("goodsParamExt", json_encode($goods));
        $request->addParam("hmac", $this->getHmac($data));
        $request->addParam("payTool", 'SCCANPAY');
        $request->addParam("payType", $payType[$type]);
        $request->addParam("userIp", $_SERVER['REMOTE_ADDR']);
        $request->addParam("extParamMap", '{"reportFee":"XIANXIA"}');
//return $request;
        $response = \YopClient3::post("/rest/v1.0/nccashierapi/api/orderpay", $request);
//    return 2;
        $result = (array)$response->result;
        if($result['code'] == 'CAS00000'){
            $info = array(
                'user_id'=>$user_id,
                'order_id'=>$data['orderId'],
                'unique_order_id'=>$result['uniqueOrderNo'],
                'type'=>$type,
                'order_amount'=>$data['orderAmount'],
                'goods_title'=>$goods['goodsName'],
                'goods_detail'=>$goods['goodsDesc']?:'',
                'residual_amount'=>$data['orderAmount'],
                'user_in'=>$user_in,
                'platform_in'=>$platform_in,
                'yeepay_in'=>$yeepay_in,
                'divide_rate'=>$user['divide_rate'],
                'add_time'=>time(),
                'update_time'=>time(),
                'sn'=>$sn
            );
            $res = Db::name('wk_order')->add($info);
            if($res != false){
                return $result['resultData'];
            }
        }else{
            //var_dump($response);
            return json(['status'=>0,'msg'=>'下单失败']);
        }
    }
    //回调
    public function callback(){
        import('yeepay.Util.YopSignUtils', EXTEND_PATH, '.php');

        $source = $_REQUEST["response"];
        $data = \YopSignUtils::decrypt($source,$this->private_key, $this->yop_public_key);

        // $l = 'time:'.date('Y-m-d H:i:s',time()).PHP_EOL.'data:'.$data.PHP_EOL.PHP_EOL;
        // file_put_contents('./callback.log', $l ,FILE_APPEND);

        $data = json_decode($data,true);

        if($data['status'] == 'SUCCESS'){//支付成功
            $res = Db::name('wk_order')->where(['order_id'=>$data['orderId'],'unique_order_id'=>$data['uniqueOrderNo'],'order_status'=>1])->setField('order_status',2);
            echo "SUCCESS";
        }

    }








    public function getOrderId(){
        date_default_timezone_set('Asia/Shanghai');
        $orderId = "DS" . date("ymd_His") . rand(10, 99);
        return $orderId;
    }


    public function getDate(){
        $date = date('Y-m-d H:i:s',time());
        return $date;
    }


    public function getHmac($data){

        $hmacstr = hash_hmac('sha256', $this->toString($data), $this->merHmacKey, true);
        $hmac = bin2hex($hmacstr);

        return $hmac;
    }


    //将参数转换成k=v拼接的形式
    public function toString($arraydata){
        $Str="";
        foreach ($arraydata as $k=>$v){
            $Str .= strlen($Str) == 0 ? "" : "&";
            $Str.=$k."=".$v;
        }
        return $Str;
    }
}
