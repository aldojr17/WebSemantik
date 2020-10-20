<?php

class CategoryController{
    
    public function index(){
        $command = filter_input(INPUT_GET,'cmd');
        if(isset($command) && $command == 'del'){
            $cid = filter_input(INPUT_GET,'cid');
            if(isset($cid)){
                $sendData = array('id'=>$cid);
                $wsResponse = Utility::curl_post(ApiService::DELETE_CATEGORY_URL, $sendData);
                $deleteStatus = json_decode($wsResponse);
                if ($deleteStatus->status){
                    echo '<div class="panel panel-success">';
                    echo '<div class="panel-heading">Data successfully deleted</div>';
                    echo '</div>';
                }else{
                    echo '<div class="panel panel-danger">';
                    echo '<div class="panel-heading">Failed to delete data</div>';
                    echo '</div>';
                }
            }
        }

        $submitPressed = filter_input(INPUT_POST,'btnSubmit');
        if(isset($submitPressed)){
            $name = filter_input(INPUT_POST,'txtName');
            $sendData = array('name'=>$name);
            $wsResponse = Utility::curl_post(ApiService::ADD_CATEGORY_URL, $sendData);
            $inputStatus = json_decode($wsResponse);
            if($inputStatus->status){
                echo '<div class="panel panel-success">';
                echo '<div class="panel-heading">Data successfully added (Category : '.$name.')</div>';
                echo '</div>';
            }else{
                echo '<div class="panel panel-danger">';
                echo '<div class="panel-heading">Failed to add data</div>';
                echo '</div>';
            }
        }
        $wsResponse = Utility::curl_get(ApiService::ALL_CATEGORY_URL, array());
        $categories = json_decode($wsResponse);
        include_once 'pages/category_page.php';
    }
    
    public function update(){
        $cid = filter_input(INPUT_GET, 'cid');
        if(isset($cid)){
            $wsResponse = Utility::curl_get(ApiService::ALL_CATEGORY_URL, array());
            $categories = json_decode($wsResponse);
            $categoryKey = array_search($cid, array_column($categories, 'id'));
            $category = $categories[$categoryKey];
        }

        $submitPressed = filter_input(INPUT_POST,'btnSubmit');
        if(isset($submitPressed)){
            $name = filter_input(INPUT_POST,'txtName');
            $sendData = array('id'=>$category->id, 'name'=>$name);
            $wsResponse = Utility::curl_post(ApiService::UPDATE_CATEGORY_URL, $sendData);
            $updateStatus = json_decode($wsResponse);
            if ($updateStatus->status){
                header("location:index.php?menu=cat");
            }else{
                echo '<div class="panel panel-danger">';
                echo '<div class="panel-heading">Failed to update data</div>';
                echo '</div>';
            }
        }
        include_once 'pages/category_update_page.php';
    }
}
