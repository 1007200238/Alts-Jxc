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
 * ������-��Ա
 * Class VoCustomer
 * @package Jxc\Impl\Vo
 */
class VoCustomer extends Vo {

    public $ct_id;       //  �ͻ�ID
    public $ct_name;     //  �ͻ�����
    public $ct_address;  //  ͨ�ŵ�ַ
    public $ct_phone;    //  ��ϵ�绰
    public $ct_money;    //  Ԥ����   -   �ֶ���ֵ
    public $ct_debt;     //  Ƿ�� -   �Զ�����

}