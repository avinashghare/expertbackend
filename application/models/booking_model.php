<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class booking_model extends CI_Model
{
    public function create($fromuser,$touser,$date,$starttime,$endtime,$status)
    {
        $data=array("fromuser" => $fromuser,"touser" => $touser,"date" => $date,"starttime" => $starttime,"endtime" => $endtime,"status" => $status);
        $query=$this->db->insert( "expert_booking", $data );
        $id=$this->db->insert_id();
        if(!$query)
        return  0;
        else
        return  $id;
    }
    public function beforeedit($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("expert_booking")->row();
        return $query;
    }
    function getsinglebooking($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("expert_booking")->row();
        return $query;
    }
    public function edit($id,$fromuser,$touser,$date,$starttime,$endtime,$status)
    {
        $data=array("fromuser" => $fromuser,"touser" => $touser,"date" => $date,"starttime" => $starttime,"endtime" => $endtime,"status" => $status);
        $this->db->where( "id", $id );
        $query=$this->db->update( "expert_booking", $data );
        return 1;
    }
    public function delete($id)
    {
        $query=$this->db->query("DELETE FROM `expert_booking` WHERE `id`='$id'");
        return $query;
    }
}
?>
