<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title> -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script> -->
    <!-- <link rel="stylesheet" href="css/payroll.css"> -->
<!-- </head>
<body> -->
    <?php
    // session_start();
    @include_once 'config.php';
    class PayRoll{
        private $conn;
        public function __construct($conn) {
            $this->conn =$conn->getConnection();
        }
        public function getQuery($sql){
            $result=$this->conn->query($sql);
            if($result){
                $row=$result->fetch_assoc();
            }
            return $row;
        }
        public function DACalculation($basic){
            $da=$basic*0.7;
            return $da;
        }
        public function PfCalculation($basic,$da){
            $total3=$basic+$da;
            $pf=($total3*10)/100;
            return $pf;
        }
        public function HRACalculation($basic){
            $hra=($basic*15)/100;
            return $hra;
        }
        public function GrossSalary($basic,$da,$hra){
            $total1=$basic+$da+$hra;
            return $total1;
        }
        public function DeductionCalculation($days){
            $deduction=$days*20; 
            return $deduction;    //1 day leave= 20 rupees charge
        }
        public function NetSalary($gross,$pf,$deduction){
            $total2=$gross-$pf-$deduction;
            return $total2;
        }
      
    }
    $payroll=new PayRoll($db);
    $emp_id=$_SESSION['emp_id'];
    $query="SELECT `basic` FROM `employee` WHERE `emp_id`='$emp_id';";
    $BASIC=$payroll->getQuery($query);
    // $query2="SELECT `max_leave` FROM `leave_table` WHERE `emp_id`='$emp_id';";
    // $days_leave=$payroll->getQuery($query2);
    $query3="SELECT `emp_name` FROM `employee` WHERE `emp_id`='$emp_id';";
    $name=$payroll->getQuery($query3);
    $query4="SELECT COUNT(*) AS row_count FROM `attendance` WHERE `emp_id`='$emp_id' AND `status`='a';";
    $days_leave=$payroll->getQuery($query4);
    // $days_count=mysqli_num_rows($days_leave['emp_id']);
    $DA=$payroll->DACalculation($BASIC['basic']);
    $HRA=$payroll->HRACalculation($BASIC['basic']);
    $PF=$payroll->PfCalculation($BASIC['basic'],$DA);
    $GROSSSALARY=$payroll->GrossSalary($BASIC['basic'],$DA,$HRA);

    $DEDUCTION=$payroll->DeductionCalculation($days_leave['row_count']);
    
    $NETSALARY=$payroll->NetSalary($GROSSSALARY,$PF,$DEDUCTION);
    echo '<div class="container">
<table>
    <tr>
        <th>Basic</th>
        <td>'. $BASIC['basic'] .'</td>
    </tr>
    <tr>
        <th>DA</th>
        <td>'. $DA .'</td>
    </tr>
    <tr>
        <th>HRA</th>
        <td>'. $HRA .'</td>
    </tr>
    <tr>
        <th>PF</th>
        <td>'. $PF .'</td>
    </tr>
    <tr>
        <th>deductions</th>
        <td>'. $DEDUCTION .'</td>
    </tr>
    <tr>
        <th id="underline">Gross Salary</th>
        <td id="underline">'. $GROSSSALARY .'</td>
    </tr>
    <tr>
        <th>Net Salary</th>
        <td>'. $NETSALARY .'</td>
    </tr>
</table>
</div>';
    ?>
    <!-- <div class="button">
        <a href="entry.php">
            <button>Back</button>
        </a>
        </div>
    
</body>
</html> -->