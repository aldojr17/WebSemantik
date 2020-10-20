<?php
include_once '../../entity/Category.php';
include_once '../../dao/CategoryDaoImpl.php';
include_once '../../util/PDOUtil.php';

header('content-type:application/json');

$id = filter_input(INPUT_POST, 'id');
$jsonData = array();

if(isset($id) && !empty($id)){
    $categoryDao = new CategoryDaoImpl();
    if($categoryDao->fetchSelectedCategoryData($id) == null){
        $jsonData['status'] = 2;
        $jsonData['message'] = "Invalid id to delete";
    }else{
        $response = $categoryDao->deleteCategory($id);
        if($response){
            $jsonData['status'] = 1;
            $jsonData['message'] = "Delete category success";
        }else{
            $jsonData['status'] = 2;
            $jsonData['message'] = "Error Delete category";
        }
    }
}else{
    $jsonData['status'] = 0;
    $jsonData['message'] = "Missing id to delete";
}

echo json_encode($jsonData);
