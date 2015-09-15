<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class transaction_model extends CI_Model
{
    public function createusertoadmin($fromuser,$touser,$amount,$type,$remark)
    {
        $data=array(
            "fromuser" => $fromuser,
            "touser" => $touser,
            "amount" => $amount,
            "remark" => $remark,
            "type" => $type
        );
        $query=$this->db->insert( "expert_transaction", $data );
        $id=$this->db->insert_id();
        
        //all from user data
        $alluserdata=$this->db->query("SELECT * FROM `user` WHERE `id`='$fromuser'")->row();
        $wallet=$alluserdata->wallet;
        
        //all system amounts
        $allsystemamount=$this->db->query("SELECT * FROM `systemamount` WHERE `id`='1'")->row();
        $moneyreceived=$allsystemamount->moneyreceived;
        $moneybalance=$allsystemamount->moneybalance;
        
        $newmoneybalance=$moneybalance+$amount;
        $newmoneyreceived=$moneyreceived+$amount;
        $newwallet=$wallet+$amount;
        
        //insert in system
        $this->db->query("UPDATE `systemamount` SET `moneyreceived`='$newmoneyreceived',`moneybalance`='$newmoneybalance' WHERE `id`=1");
        //insert in user wallet
        $this->db->query("UPDATE `user` SET `wallet`='$newwallet' WHERE `id`='$fromuser'");
        
        return 1;
    }
    public function createusertouser($fromuser,$touser,$amount,$type,$remark)
    {
        
        $systempercentage=$this->db->query("SELECT * FROM `systempercantage` WHERE `id`=1")->row();
        $percentagevalue=$systempercentage->value;
        $percentagevalue=100-$percentagevalue;
        $percent=$percentagevalue/100;
        
        $userpercentage=$this->db->query("SELECT * FROM `systempercantage` WHERE `id`=1")->row();
        $userpercentagevalue=$userpercentage->value;
//        $userpercentagevalue=100-$userpercentagevalue;
        $userpercent=$userpercentagevalue/100;
        
        $alluserdata=$this->db->query("SELECT * FROM `user` WHERE `id`='$fromuser'")->row();
        $wallet=$alluserdata->wallet;
        
        $alltouserdata=$this->db->query("SELECT * FROM `user` WHERE `id`='$touser'")->row();
        $towallet=$alltouserdata->wallet;
        
        $allsystemamount=$this->db->query("SELECT * FROM `systemamount` WHERE `id`='1'")->row();
        $moneyreceived=$allsystemamount->moneyreceived;
        $moneypaid=$allsystemamount->moneypaid;
        $moneybalance=$allsystemamount->moneybalance;
        $adminmoney=$allsystemamount->adminmoney;
        
        $touserfinalamount=$userpercent*$amount;
        
        $data=array(
            "fromuser" => $fromuser,
            "touser" => $touser,
            "amount" => $touserfinalamount,
            "remark" => $remark,
            "type" => $type
        );
        $query=$this->db->insert( "expert_transaction", $data );
        
        
        
        $newfromwallet=$wallet-$amount;
        $queryupdatefromuserwallet=$this->db->query("UPDATE `user` SET `wallet`='$newfromwallet' WHERE `id`='$fromuser'");
        
        $touserfinalamount=$userpercent*$amount;
        $newtowallet=$towallet+$touserfinalamount;
        $queryupdatefromuserwallet=$this->db->query("UPDATE `user` SET `wallet`='$newtowallet' WHERE `id`='$touser'");
        
        $systemfinalamount=$percent*$amount;
//        $newtowallet=$towallet+$touserfinalamount;
//        $queryupdatefromuserwallet=$this->db->query("UPDATE `user` SET `wallet`='$newtowallet' WHERE `id`='$touser'");
        
        
        $data2=array(
            "fromuser" => $fromuser,
            "touser" => 0,
            "amount" => $systemfinalamount,
            "remark" => $remark,
            "type" => $type
        );
        $query=$this->db->insert( "expert_transaction", $data2 );
        $newmoneybalance=$moneybalance-$systemfinalamount;
        $newadminmoney=$adminmoney+$systemfinalamount;
        $queryggg=$this->db->query("UPDATE `systemamount` SET `moneybalance`='$newmoneybalance',`adminmoney`='$newadminmoney'");
        
    
        return 1;
    }
    public function createadmintouser($fromuser,$touser,$amount,$type,$remark)
    {
        
        $alltouserdata=$this->db->query("SELECT * FROM `user` WHERE `id`='$touser'")->row();
        $towallet=$alltouserdata->wallet;
        
        $allsystemamount=$this->db->query("SELECT * FROM `systemamount` WHERE `id`='1'")->row();
        $moneyreceived=$allsystemamount->moneyreceived;
        $moneypaid=$allsystemamount->moneypaid;
        $moneybalance=$allsystemamount->moneybalance;
        $adminmoney=$allsystemamount->adminmoney;
        
        $data=array(
            "fromuser" => 0,
            "touser" => $touser,
            "amount" => $amount,
            "remark" => $remark,
            "type" => $type
        );
        $query=$this->db->insert( "expert_transaction", $data );
        
        $newmoneypaid=$moneypaid+$amount;
        $newmoneybalance=$moneybalance-$amount;
        $updatesystemamount=$this->db->query("UPDATE `systemamount` SET `moneypaid`='$newmoneypaid',`moneybalance`='$newmoneybalance'");
        
        $newtowallet=$towallet-$amount;
        $queryupdate=$this->db->query("UPDATE `user` SET `wallet`='$newtowallet' WHERE `id`='$touser'");
            
            
    
        return 1;
    }
    public function create($fromuser,$touser,$amount,$type,$remark)
    {
            $data=array(
                "fromuser" => $fromuser,
                "touser" => $touser,
                "amount" => $amount,
                "remark" => $remark,
                "type" => $type
            );
            $query=$this->db->insert( "expert_transaction", $data );
            $id=$this->db->insert_id();
        
//        $systempercentage=$this->db->query("SELECT * FROM `systempercentage` WHERE `id`=1")->row();
//        $percentagevalue=$systempercentage->value;
//        $percent=$percentagevalue/100;
//        
//        $userpercentage=$this->db->query("SELECT * FROM `systempercentage` WHERE `id`=1")->row();
//        $userpercentagevalue=$userpercentage->value;
//        $userpercent=$userpercentagevalue/100;
//        
//        $alluserdata=$this->db->query("SELECT * FROM `user` WHERE `id`='$fromuser'")->row();
//        $wallet=$alluserdata->wallet;
//        
//        $alltouserdata=$this->db->query("SELECT * FROM `user` WHERE `id`='$touser'")->row();
//        $towallet=$alltouserdata->wallet;
//        
//        $allsystemamount=$this->db->query("SELECT * FROM `systemamount` WHERE `id`='1'")->row();
//        $moneyreceived=$allsystemamount->moneyreceived;
//        if($type==1)
//        {
//            
//            $data=array(
//                "fromuser" => $fromuser,
//                "touser" => $touser,
//                "amount" => $amount,
//                "remark" => $remark,
//                "type" => $type
//            );
//            $query=$this->db->insert( "expert_transaction", $data );
//            $id=$this->db->insert_id();
//        
//            
//            $newmoneyreceived=$moneyreceived+$amount;
//            $newwallet=$wallet+$amount;
//            //insert in system
//            $this->db->query("UPDATE `systemamount` SET `moneyreceived`='$newmoneyreceived' WHERE `id`=1");
//            //insert in user wallet
//            $this->db->query("UPDATE `user` SET `wallet`='$newwallet' WHERE `id`='$fromuser'");
//        }
//        else if($type==2)
//        {
//            $newwallet=$wallet-$amount;
//            $this->db->query("UPDATE `user` SET `wallet`='$newwallet' WHERE `id`='$fromuser'");
//            
//            $touseramount=$userpercent*$amount;
//            $data=array(
//                "fromuser" => $fromuser,
//                "touser" => $touser,
//                "amount" => $touseramount,
//                "remark" => $remark,
//                "type" => $type
//            );
//            $query=$this->db->insert( "expert_transaction", $data );
//            
//            
//            //insert in system
//            $newtowallet=$towallet+
//        }
        
        
        if(!$query)
        return  0;
        else
        return  $id;
    }
    public function beforeedit($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("expert_transaction")->row();
        return $query;
    }
    function getsingletransaction($id) 
    {
        $this->db->where("id",$id);
        $query=$this->db->get("expert_transaction")->row();
        return $query;
    }
    public function edit($id,$fromuser,$touser,$amount,$type,$remark)
    {
        $data=array("fromuser" => $fromuser,"touser" => $touser,"amount" => $amount,"remark" => $remark,"type" => $type);
        $this->db->where( "id", $id );
        $query=$this->db->update( "expert_transaction", $data );
        return 1;
    }
    public function delete($id)
    {
        $query=$this->db->query("DELETE FROM `expert_transaction` WHERE `id`='$id'");
        return $query;
    }
    
    public function gettransactiontypedropdown()
	{
		$query=$this->db->query("SELECT * FROM `transactiontype`  ORDER BY `id` ASC")->result();
		$return=array(
		);
		foreach($query as $row)
		{
			$return[$row->id]=$row->name;
		}
		
		return $return;
	}
    
    public function getsystemamount()
    {
        $query=$this->db->query("SELECT * FROM `systemamount`")->row();
        return $query;
    }
    public function getsystempercent()
    {
        $query=$this->db->query("SELECT * FROM `systempercantage`")->row();
        return $query;
    }
    
}
?>
