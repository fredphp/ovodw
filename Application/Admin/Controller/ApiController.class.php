<?php

namespace Admin\Controller;

use Common\Controller\AdminBaseController;

class ApiController extends AdminBaseController
{
    public function index(){
        if(IS_POST){
            $data = $_POST;
            $data['savetime'] = time();
            $updata['isuse'] = 0;
            M()->startTrans();
            $up = M('api')->where('isuse=1')->save($updata);
            if ($up) {
                $id = $data['channel'];
                $info = [
                    'time'  => $data['time'][$id],
                    'url'   => $data['url'][$id],
                    'project' => $data['project'][$id],
                    'username' => $data['username'][$id],
                    'password' => $data['password'][$id],
                    'token' => $data['token'][$id],
                    'api' => $data['api'][$id],
                    'code' => $data['code'][$id],
                    'msg' => $data['msg'][$id],
                    'phone' => $data['phone'][$id],
                    'sms' => $data['sms'][$id],
                    'nation' => $data['nation'][$id],
                    'isuse'=>1
                ];
                $res = M('api')->where('id='.$id)->save($info);
                if($res){
                    M()->commit();
                    $arr['code'] = 0;
                    $arr['msg'] = '提交成功';
                }else{
                    M()->rollback();
                    $arr['code'] = 1;
                    $arr['msg'] = '提交失败1';
                }
            }else{
                M()->rollback();
                $arr['code'] = 1;
                $arr['msg'] = '提交失败2';
            }

            
            $this->ajaxReturn($arr);
        }else{
            // $api = M('api')->where('id=1')->find();
            $api = M('api')->order('id asc')->select();

            $nation = M('nation')->order('number asc')->select();
            $this->assign('nation',$nation);
            $this->assign('api',$api);
            $this->display();
        }
    }

    //获取token
    public function gettoken(){
        $id = $_POST['id'];
        $api = M('api')->where('id='.$id)->find();
        if($api['api']==''){
            $arr['code'] = 1;
            $arr['msg'] = '请先补全其他信息';
            $this->ajaxReturn($arr);die;
        }
        // $url = $api['api'] . 'login?username='.$api['username'].'&password='.$api['password'];
    // $url = $api['api'].'?code=login&user='.$api['username'].'&password='.$api['password'];
    // http://服务器地址/sms/?api=login&user=用户名&pass=密码
        switch ($id) {
            case 1:
                $url = $api['api'].'/sms/?api=login&user='.$api['username'].'&pass='.$api['password'];
                $content = $this->getUrl($url);
                $c = json_decode($content,true);
                if ($c['code'] == 0){
                    $arr['code'] = 0;
                    $arr['msg'] = '获取成功';
                    $arr['token'] = $c['token'];
                }else{
                    $arr['code'] = 1;
                     $arr['msg'] = "获取失败，请稍后再试";
                }
                break;
            case 2:
                $url = $api['api'].'?act=login&ApiName='.$api['username'].'&PassWord='.$api['password'];
                $content = $this->getUrl($url);
                $c = explode('|',$content);
                if ($c[0] == 1) {
                    $arr['code'] = 0;
                    $arr['msg'] = '获取成功';
                    $arr['token'] = $c[1];
                }else{
                    $arr['code'] = 1;
                    $arr['msg'] = '获取失败,错误代码'.$c[1];
                }
                break;
        }
        
        // $content = json_decode($content,true);
        // $msg = $api['msg'];
        // if($content["msg"]=='success'){
        //     $arr['code'] = 0;
        //     $arr['msg'] = '获取成功';
        //     $arr['token'] = $content['token'];
        // }else{
        //     $arr['code'] = 1;
        //     $arr['msg'] = "获取失败，请稍后再试";
        // }
        
        $this->ajaxReturn($arr);
    }

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
