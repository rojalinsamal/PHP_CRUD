<?php

require_once ("db.php");
require_once ("component.php");

$con = Createdb();
date_default_timezone_set('Asia/Kolkata');
// create button click
if(isset($_POST['create'])){
    createData();
}

if(isset($_POST['update'])){
    UpdateData();
}

if(isset($_POST['delete'])){
    deleteRecord();
}


function createData(){
    $productname = textboxValue("product_name");
    $productdesc = textboxValue("product_desc");
    $productprice = textboxValue("product_price");

    if($productname && $productdesc && $productprice){
        
        $time=date('Y-m-d H:i:s');

        $sql = "INSERT INTO products (product_name, product_desc, product_price, product_created_at) 
                VALUES ('$productname','$productdesc','$productprice', '$time')";

        if(mysqli_query($GLOBALS['con'],$sql)){
            TextNode("success", "Record Successfully Inserted...!");
        }else{
            echo "Error",mysqli_error($GLOBALS['con']);
        }

    }else{
            TextNode("error", "Provide Data in the Textbox");
    }
}

function textboxValue($value){
    $textbox = mysqli_real_escape_string($GLOBALS['con'], trim($_POST[$value]));
    if(empty($textbox)){
        return false;
    }else{
        return $textbox;
    }
}


// messages
function TextNode($classname, $msg){
    $element = "<h6 class='$classname'>$msg</h6>";
    echo $element;
}


// get data from mysql database
function getData(){
    $sql = "SELECT * FROM products";
        $result = mysqli_query($GLOBALS['con'], $sql);
        if(mysqli_num_rows($result) > 0){
        return $result;
    }
}

// update dat
function UpdateData(){
    $productid = textboxValue("product_id");
    $productname = textboxValue("product_name");
    $productdesc = textboxValue("product_desc");
    $productprice = textboxValue("product_price");

    if($productname && $productdesc && $productprice){
        $timestamp=date('Y-m-d H:i:s');
        $sql = "
                    UPDATE products SET product_name='$productname', product_desc = '$productdesc', product_price = '$productprice', product_updated_at = '$timestamp' WHERE id='$productid';                    
        ";

        if(mysqli_query($GLOBALS['con'], $sql)){
            TextNode("success", "Data Successfully Updated");
        }else{
            TextNode("error", "Enable to Update Data");
        }

    }else{
        TextNode("error", "Select Data Using Edit Icon");
    }


}


function deleteRecord(){
    $productid = (int)textboxValue("product_id");

    $sql = "DELETE FROM products WHERE id=$productid";

    if(mysqli_query($GLOBALS['con'], $sql)){
        TextNode("success","Record Deleted Successfully...!");
    }else{
        TextNode("error","Enable to Delete Record...!");
    }

}


// set id to textbox
function setID(){
    $getid = getData();
    $id = 0;
    if($getid){
        while ($row = mysqli_fetch_assoc($getid)){
            $id = $row['id'];
        }
    }
    return ($id + 1);
}








 