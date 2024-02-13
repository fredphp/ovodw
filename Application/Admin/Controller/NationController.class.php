<?php

namespace Admin\Controller;

use Common\Controller\AdminBaseController;
use Common\Controller\MakeController;

class NationController extends AdminBaseController
{
    use MakeController;
    public function __construct()
    {
        parent::__construct();
        $this->table = 'nation';
        $this->indexTemplet = 'Nation/index';
        $this->addTemplet = 'Nation/add';
        $this->editTemplet = 'Nation/edit';
        $this->whereList = [];
    }
    public function index(){
        if(IS_AJAX){
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
            $list = M($this->table)
                ->where($where)
                ->limit(($page - 1) * $limit, $limit)
                ->order('isdefault DESC,number DESC')
                ->select();
            $count = M($this->table)->where($where)->count();
            $res = array(
                'code' => 0
                , 'count' => $count
                , 'msg' => ''
                , 'data' => $list
            );
            $this->ajaxReturn($res);
        }
        $this->display($this->indexTemplet);
    }

    public function setDefult() {
        if (IS_POST) {
            $id = I('post.id');
            $row = M($this->table)->where("number=".$id)->find();
            if (!$row) {
                $this->error("数据不存在，请刷新后重试～");
            }
            $type = I('post.type');
            if ($type == 'status') {
                $status = 0;
                if ($row[status] == 0) {
                    $status = 1;
                }
                $r = M($this->table)->where("number=".$id)->save(array(
                    'status' => $status
                ));
            } else {
                M($this->table)->where("isdefault=1")->save(array(
                    'isdefault' => 0,
                ));
                M($this->table)->where("number=".$id)->save(array(
                    'isdefault' => 1,
                ));
            }
                        
            $this->success('设置成功');
        }
    }
    public  function add() {
        if (IS_AJAX) {
            $data = [];
            parse_str($_POST['para'], $data);
            $data = I('data.', '', C('DEFAULT_FILTER'), $data);
            foreach ($data as $k => $v) {
                if (is_array($v)) {
                    $data[$k] = implode($v, ',');
                }
            }
            if ($data['isdefault'] == '1') {
                //同时将已设置为默认的置为0
                M($this->table)->where("isdefault=1")->save(array(
                    'isdefault'    => 0
                ));
            }
            $row = M($this->table)->add($data);
            $row === false ? $this->error('网络故障') : $row === 0 ?
                    $this->error('数据无改动', 'nojump', IS_AJAX, 2) : $this->success('操作成功');
        } elseif (IS_GET) {
            $this->display($this->addTemplet);
        }
    }
    public function edit()
    {
        if (IS_GET) {
            // $info = M($this->table)->getByid(I('get.id'));
            $id = I('get.id');
            $info = M($this->table)->where('number='.$id)->find();
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
                if ($data['isdefault'] == 1) {
                    M($this->table)->where('isdefault=1')->save(array(
                        'isdefault' => 0
                    ));
                }
                $row = M($this->table)->save($data);
                $row === false ? $this->error('网络故障') : $row === 0 ?
                    $this->error('数据无改动', 'nojump', IS_AJAX, 2) : $this->success('操作成功');
            } catch (Exception $e) {
                $this->error("预期之外的错误，错误ID号：".$e->getErrorID());
            }
        }
    }
    public function delete() {
        if (IS_AJAX) {
            try {
                $id = I('post.id');
                if (is_array($id)) {
                    $id = implode($id, ',');
                }
                M($this->table)->startTrans();
                $rows[] = M($this->table)->where(" `number` in ({$id})")->delete();
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
