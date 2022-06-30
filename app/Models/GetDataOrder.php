<?php

namespace App\Models;

use CodeIgniter\Database\Query;
use CodeIgniter\Model;

class GetDataOrder extends Model
{
    public function get_order($check)
    {
        $db = db_connect();
        $get_order = $db->query("SELECT `order`.ID,user.Name AS username,`order`.iduser,course.Name FROM user,`order`,course where course.ID = `order`.idcourse AND user.ID = `order`.iduser AND `order`.status = '".$check."' ");
        return $get_order->getResultArray();
    }
    public function update_order($idorder,$status)
    {
        $db = db_connect();
        $db->query("UPDATE `order` SET status = '".$status."' where ID = '".$idorder."' ");
    }
    public function get_accept($iduser,$idcourse)
    {
        $db = db_connect();
        $check = $db->query("SELECT count(id) as id from `order` where iduser = '".$iduser."' AND idcourse = '".$idcourse."' AND status = 2");
        return $check->getResultArray();
    }
    public function get_lesson($idcourse)
    {
        $db = db_connect();
        $check = $db->query("SELECT lesson.Title,lesson.Content from course,lesson where lesson.idcourse = course.ID AND course.ID = '".$idcourse."'");
        return $check->getResultArray();
    }
    public function insert_order($iduser,$idcourse)
    {
        $db = db_connect();
        $db->query("INSERT INTO `order` Value (null,'$idcourse','$iduser',0) ");
    }
    public function check_order($idcourse,$iduser)
    {
        $db = db_connect();
        $check_order = $db->query("SELECT COUNT(ID) AS amount FROM `order` where iduser = '".$iduser."' AND idcourse = '".$idcourse."' AND status = 0");
        return $check_order->getResultArray();
    }
    public function history_order($iduser)
    {
        $db = db_connect();
        $get_order = $db->query("SELECT course.Avatar,course.Name,course.Title,course.Price,`order`.status  FROM `order`,course where `order`.idcourse = course.ID AND iduser = '".$iduser."'");
        return $get_order->getResultArray();
    }
}