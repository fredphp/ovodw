<?php
/**
 * Created by Makecode
 * User: Xiny https://xbug.top i@xiny9.com
 * Coding Standard: PSR2
 * Date: 2020-07-06
 * Time: 17:49
 */

namespace Admin\Controller;

use Common\Controller\AdminBaseController;

class CodeController extends AdminBaseController
{
//    use MakeController;

    public function __construct()
    {
        parent::__construct();
        ini_set('memory_limit', '256M');
        $this->table = 'code';
        $this->addTemplet = 'Code/add';
        $this->editTemplet = 'Code/edit';
        $this->indexTemplet = 'Code/index';
        $config = M('api')->where('isuse=1')->find();
        $this->assign('config',$config);
        $project = M('project')->where('type',$config['id'])->select();
            $this->assign('project',$project);
        $this->whereList = [];
    }

    public function index()
    {
        if (IS_AJAX) {
            $where = " 1 ";
            $data = $_POST;
            parse_str($data['para'], $wherearray);
            $wherearray = I('data.', '', C('DEFAULT_FILTER'), $wherearray);
            $page = empty($data['page']) ? 1 : $data['page'];
            $limit = empty($data['limit']) ? 15 : $data['limit'];
            $whereList = $this->whereList;
            foreach ($wherearray as $k => $v) {
                if (isset($v) && (strlen($v) > 0)) {
                    if (key_exists($k, $whereList)) {
                        if ('eq' === $whereList[$k]) {
                            $where .= " and `{$k}`='{$v}' ";
                        } else {
                            $where .= " and `{$k}` like '%{$v}%' ";
                        }
                    } else {
                        $where .= " and `{$k}`='{$v}' ";
                    }
                }
            }
            $query = M($this->table)
                ->where($where);
            if (empty($wherearray)) {
                $query = $query->limit(($page - 1) * $limit, $limit);
            }
            $list = $query->order('addtime DESC')
                ->select();
            $count = M($this->table)->where($where)->count();
            $res = array(
                'code' => 0
            , 'count' => $count
            , 'msg' => ''
            , 'data' => $list
            );
            $this->ajaxReturn($res);
        } elseif (IS_GET) {
            $this->display($this->indexTemplet);
        }
    }
    public function add()
    {
        if (IS_AJAX) {

        } elseif (IS_GET) {
            $this->display($this->addTemplet);
        }
    }

    //获取卡密
    public function getcode(){
        $num = I('num');
        $length = I('length');
        $aid = I('aid');
        $projectid = I('projectid');
        if ($aid != 1) {
            $projectid = '';
        }
        $codes = array();
        for ($i=0;$i<$num;$i++){
            $codes[$i]['code'] = $this->randomkeys($length);
        }
        $name = $num ."code" . date("YmdHis", time()) . ".txt";
        $filename = "Public/". $name;
        foreach ($codes as $k => $v){
            $codes[$k]['addtime'] = date('Y-m-d H:i:s',time());
            $codes[$k]['aid'] = $aid;
            $codes[$k]['projectid'] = $projectid;
            $code[] = $v['code'] . "\n";
        }
        file_put_contents($filename, $code);
        $res = M('code')->addAll($codes);
        if($res){
            $arr['code'] = 0;
            $arr['msg'] = '生成成功';
            $arr['url'] = $this->get_http_type().'/'.$filename;
            $arr['file'] = $name;
        }else{
            $arr['code'] = 1;
            $arr['msg'] = "系统出错，请稍后再试";
        }
        $this->ajaxReturn($arr);
    }
    
    function get_http_type()
    {
        $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
        return $http_type . $_SERVER['SERVER_NAME'];
    }

    //生成卡密
    public function randomkeys($length){
        $pattern = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFHIJKMPQRSTUWYZ';
        for($i=0;$i<$length;$i++)
        {
            $key .= $pattern{mt_rand(0,55)};    //生成php随机数
        }
        return $key;
    }

    public function edit()
    {
        if (IS_GET) {
            $info = M($this->table)->getByid(I('get.id'));
            $this->assign('info', $info);
            $this->display($this->editTemplet);
        } elseif (IS_AJAX) {
            try {
                $data = [];
                parse_str($_POST['para'], $data);
                $data = I('data.', '', C('DEFAULT_FILTER'), $data);
                foreach ($data as $k => $v) {
                    if (is_array($v)) {
                        $data[$k] = implode($v, ',');
                    }
                }
                $row = M($this->table)->save($data);
                $row === false ? $this->error('网络故障') : $row === 0 ?
                    $this->error('数据无改动', 'nojump', IS_AJAX, 2) : $this->success('操作成功');
            } catch (Exception $e) {
                $this->error("预期之外的错误，错误ID号：".$e->getErrorID());
            }
        }
    }

    public function delete()
    {
        if (IS_AJAX) {
            try {
                $id = I('post.id');
                if (is_array($id)) {
                    $id = implode($id, ',');
                }
                M($this->table)->startTrans();
                $rows[] = M($this->table)->where(" `id` in ({$id})")->delete();
                if (!in_array(false, $rows, true)) {
                    M($this->table)->commit();
                    $this->success('删除成功');
                } else {
                    M($this->table)->rollback();
                    $this->error('网络故障');
                }
            } catch (Exception $e) {
                $this->error("预期之外的错误，错误ID号：".$e->getErrorID());
            }
        }
    }
}
