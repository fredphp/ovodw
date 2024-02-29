<?php

namespace Home\Controller;


use Think\Controller;

class IndexController extends Controller
{
    protected $config;
    protected $codes;
    protected $phone;
    protected $pkey;
    protected $cptime;
    protected $region;
    protected $pointPhone,$country,$project,$oneapi,$twoapi,$etype;
    protected $err = [
            '-1'    => 'Token不存在',
            '-2'    => 'pkey无效',
            '-3'    => '等待验证码',
            '-4'    => '获取失败，手机号已释放，请重新获取',
            '-5'    => '号码已强制加黑'
        ];
    public function __construct()
    {
        parent::__construct();
        $config = M('api')->where('isuse=1')->find();
        $cnf = M('config')->where(array('name' => array('in',array('sitenname','webtitle','oneapi','twoapi'))))->field('name,value')->select();
        $cnf = array_column($cnf,'value', 'name');
        $name = $cnf['sitenname'] ? $cnf['sitenname'] : '绝地求生';
        $title = $cnf['webtitle'] ? $cnf['webtitle'] : '绝地求生手机验证 - PUBG手机验证,竞技比赛手机验证,排位赛手机验证,绝地求生手机号码绑定';
        $this->oneapi = $cnf['oneapi'] ? $cnf['oneapi'] : 0;
        $this->twoapi = $cnf['twoapi'] ? $cnf['twoapi'] :0;

        // $this->assign('oneapi',$this->oneapi);
        // $this->assign('twoapi',$this->twoapi);
        $this->assign('name',$name);
        $this->assign('title',$title);
        $this->config = $config;
    }


    public function index()
    {
        $config = $this->config;
        $notice = M('notice')->where('id=1')->find();
        $notice['content'] = htmlspecialchars_decode($notice['content']);


        $extra = require_once APP_PATH . 'Common/Conf/extra.php';
        $buyurl = [];
        //获取国家
        if ($this->config['id'] == 2) {
            $country = M('nation')->where('status=1')->field("code,name,isdefault as isd")->select();
            $this->assign('country',$country);
            if ($this->twoapi > 0) {
                $buyurl = M('buyurl')->where('status = 1 and type='.$this->config['id'])->field('title,url')->select();
            }
        } else {
            if ($this->oneapi > 0) {
                $buyurl = M('buyurl')->where('status = 1 and type='.$this->config['id'])->field('title,url')->select();
            }
        }
        
        $this->assign('buyurl',$buyurl);
        //获取项目
        $pro = M('project')->where('type='.$this->config['id'])->field('name,vals as proid,status')->select();
        $this->assign('extra',$extra);

        
        $this->assign('project',$pro);
        $this->assign('config',$config);
        $this->assign('notice',$notice);
        $this->display();
    }

    //验证卡密
    public function getcode(){
        if(IS_POST){
            $code = $_POST['code'];
            $where['code'] = array('eq',$code);
            $res = M('code')->where($where)->find();
            if($res){
                if($res['status']==1){
                    $arr['code'] = 2;
                    $arr['msg'] = '卡密已经被使用';
                    $arr['sms'] = $res['sms'];
                    $arr['phone'] = $res['phone'];
                }else{
                    $arr['code'] = 0;
                    $arr['msg'] = '卡密输入正确，正在获取手机号';
                }
            }else{
                $arr['code'] = 1;
                $arr['msg'] = '卡密不存在';
            }
            $this->ajaxReturn($arr);
        }
    }

    //获取手机号
    public function getphone(){
        if(IS_POST) {
            $config = $this->config;
            $codes = $_POST['code'];
            $rows = M('code')->where(array('code' => $codes))->find();
            $time = time();
            $flag = true;
            $country = $_POST['country'] ? $_POST['country'] : (isset($config['nation']) ? $config['nation'] : 'CN');
            $project = $_POST['project'] ? $_POST['project'] : $config['project'];
            if ($config['id'] == 1 && !empty($rows['projectid'])) {
                $project = $rows['projectid'];
            }
            $phone = $_POST['phone'] ? $_POST['phone'] : '';
            switch ($this->config['id']) {
                case 1:
                    if (!empty($rows['phone']) && $this->config['time'] >= $time - $rows['createphonetime']) {
                        $arr['code'] = 0;
                        $arr['phone'] = $rows['phone'];
                        $arr['time'] = $time - $rows['createphonetime']; 
                        $arr['msg'] = '获取成功';
                        $flag = false;
                    }else{
                        $etype = $_POST['etype'];
                        $api = $config['api'].'/sms/?api=getPhone&token='.$config['token'].'&sid='.$project.'&country_code='.$country.'&phone='.$phone.'&ascription='.$etype;
                        $res = $this->phone($api);
                        $s= json_decode($res,true);
                        // if(strpos($res, 'ERROR') !== 'false'){
                        if($s['code'] == 0){
                            $arr['code'] = 0;
                            $arr['phone'] = $s['phone'];
                            $arr['msg'] = "获取成功";
                        }else{
                            $arr['code'] = 1;
                            $arr['msg'] = "获取号码失败,".$s['msg'];
                        }
                    }
                    break;
                case 2:
                    if (!empty($rows['phone']) && $this->config['time'] >= $time - $rows['createphonetime']) {
                        $arr['code'] = 0;
                        $arr['phone'] = $rows['phone'];
                        $arr['time'] = $time - $rows['createphonetime']; 
                        $arr['msg'] = '获取成功';
                        $where['code'] = $config['nation'];
                        $nation = M('nation')->where($where)->getField('number');
                        $arr['region'] = '+'.$nation;
                        $getKey = M('number')->where(array('phone' => $arr['region'].$arr['phone'],'status'=> 0))->getField('pkey');
                        $arr['pkey'] = $getKey;
                        if (empty($getKey)) {
                            $api = $config['api'].'?act=getPhone&token='.$config['token'].'&iid='.$project.'&did=&country='.$country.'&operator=&provi=&city=&seq=0&mobile='.$phone;
                            $res = $this->phone($api);
                            $s = explode('|',$res);
                            if ($s[0] == 1) {
                                $where['code'] = $config['nation'];
                                $nation = M('nation')->where($where)->getField('number');
                                $arr['code'] = 0;
                                $arr['phone'] = $s[7];
                                $arr['pkey'] = $s[1];
                                $arr['msg'] = '获取成功';
                                $arr['region'] = '+'.$nation;
                                //号码入统计库
                                $para['phone'] = '+'.$nation.$s[7];
                                $para['pkey']  = $s[1];
                                $para['createtime'] = time();
                                M('number')->add($para);
                            }else{
                                $arr['code'] = 1;
                                $arr['msg'] = '获取号码失效'.$s[1];
                            }
                        }
                    }else{
                        $api = $config['api'].'?act=getPhone&token='.$config['token'].'&iid='.$project.'&did=&country='.$country.'&operator=&provi=&city=&seq=0&mobile='.$phone;
                        $res = $this->phone($api);
                        $s = explode('|',$res);
                        if ($s[0] == 1) {
                            $where['code'] = $config['nation'];
                            $nation = M('nation')->where($where)->getField('number');
                            $arr['code'] = 0;
                            $arr['phone'] = $s[7];
                            $arr['pkey'] = $s[1];
                            $arr['msg'] = '获取成功';
                            $arr['region'] = '+'.$nation;
                            //号码入统计库
                            $para['phone'] = '+'.$nation.$s[7];
                            $para['pkey']  = $s[1];
                            $para['createtime'] = time();
                            M('number')->add($para);
                        }else{
                            $arr['code'] = 1;
                            $arr['msg'] = '获取号码失效'.$s[1];
                        }
                    }
                    
                    break;
            }
            if ($arr['code'] == 0 && $flag) {
                $data['phone'] = $arr['phone'];
                $data['createphonetime'] = time();
                M('code')->where(['code' => $codes])->save($data);
             } 
            $this->ajaxReturn($arr);
        }
    }

    public function phone($api){
        $config = $this->config;
        $res = $this->getUrl($api);
        if(strpos($res, 'ERROR') !== false){
            sleep(5);
            $this->phone($api);
        }else{
            return $res;
        } 
    }



    public function getcodes(){
        if(IS_POST){
            $config = $this->config;
            $codes = $_POST['code'];
            $phone = $_POST['phone'];
            $project = !empty($_POST['project']) ? $_POST['project'] : (isset($config['project']) ? $config['project'] : '');
            $country = !empty($_POST['country']) ? $_POST['country'] : 'CN';
            $pointphone = !empty($_POST['phone']) ? $_POST['phone'] :'';
            $rows = M('code')->where(array('code' => $codes))->find();
            if ($config['id'] == 1 && !empty($rows['projectid'])) {
                $project = $rows['projectid'];
            }
            $this->project = $project;
            $this->country = $country;
            $this->codes = $codes;
            $this->phone = $phone;
            $this->pointPhone = $pointphone;
            $this->pkey = $_POST['key'];
            $this->region = $_POST['region'];
            //$api = $config['api']."getMessage?token=".$config['token']."&sid=".$config['project']."&".$config['phone']."=".$phone;
            //$api = $config['api'].'getMessage?token='.$config['token'].'&sid='.$config['project'].'&phone='.$phone;
            //   $api = $config['api'].'?code=getMsg&token='.$config['token'].'&keyWord='.$config['project'].'&phone='.$phone;
            // http://服务器地址/sms/?api=getMessage&token=用户令牌&sid=项目ID&country_code=国家代码&phone=手机号
            switch ($this->config['id']) {
                case 1:
                    $this->etype = $_POST['etype'];
                    $api = $config['api'].'/sms/?api=getMessage&token='.$config['token'].'&sid='.$this->project.'&country_code='.$this->country.'&phone='.$phone.'&ascription='.$this->etype;
                    break;
                case 2:
                    $api = $config['api'].'?act=getPhoneCode&token='.$config['token'].'&pkey='.$this->pkey.'&country='.$this->country.'&mobile='.$this->phone;
                    $row = M('code')->where(['code' => $this->codes])->field('createphonetime')->find();
                    $this->cptime = $row['createphonetime'];
                    break;
            }
            try {
                $this->scode($api);
            } catch (Exception $e) {
                var_dump($e->getMessage());
            }
            
        }
    }
    public function scode($api){
        $config = $this->config;
        $res = $this->getUrl($api);
        switch ($config['id']) {
            case 1:
                $r = json_decode($res,true);
                if($r['code'] == -1 && $r['msg'] == '等待'){
                    // sleep(10);
                    // $this->scode($api);
                    // exit();
                    $arr['code'] = 2;
                    $arr['msg'] = '等待';
                }else if ($r['code'] == -1) {
                    $arr['code'] = 1;
                    $arr['msg'] = "'".$res."'";
                }else{
                    $where['code'] = $this->codes;
                    $data['usertime'] = date('Y-m-d H:i:s',time());
                    // $stri = substr($res,strripos($res,'['));
                    // $re = substr($stri,0,-17);
                    $re = $r['sms'];
                    $data['sms'] = $re;
                    $data['status'] = 1;
                    //$result = substr ($res, 0,11);
                    $result = explode('&',$api);
                    $result = $result[count($result) - 1 ];
                    $result = explode('=',$result);
                    $data['phone'] = $result[count($result) - 1 ];
                    $data['point_phone'] = $this->pointPhone;
                    $data['country'] = $this->country;
                    $data['projectid'] = $this->project;
                    $ss = M('code')->where($where)->save($data);
                    $arr['code'] = 0;
                     
                    //$res = substr($number,strripos($res,"/")+1);
                    $arr['sms'] = $re;
                    $arr['msg'] = "获取成功";
                }
                break;
            case 2:
                $r = explode('|',$res); 
                if ($r[0] == 1) {
                    $where['code'] = $this->codes;
                    $data['usertime'] =  date('Y-m-d H:i:s',time());
                    $data['sms'] = $r[2];
                    $data['status'] = 1;
                    $data['point_phone'] = $this->pointPhone;
                    $data['country'] = $this->country;
                    $data['projectid'] = $this->project;
                    $data['phone'] = $this->phone;
                    $ss = M('code')->where($where)->save($data);

                    M('number')->where(array(
                        'phone' => $this->region.$this->phone,
                        'status' => 0
                    ))->save(array('status'=>1));

                    $arr['code'] = 0;
                    //$res = substr($number,strripos($res,"/")+1);
                    $arr['sms'] = $r[2];
                    $arr['msg'] = "获取成功";
                }else{
                    if ($r[1] == -3) {
                        if ($this->cptime + $this->config['time'] < time()) {
                            $result = $this->free();
                            $arr['code'] = 1;
                            $arr['msg'] = '手机号已释放，请重新获取';
                            if ($result) {
                                M('number')->where(array(
                                    'phone' => $this->region.$this->phone,
                                    'status' => 0
                                ))->save(array('status'=>2));
                            }
                        }else{
                            // sleep(8);
                            // $this->scode($api);
                            // exit();
                            $arr['code'] = 2;
                            $arr['msg'] = '等待';
                        }
                    }else{
                        $arr['code'] = 1;
                        $msg = isset($this->err[$r[1]]) ? $this->err[$r[1]] : '获取失败';
                        $arr['msg'] = $msg;
                    }
                }
                break;
        }
        
        $this->ajaxReturn($arr);
    }
    //释放手机号
    public function free($pkey = '')
    {
        $pkey = empty($pkey) ? $this->pkey : $pkey;
        $url = $this->config['api'].'?act=setRel&token='.$this->config['token'].'&pkey='.$pkey;
        $res = $this->getUrl($url);
        $r = explode('|',$res);
        if ($r[0] == 1) {
            return true;
        }else{
            if ($r[1] == -3) {
                return true;
            }
        }
        return false;
    }

    //拉黑手机号
    public function black(){
        $config = $this->config;
        $phone = $this->phone;
        // $api = $config['api']."addBlacklist?token=".$config['token']."&sid=".$config['project']."&".$config['phone']."=".$phone;
        // http://服务器地址/sms/?api=addBlacklist&token=用户令牌&sid=项目ID&country_code=国家代码&phone=手机号
        // $api = $config['api'].'?code=release&token='.$config['token'].'&phone='.$phone;
        $api = $config['api'].'/sms/?api=addBlacklist&token='.$config['token'].'&sid='.$config['project'].'&country_code=CN&phone='.$phone;
        $this->getUrl($api);
    }
    //自动释放
    public function region()
    {
        if ($this->config['id'] == 1) exit('无需执行');
        $where['status'] = 0;
        $where['createtime'] = array('lt',time() - $this->config['time']);
        $rows = M('number')->where($where)->field('id,pkey')->select();
        if (!empty($rows)) {
            $save = [];
            foreach ($rows as $v) {
                $free = $this->free($v['pkey']);
                if ($free) {
                    $save[] = $v['id'];
                }
            }
        }
        if (!empty($save)) {
            $where['id'] = array('in',$save);
            M('number')->where($where)->save(array(
                'status'    => 2
            ));
        }
        echo '执行成功';
    }

    //get请求
    public function getUrl($url, $header = false) {
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //返回数据不直接输出
        curl_setopt($ch, CURLOPT_ENCODING, "gzip"); //指定gzip压缩
        //add header
        if(!empty($header)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }
        //add ssl support
        if(substr($url, 0, 5) == 'https') {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);    //SSL 报错时使用
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);    //SSL 报错时使用
        }
        //add 302 support
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch,CURLOPT_COOKIEFILE, $this->lastCookieFile); //使用提交后得到的cookie数据
        try {
            $content = curl_exec($ch); //执行并存储结果
        } catch (\Exception $e) {
            $this->_log($e->getMessage());
        }
        $curlError = curl_error($ch);
        if(!empty($curlError)) {
            $this->_log($curlError);
        }
        curl_close($ch);
        return $content;
    }



}