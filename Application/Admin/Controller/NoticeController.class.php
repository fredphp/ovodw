<?php
/**
 * Created by Makecode
 * User: Xiny https://xbug.top i@xiny9.com
 * Coding Standard: PSR2
 * Date: 2020-07-07
 * Time: 22:25
 */

namespace Admin\Controller;

use Common\Controller\AdminBaseController;
use Common\Controller\MakeController;

class NoticeController extends AdminBaseController
{
    use MakeController;

    public function __construct()
    {
        parent::__construct();
        $this->table = 'notice';
        $this->addTemplet = 'Notice/add';
        $this->editTemplet = 'Notice/edit';
        $this->indexTemplet = 'Notice/index';
        $this->whereList = [];
    }
}
