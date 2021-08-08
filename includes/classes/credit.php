<?php
class Credit{
    private $con;
    
    public function __construct($con){
        $this->con=$con;
    }
    public function getAllCredits($start,$limit){
        $sql=$con->query("SELECT id,name,surname,phone,remaining_credit,min_payment FROM credit LIMIT $start, $limit");
        
        $count = mysqli_num_rows($sql);
        if( $count > 0){
            $response='';
            while($row=mysqli_fetch_array($sql)){
                $payday=false;
                $sid=$row["id"];
                $det=$con->query("SELECT dates,status FROM creditdetails WHERE credit_id='$sid'");
                if(mysqli_num_rows($det)){
                    while($data=mysqli_fetch_array($det)){
                        $d1=date('Y-m-d');
                        $d2=$data['dates'];
                        $date1=new DateTime($d1);
                        $date2=new DateTime($d2);

                        $interval = $date1->diff($date2);
                        if($data['status']==0 &&  $date1>=$date2){
                            $payday=true;
                        }
                    }
                }
 



            }
            exit($response);
        }else{
            exit('reachedMax');
        }
    }
}