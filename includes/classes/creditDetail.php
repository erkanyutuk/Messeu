<?php
class CreditDetail{
    private $details;
    private $con;

    public function __construct($con,$credit_id){
        $this->con=$con;
        $credit_details_query=mysqli_query($con,"SELECT dates,status FROM creditdetails WHERE credit_id='$credit_id'");
        $this->details=mysqli_fetch_array($credit_details_query);
    }


    public function getData(){
        return $this->details;        
    }
}

/*foreach($details as $detail){
            $d1=date('Y-m-d');
            $d2=$this->detail['dates'];
            $date1=new DateTime($d1);
            $date2=new DateTime($d2);

            $interval = $date1->diff($date2);

            if($this->detail['status']==1 &&  $date1-$date2<30){
                $payday=false;
            }else{
                if($this->detail['status']==0 &&  $date1>=$date2){
                    $payday=true;
                }
            }
        }