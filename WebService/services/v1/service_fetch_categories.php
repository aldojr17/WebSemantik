<?php
include_once '../../entity/Category.php';
include_once '../../dao/CategoryDaoImpl.php';
include_once '../../util/PDOUtil.php';

header('content-type:application/json');

$categoryDao = new CategoryDaoImpl();
$categories = $categoryDao->fetchCategoryData();
echo json_encode($categories);
