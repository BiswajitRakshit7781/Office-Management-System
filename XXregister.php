<?php
    $emp_name = $_POST['name'];
    $email_id = $_POST['email'];
    $address = $_POST['address'];
    $phone_no = $_POST['phone'];
    $date_of_join = $_POST['doj'];
    $password = $_POST['password'];

    $conn = new mysqli('localhost,'oms_database','','employee');
    if(($conn->connect_error){
        die("Connection Failed : ". $conn->connect_error);
    }else{
        $stmt = $conn->prepare("insert into registration(name,email,address,phone,doj,password) values(?,?,?,?,?,?)");
        $stmt -> bind_param("sssids",$emp_name,$email_id,$address,$phone_no,$date_of_join,$password);
        $stmt->execute();
        echo "Successfully Registered";
        $stmt->close();
        $conn->close();
?>