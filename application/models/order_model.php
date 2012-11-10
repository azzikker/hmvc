<?php
  class order_model extends CI_Model
  {   
      //display
      function displayOrders($tableX) {
          $sql = $this->db->get($tableX);
          return $sql->result();
      }
      function displaySelected($tableX, $tableY, $deal_where) {
        $this->db->select('*');
        $this->db->from($tableX);
        $this->db->join($tableY, $tableY . ".customer_id = " . $tableX . ".customer_id");
        $this->db->where($deal_where);
        $this->db->order_by($tableX . ".order_date","desc");
        $sql = $this->db->get();
        return $sql->result();
      }
      function displaySelectedLike($tableX, $tableY, $deal_where, $field, $like) {
        $this->db->select('*');
        $this->db->from($tableX);
        $this->db->join($tableY, $tableY . ".customer_id = " . $tableX . ".customer_id");
        $this->db->where($deal_where);
        $this->db->order_by($tableX . ".order_date","desc");
        $this->db->like($field, $like); 
        $sql = $this->db->get();
        return $sql->result();
      }
      function displaySelectedDate($tableX, $tableY, $order_date, $deal_where) {
        $this->db->select('*');
        $this->db->from($tableX);
        $this->db->join($tableY, $tableY . ".customer_id = " . $tableX . ".customer_id");
        $this->db->where($deal_where);
        $this->db->where($tableX . ".order_date <=" . $order_date);
        $this->db->order_by($tableX . ".order_date","desc");
        $sql = $this->db->get();
        return $sql->result();
      }
      function displaySelectedDateLike($tableX, $tableY, $order_date, $deal_where, $field, $like) {
        $this->db->select('*');
        $this->db->from($tableX);
        $this->db->join($tableY, $tableY . ".customer_id = " . $tableX . ".customer_id");
        $this->db->where($deal_where);
        $this->db->where($tableX . ".order_date <=" . $order_date);
        $this->db->order_by($tableX . ".order_date","desc");
        $this->db->like($field, $like);
        $sql = $this->db->get();
        return $sql->result();
      }
      function displaySelectedFull($tableX, $tableY, $table1, $table2, $table3, $deal_where) {
        $this->db->select('*');
        $this->db->from($tableX);
        $this->db->join($tableY, $tableY . ".customer_id = " . $tableX . ".customer_id");
        $this->db->join($table2, $table2 . ".deal_id = " . $tableX . ".deal_id");
        $this->db->join($table1, $table1 . ".deal_hash = " . $table2 . ".deal_hash");
        $this->db->join($table3, $table3 . ".company_id = " . $table1 . ".company_id");
        $this->db->where($deal_where);
        $this->db->order_by($tableX . ".order_date","desc");
        $sql = $this->db->get();
        return $sql->result();
      }
      function displaySelectedFullAvailable($tableX, $tableY, $table1, $table2, $table3, $deal_where) {
        $this->db->select('*');
        $this->db->from($tableX);
        $this->db->join($tableY, $tableY . ".customer_id = " . $tableX . ".customer_id");
        $this->db->where($deal_where);
        $this->db->where($tableX . ".order_status !=", "pending");
        $this->db->order_by($tableX . ".order_date","desc");
        $this->db->order_by($tableY . ".customer_lastname","asc"); 
        $sql = $this->db->get();
        return $sql->result();
      }
      function displaySelectedOrders($tableX, $deal_where) {
          $this->db->select('*');
          $this->db->select_sum('order_total_price');
          $this->db->from($tableX);
          $this->db->join("deals","deals.deal_id = orders.deal_id");    
          $this->db->join("deal_view","deal_view.deal_hash = deals.deal_hash");    
          $this->db->where($deal_where);
          $sql = $this->db->get();      
          return $sql->result();
      }
      function displaySelectedMainBased($table1, $table3, $deal_where, $where_start, $where_end) { 
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table3, $table3 . ".deal_hash = " . $table1 . ".deal_hash");                                   
        $this->db->where($deal_where); 
        $sql = $this->db->get();
        return $sql->result();
      }
      
      //process
      function update_order($tableX, $order_where, $order_list) {
        $this->db->where($order_where);
        $sql = $this->db->update($tableX, $order_list);
    }
      
      //----------------------------------------------
      
      function select_data_order($vid)
      {
          $this->db->select("orders.order_date,deal_gallery.gallery_filename,deals.deal_title,deals.deal_statement, orders.order_id,orders.voucher_no, orders.order_hash,deals.deal_hash,deal_view.deal_view_end,deal_view.deal_view_start,orders.order_txn");
          $this->db->from("orders");
          $this->db->join("deals","deals.deal_id = orders.deal_id");
          $this->db->join("deal_view","deal_view.deal_hash = deals.deal_hash");
          $this->db->join("deal_gallery","deal_gallery.deal_subhash = deals.deal_subhash");
          /*under construction*/$this->db->where("deal_gallery.gallery_main > 0");
          $this->db->where("orders.customer_id",$vid);
          $this->db->where("orders.order_show = 1");
          //$this->db->where("orders.order_date >",time());
          $this->db->order_by("orders.order_date","desc");
          $query = $this->db->get();
          return $query;
      }
      function select_data_order22($vid)
      {
          $this->db->select("orders.order_date,deal_gallery.gallery_filename,deals.deal_title,deals.deal_statement, orders.order_id,orders.voucher_no, orders.order_hash,deals.deal_hash,deal_view.deal_view_end,deal_view.deal_view_start,orders.order_txn");
          $this->db->from("orders");
          $this->db->join("deals","deals.deal_id = orders.deal_id");
          $this->db->join("deal_view","deal_view.deal_hash = deals.deal_hash");
          $this->db->join("deal_gallery","deal_gallery.deal_subhash = deals.deal_subhash");
          /*under construction*/$this->db->where("deal_gallery.gallery_main > 0");
          $this->db->where("orders.customer_id",$vid);
          $this->db->where("orders.order_show = 1");
          $this->db->where("orders.order_status = 'pending'");
          $this->db->where("orders.order_date >",time());
          $this->db->order_by("orders.order_date","desc");
          $query = $this->db->get();
          return $query;
      }
      function select_data_order33($vid)
      {
          $this->db->select("orders.order_date,deal_gallery.gallery_filename,deals.deal_title,deals.deal_statement, orders.order_id,orders.voucher_no, orders.order_hash,deals.deal_hash,deal_view.deal_view_end,deal_view.deal_view_start,orders.order_txn");
          $this->db->from("orders");
          $this->db->join("deals","deals.deal_id = orders.deal_id");
          $this->db->join("deal_view","deal_view.deal_hash = deals.deal_hash");
          $this->db->join("deal_gallery","deal_gallery.deal_subhash = deals.deal_subhash");
          /*under construction*/$this->db->where("deal_gallery.gallery_main > 0");
          $this->db->where("orders.customer_id",$vid);
          $this->db->where("orders.order_show = 1");
          $this->db->where("orders.order_status = 'pending'");
          $this->db->where("orders.order_date <",time());
          $this->db->order_by("orders.order_date","desc");
          $query = $this->db->get();
          return $query;
      }
      function select_data_order44($vid)
      {
          $this->db->select("orders.order_date,deal_gallery.gallery_filename,deals.deal_title,deals.deal_statement, orders.order_id,orders.voucher_no, orders.order_hash,deals.deal_hash,deal_view.deal_view_end,deal_view.deal_view_start,orders.order_txn");
          $this->db->from("orders");
          $this->db->join("deals","deals.deal_id = orders.deal_id");
          $this->db->join("deal_view","deal_view.deal_hash = deals.deal_hash");
          $this->db->join("deal_gallery","deal_gallery.deal_subhash = deals.deal_subhash");
          /*under construction*/$this->db->where("deal_gallery.gallery_main > 0");
          $this->db->where("orders.customer_id",$vid);
          $this->db->where("orders.order_show = 1");
          $this->db->where("orders.order_status = 'available'");
          $this->db->order_by("orders.order_date","desc");
          $query = $this->db->get();
          return $query;
      }
      function select_data_order55($vid)
      {
          $this->db->select("orders.order_date,deal_gallery.gallery_filename,deals.deal_title,deals.deal_statement, orders.order_id,orders.voucher_no, orders.order_hash,deals.deal_hash,deal_view.deal_view_end,deal_view.deal_view_start,orders.order_txn");
          $this->db->from("orders");
          $this->db->join("deals","deals.deal_id = orders.deal_id");
          $this->db->join("deal_view","deal_view.deal_hash = deals.deal_hash");
          $this->db->join("deal_gallery","deal_gallery.deal_subhash = deals.deal_subhash");
          /*under construction*/$this->db->where("deal_gallery.gallery_main > 0");
          $this->db->where("orders.customer_id",$vid);
          $this->db->where("orders.order_show = 1");
          $this->db->where("orders.order_status = 'used'");
          $this->db->order_by("orders.order_date","desc");
          $query = $this->db->get();
          return $query;
      }
      function select_data_order_pagination($vid,$cnt,$page)
      {
          $this->db->select("orders.order_date,deal_gallery.gallery_filename,deals.deal_title,deals.deal_statement, orders.order_id,orders.voucher_no, orders.order_hash,deals.deal_hash,deal_view.deal_view_end,deal_view.deal_view_start,orders.order_status,orders.order_txn");
          $this->db->from("orders");
          $this->db->join("deals","deals.deal_id = orders.deal_id");
          $this->db->join("deal_view","deal_view.deal_hash = deals.deal_hash");
          $this->db->join("deal_gallery","deal_gallery.deal_subhash = deals.deal_subhash");
          /*under construction*/$this->db->where("deal_gallery.gallery_main > 0");
          $this->db->where("orders.customer_id",$vid);
          $this->db->where("orders.order_show = 1");
          //$this->db->where("orders.order_date >",time());
          $this->db->order_by("orders.order_date","desc");
          $this->db->limit($cnt,$page);
          $query = $this->db->get();
          return $query;
      }
      function select_data_order_pagination2($vid,$cnt,$page)
      {
          $this->db->select("orders.order_date,deal_gallery.gallery_filename,deals.deal_title,deals.deal_statement, orders.order_id,orders.voucher_no, orders.order_hash,deals.deal_hash,deal_view.deal_view_end,deal_view.deal_view_start,orders.order_status,orders.order_txn");
          $this->db->from("orders");
          $this->db->join("deals","deals.deal_id = orders.deal_id");
          $this->db->join("deal_view","deal_view.deal_hash = deals.deal_hash");
          $this->db->join("deal_gallery","deal_gallery.deal_subhash = deals.deal_subhash");
          /*under construction*/$this->db->where("deal_gallery.gallery_main > 0");
          $this->db->where("orders.customer_id",$vid);
          $this->db->where("orders.order_show = 1");
          $this->db->where("orders.order_status = 'pending'");
          $this->db->where("orders.order_date >",time());
          $this->db->order_by("orders.order_date","desc");
          $this->db->limit($cnt,$page);
          $query = $this->db->get();
          return $query;
      }
      function select_data_order_pagination3($vid,$cnt,$page)
      {
          $this->db->select("orders.order_date,deal_gallery.gallery_filename,deals.deal_title,deals.deal_statement, orders.order_id,orders.voucher_no, orders.order_hash,deals.deal_hash,deal_view.deal_view_end,deal_view.deal_view_start,orders.order_status,orders.order_txn");
          $this->db->from("orders");
          $this->db->join("deals","deals.deal_id = orders.deal_id");
          $this->db->join("deal_view","deal_view.deal_hash = deals.deal_hash");
          $this->db->join("deal_gallery","deal_gallery.deal_subhash = deals.deal_subhash");
          /*under construction*/$this->db->where("deal_gallery.gallery_main > 0");
          $this->db->where("orders.customer_id",$vid);
          $this->db->where("orders.order_show = 1");
          $this->db->where("orders.order_status = 'pending'");
          $this->db->where("orders.order_date <",time());
          $this->db->order_by("orders.order_date","desc");
          $this->db->limit($cnt,$page);
          $query = $this->db->get();
          return $query;
      }
      function select_data_order_pagination4($vid,$cnt,$page)
      {
          $this->db->select("orders.order_date,deal_gallery.gallery_filename,deals.deal_title,deals.deal_statement, orders.order_id,orders.voucher_no, orders.order_hash,deals.deal_hash,deal_view.deal_view_end,deal_view.deal_view_start,orders.order_status,orders.order_txn");
          $this->db->from("orders");
          $this->db->join("deals","deals.deal_id = orders.deal_id");
          $this->db->join("deal_view","deal_view.deal_hash = deals.deal_hash");
          $this->db->join("deal_gallery","deal_gallery.deal_subhash = deals.deal_subhash");
          /*under construction*/$this->db->where("deal_gallery.gallery_main > 0");
          $this->db->where("orders.customer_id",$vid);
          $this->db->where("orders.order_show = 1");
          $this->db->where("orders.order_status = 'available'");
          $this->db->order_by("orders.order_date","desc");
          $this->db->limit($cnt,$page);
          $query = $this->db->get();
          return $query;
      }
      function select_data_order_pagination5($vid,$cnt,$page)
      {
          $this->db->select("orders.order_date,deal_gallery.gallery_filename,deals.deal_title,deals.deal_statement, orders.order_id,orders.voucher_no, orders.order_hash,deals.deal_hash,deal_view.deal_view_end,deal_view.deal_view_start,orders.order_status,orders.order_txn");
          $this->db->from("orders");
          $this->db->join("deals","deals.deal_id = orders.deal_id");
          $this->db->join("deal_view","deal_view.deal_hash = deals.deal_hash");
          $this->db->join("deal_gallery","deal_gallery.deal_subhash = deals.deal_subhash");
          /*under construction*/$this->db->where("deal_gallery.gallery_main > 0");
          $this->db->where("orders.customer_id",$vid);
          $this->db->where("orders.order_show = 1");
          $this->db->where("orders.order_status = 'used'");
          $this->db->order_by("orders.order_date","desc");
          $this->db->limit($cnt,$page);
          $query = $this->db->get();
          return $query;
      }
      function select_data_order2($did)
      {
          $this->db->where("deal_id",$did);
          $query = $this->db->get("orders");
          return $query;
      }
      function select_data_order3($vn)
      {
          $this->db->select("deals.deal_title,companies.company_name,orders.voucher_no,orders.order_date,deal_gallery.gallery_filename,orders.deal_id,orders.location_id");
          $this->db->from("orders");
          $this->db->join("deals","deals.deal_id = orders.deal_id");
          $this->db->join("deal_gallery","deal_gallery.deal_subhash = deals.deal_subhash");
          $this->db->join("deal_view","deal_view.deal_hash = deals.deal_hash");
          $this->db->join("companies","companies.company_id = deal_view.company_id");
          $this->db->where("orders.voucher_no",$vn);
          $query = $this->db->get();
          return $query;
      }
      function select_data_order4($cid,$oid)
      {
          $this->db->where("order_id",$oid);
          $this->db->where("customer_id",$cid);
          $this->db->where("order_date <",time());
          $this->db->where("order_status !=","available");
          $query = $this->db->get("orders");
          return $query;
      }
      function insert_data_order($data)
      {
          $this->db->insert("orders",$data);
      }
      function delete_data_order($oid)
      {
          $data['order_show'] = 0;
          $this->db->where("order_id",$oid);
          $this->db->update("orders",$data);
      }
      //new
      function get_where($where)
      {
          $query = $this->db->get_where("orders",$where);
          return $query;
      }
      function update($update,$where)
      {
          $this->db->where($where);
          $this->db->update("orders",$update);
      }
  }
?>