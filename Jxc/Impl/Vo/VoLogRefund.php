<?php
/**
 * Created by PhpStorm.
 * User: TinyZ
 * Date: 2016/10/26
 * Time: 22:29
 */

namespace Jxc\Impl\Vo;


use Jxc\Impl\Core\Vo;

/**
 * �˻���¼
 * Class VoLogRefund
 * @package Jxc\Impl\Vo
 */
class VoLogRefund extends Vo {
    public $id;
    public $pdt_id;     //  ����
    public $ct_id;      //  ������
    public $pdt_counts; //  ����
    public $pdt_price;  //  ����
    public $pdt_zk;     //  �ۿ�

    public function dataArray($fields = array()) {

    }

    public function convert() {

    }

}