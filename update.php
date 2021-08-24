<?php

// Include config file
require_once "config.php";

$title = $address = $description = $slug;
$title_err = $address_err = $description_err = $slug_err;

// processing from data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST['id'];


    // Validate name
    $input_title = trim($_POST['title']);
    if(empty($input_title)){
        $title_err = "please enter a Title";
    }elseif(!filter_var())
}


?>