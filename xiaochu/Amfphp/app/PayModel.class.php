<?php
/**
 * 发货表
 */
class PayModel{

    /**
     * 插入交易记录
     */
    public static function insert($parm){

        $data1 = array(

        );

        $db = new MMysql();
        $res = $db->insert('u_pay',$data1);

        return $res;
    }

}