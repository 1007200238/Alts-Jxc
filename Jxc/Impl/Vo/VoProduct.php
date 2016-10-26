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
 * ��Ʒ�����Ϣ
 * Class VoProduct
 * @package Jxc\Impl\Vo
 */
class VoProduct extends Vo {
    public $id;
    public $pdt_id;         //  ��Ʒ
    public $pdt_name;       //  ��������
    public $pdt_color;      //  ��ɫ
    public $pdt_stock;  //  ���
    public $pdt_purchase;   //  ������

    public function toArray($fields = array()) {
        $map = parent::toArray($fields);
        $map['pdt_stock'] = implode("|", $this->pdt_stock);
        return $map;
    }


    public function convert($data) {
        parent::convert($data);
        $this->pdt_stock = explode("|", $this->pdt_stock);
    }
}