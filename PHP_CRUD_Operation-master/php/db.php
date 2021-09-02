<?php

function Createdb(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "onlinestore";

    // create connection
    $con = mysqli_connect($servername, $username, $password);



    // Check Connection
    if (!$con){
        die("Connection Failed : " . mysqli_connect_error());
    }

    // create Database
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";

    if(mysqli_query($con, $sql)){
        $con = mysqli_connect($servername, $username, $password, $dbname);

        $sql = "
                        CREATE TABLE IF NOT EXISTS products(
                            id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                            product_name VARCHAR (25) NOT NULL,
                            product_desc VARCHAR (50),
                            product_price FLOAT ,
                            product_created_at VARCHAR(20),
                            product_updated_at VARCHAR(20)
                        );
        ";

        if(mysqli_query($con, $sql)){
            return $con;
        }else{
            echo "Cannot Create table...!".mysqli_error($con);
        }

    }else{
        echo "Error while creating database ". mysqli_error($con);
    }

}
