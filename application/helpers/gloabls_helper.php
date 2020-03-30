<?php

function mobilemenu($section) {
    $ci = & get_instance();
    $ci->load->database();
    $ci->db->from('mobile_menu');
    $ci->db->where('mainsection', $section);
    $ci->db->order_by("orderby", "asc");
    $query = $ci->db->get();
    return $query->result();
}

function invociesCountByOpen() {
    $ci = & get_instance();
    $ci->load->database();
    $sql = "
            select * 
            from 
            orders o 
            join orders_prodvend opv 
            join projects_list p 
            where 
            opv.fk_orders_opd = o.id_order and
            p.id_project = o.fk_project and
            o.status_payment_order = 0
            group by o.id_order";
    $query = $ci->db->query($sql)->num_rows();
    return $query;
}

function invociesCountByClose() {
    $ci = & get_instance();
    $ci->load->database();
    $sql = "
            select * 
            from 
            orders o 
            join orders_prodvend opv 
            join projects_list p 
            where 
            opv.fk_orders_opd = o.id_order and
            p.id_project = o.fk_project and
            o.status_payment_order = 1
            group by o.id_order";
    $query = $ci->db->query($sql)->num_rows();
    return $query;
}

function projectCountByUnder() {
    $ci = & get_instance();
    $ci->load->database();
    $sql = "select * from projects_list where fk_status = '1'";
    $query = $ci->db->query($sql)->num_rows();
    return $query;
}

function projectCountByPending() {
    $ci = & get_instance();
    $ci->load->database();
    $sql = "select * from projects_list where fk_status = '0'";
    $query = $ci->db->query($sql)->num_rows();
    return $query;
}

function projectCountByCompleted() {
    $ci = & get_instance();
    $ci->load->database();
    $sql = "select * from projects_list where fk_status = '2'";
    $query = $ci->db->query($sql)->num_rows();
    return $query;
}

?>