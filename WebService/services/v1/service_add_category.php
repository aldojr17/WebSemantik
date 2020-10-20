<?php
include_once '../../entity/Category.php';
include_once '../../dao/CategoryDaoImpl.php';
include_once '../../util/PDOUtil.php';

header('content-type:application/json');

$name = filter_input(INPUT_POST, 'name');
$jsonData = array();

if(isset($name) && !empty($name)){
    $categoryDao = new CategoryDaoImpl();
    $category = new Category();
    $category->setName($name);
    $response = $categoryDao->addCategory($category);
    if($response){
        $jsonData['status'] = 1;
        $jsonData['message'] = "Add category success";
    }else{
        $jsonData['status'] = 2;
        $jsonData['message'] = "Error add category";
    }
}else{
    $jsonData['status'] = 0;
    $jsonData['message'] = "Missing name for category";
}

echo json_encode($jsonData);
