<?php

namespace Jxc\Impl\Service;

use Jxc\Impl\Core\JxcConfig;
use Jxc\Impl\Core\JxcService;
use Jxc\Impl\Dao\CustomerDao;
use Jxc\Impl\Libs\DateUtil;
use Jxc\Impl\Util\GameUtil;
use Jxc\Impl\Vo\VoCustomer;

class CustomService extends JxcService {

    private $customDao;

    public function __construct() {
        parent::__construct();
        $this->customDao = new CustomerDao(JxcConfig::$DB_Config);
    }

    /**
     * 获取顾客列表
     * @param $request
     * @return array
     */
    public function getCustomList($request) {
        return array('state' => 1, 'data' => $this->customDao->w2uiSelect());
    }


    public function getAllCustomerInfo($request) {
        $data = $this->customDao->select();
        $array = array();
        foreach ($data as $v) {
            $v->recid = $v->ct_id;
            $array[] = $v;
        }
        return array('status' => 'success', 'records' => $array);
    }

    public function saveCustomerInfo($request) {
        if ($verify = GameUtil::verifyRequestParams($request, array('changes'))) {
            return array('status' => 'error', 'msg' => 'Undefined field : ' . $verify);
        }
        $changes = $request['changes'];
        $aryId = array();
        foreach ($changes as $change) {
            $aryId[$change['recid']] = 1;
        }
        $ids = array_keys($aryId);
        $existMap = $this->customDao->selectById($ids);
        $updateAry = array();
        foreach ($changes as $change) {
            $id = $change['recid'];
            if (isset($existMap[$id])) {  //  update
                $voCustomer = $existMap[$id];
                if ($voCustomer instanceof VoCustomer) {
                    $voCustomer->convert($change);
                    $this->customDao->updateByFields($voCustomer, array_keys($change));
                    $voCustomer->recid = $voCustomer->ct_id;
                    $updateAry[] = $voCustomer;
                }
            } else {    //  insert
                $voCustomer = new VoCustomer();
                $voCustomer->convert($change);
                $voCustomer = $this->customDao->insert($voCustomer);
                $voCustomer->recid = $voCustomer->ct_id;
                $voCustomer->depId = $id;
                $updateAry[] = $voCustomer;
            }
        }
        return array('status' => 'success', 'updates' => $updateAry);
    }

    public function removeCustomerInfo($request) {
        if ($verify = GameUtil::verifyRequestParams($request, array('selected'))) {
            return array('status' => 'error', 'msg' => 'Undefined field : ' . $verify);
        }
        foreach ($request['selected'] as $pdt_id) {
            $this->customDao->delete($pdt_id);
        }
        return array('status' => 'success', 'deleted' => $request['selected']);
    }





}