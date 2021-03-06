<?php

namespace Jxc\Impl\Service;

use Jxc\Impl\Core\JxcConfig;
use Jxc\Impl\Core\JxcService;
use Jxc\Impl\Dao\OperatorDao;
use Jxc\Impl\Util\GameUtil;
use Jxc\Impl\Vo\VoOperator;

/**
 * 开放的接口
 */
final class PublicService extends JxcService {


    public function __construct() {
        parent::__construct();
    }

    public function w2Login($voOp, $request) {
        if ($verify = GameUtil::verifyRequestParams($request, array('record'))) {
            return array('status' => 'error', 'message' => 'Undefined field : ' . $verify);
        }
        return $this->login($voOp, $request['record']);
    }

    /**
     * 登录管理系统
     * @param VoOperator $voOp
     * @param $request
     * @return array
     */
    public function login($voOp, $request) {
        if ($verify = GameUtil::verifyRequestParams($request, array('account', 'psw'))) {
            return array('status' => 'error', 'message' => 'Undefined field : ' . $verify);
        }
        $voOperator = $this->operatorDao->selectByAccount($request['account']);
        if (!$voOperator) {
            return array('status' => 'error', 'message' => '账号或密码错误!');
        }
        if ($request['psw'] !== $voOperator->op_psw) {
            return array('status' => 'error', 'message' => '账号或密码错误!');
        }
        $_SESSION['op_id'] = $voOperator->op_id;
        $_SESSION['op_account'] = $voOperator->op_account;
        $_SESSION['op_name'] = $voOperator->op_name;
        $_SESSION['op_auth'] = $voOperator->op_auth;  //  TODO:   权限管理
        return array('status' => 'success');
    }

    public function logout($voOp, $request) {
        session_destroy();
    }

}