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
use Common\Controller\MakeController;

class NumberController extends AdminBaseController
{
	use MakeController;
	protected $config;
    public function __construct()
    {
        parent::__construct();
        $this->table = 'number';
        // $this->addTemplet = 'number/add';
        // $this->editTemplet = 'number/edit';
        $this->indexTemplet = 'Number/index';
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
            $list = M($this->table)
                ->where($where)
                ->limit(($page - 1) * $limit, $limit)
                ->order('status ASC,createtime DESC')
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
        } elseif (IS_GET) {
            $this->display($this->indexTemplet);
        }
    }
    //释放手机号
    public function release()
    {
    	if (IS_AJAX) {
    		try {
    			$id = I('post.id');
		        if (is_array($id)) {
		            $id = implode($id, ',');
		        }
		        $this->config = M('api')->where('isuse=1')->find();
		        $where['status'] = 0;
		        $where['createtime'] = array('lt',time() - $this->config['time']);
		        $rows = M($this->table)->where(" `id` in ({$id})")->where($where)->field('id,pkey')->select();
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
		        	M($this->table)->where($where)->save(array(
			        	'status'	=> 2
			        ));
		        }
		        $this->success('释放成功');
    		} catch (Exception $e) {
    			$this->error("预期之外的错误，错误ID号：".$e->getErrorID());
    		}
    	}
    }
    //释放手机号
    public function free($pkey)
    {
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
