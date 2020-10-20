<?php
include_once '../../entity/Category.php';
include_once '../../dao/CategoryDaoImpl.php';
include_once '../../util/PDOUtil.php';

header('content-type:application/json');

$name = filter_input(INPUT_POST, 'name');
$id = filter_input(INPUT_POST, 'id');
$jsonData = array();

if(isset($name) && !empty($name) && isset($id) && !empty($id)){
    $categoryDao = new CategoryDaoImpl();
    if($categoryDao->fetchSelectedCategoryData($id) == null){
        $jsonData['status'] = 2;
        $jsonData['message'] = "Invalid id to update";
    }else{
        $category = new Category();
        $category->setName($name);
        $category->setId($id);
        $response = $categoryDao->updateCategory($category);
        if($response != 0){
            $jsonData['status'] = 1;
            $jsonData['message'] = "Update data success";
        }else{
            $jsonData['status'] = 2;
            $jsonData['message'] = "Error update data";
        }
    }
}else{
    $jsonData['status'] = 0;
    $jsonData['message'] = "Missing name or id to update";
}

echo json_encode($jsonData);
