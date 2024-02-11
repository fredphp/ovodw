<?php
/**
 * Created by Makecode
 * User: Xiny https://xbug.top i@xiny9.com
 * Coding Standard: PSR2
 * Date: 2022-11-16
 * Time: 11:13
 */

namespace Admin\Controller;

use Common\Controller\AdminBaseController;

class ConfigController extends AdminBaseController
{
	public function index()
	{
        if (IS_POST) {
            $data = $_POST;
            foreach ($data as $key => $val) {
                M('config')->where('name="'.$key.'"')->save(['value' => $val]);
            }
            $arr['code'] = 0;
            $arr['msg'] = '提交成功';
            $this->ajaxReturn($arr);
        }

		$list = M('config')->field('id,name,title,tip,value')->order('id asc')->select();

		$this->assign('list',$list);
        $this->display();
	}

    /**
     * 添加配置参数
     * 
     */
    public function add()
    {
        if (IS_POST) {
            $data = $_POST;
            $row = M('config')->where('name="'.$data['name'].'"')->find();
            if ($row) {
                $arr['code'] = 1;
                $arr['msg'] = '变量已设置';
                $this->ajaxReturn($arr);
            }
            $res = M('config')->add($data);
            if ($res) {
                $arr['code'] = 0;
                $arr['msg'] = '添加成功';
                $this->ajaxReturn($arr);
            }
            $arr['code'] = 1;
            $arr['msg'] = '添加失败';
            $this->ajaxReturn($arr);
        }
    }
    /**
     * 删除配置
     * 
     */
    public function del()
    {
        if (IS_POST) {
            $data = $_POST;
            $row = M('config')->where('name="'.$data['name'].'"')->find();
            if (!$row) {
                $arr['code'] = 1;
                $arr['msg'] = '配置不存在或已删除';
                $this->ajaxReturn($arr);
            }
            $res = M('config')->where('name="'.$data['name'].'"')->delete();
            if ($res) {
                $arr['code'] = 0;
                $arr['msg'] = '操作成功';
                $this->ajaxReturn($arr);
            }
            $arr['code'] = 1;
            $arr['msg'] = '操作失败';
            $this->ajaxReturn($arr);
        }
    }

}
