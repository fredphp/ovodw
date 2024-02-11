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

class UsingController extends AdminBaseController
{
	public function index()
	{
        $file = APP_PATH . 'Common/Conf/extra.php';
        if (IS_POST) {
            $data = [];
            parse_str($_POST['para'], $data);
            $data = I('data.', '', C('DEFAULT_FILTER'), $data);
            foreach ($data as $k => $v) {
        
                // if (is_array($v)) {
                //    echo $data[$k] = implode($v, ',');
                //    echo $data[$k].','.$v."<br/>";
                // }
            }
            // var_dump($data);die();
            $res = arr2file($file, $data);
            $arr['code'] = 0;
            $arr['msg'] = '保存成功';
            if ($res === false) {
                $arr['code'] = 1;
                $arr['msg'] = '保存失败';
            }
            $this->ajaxReturn($arr);
        }
        $config = require_once $file;
        $this->assign('config',$config);
        $this->display();
	}
}
