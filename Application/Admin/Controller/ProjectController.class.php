<?php

namespace Admin\Controller;

use Common\Controller\AdminBaseController;
use Common\Controller\MakeController;

class ProjectController extends AdminBaseController
{
    use MakeController;
    public function __construct()
    {
        parent::__construct();
        $this->table = 'project';
        $this->indexTemplet = 'Project/index';
        $this->addTemplet = 'Project/add';
        $this->editTemplet = 'Project/edit';
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
                ->order('status DESC,id DESC')
                ->select();
            foreach ($list as &$v) {
                $v['createtime'] = date('Y-m-d H:i:s',$v['createtime']);
            }
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
            $row = M($this->table)->where("id=".$id)->field('id,type')->find();
            if (!$row) {
                $this->error("数据不存在，请刷新后重试～");
            }
            $dsave = M($this->table)->where("status=1 and type=".$row['type'])->save(array(
                        'status'    => 0
                    ));
            $r = M($this->table)->where("id=".$id)->save(array(
                'status' => 1
            ));
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
            if ($data['status'] == '1') {
                //同时将已设置为默认的置为0
                M($this->table)->where("status=1 and type=".$data['type'])->save(array(
                    'status'    => 0
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
                if ($data['status'] == '1') {
                    //同时将已设置为默认的置为0
                    M($this->table)->where("status=1 and type=".$data['type'])->save(array(
                        'status'    => 0
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
