<?php

class CategoryDaoImpl{
    
    public function fetchCategoryData(){
        $link = PDOUtil::createConnection();
        $query = "SELECT * FROM category";
        $result = $link->query($query);
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,'Category');
        PDOUtil::closeConnection($link);
        return $result->fetchAll();
    }
    
    public function fetchSelectedCategoryData($id){
        $link = PDOUtil::createConnection();
        $query = "SELECT * FROM category WHERE id = ?";
        $stmt = $link->prepare($query);
        $stmt->bindParam(1,$id);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        PDOUtil::closeConnection($link);
        return $stmt->fetchObject('Category');
    }

    public function addCategory(Category $category){
        $result = 0;
        $link = PDOUtil::createConnection();
        $query = 'INSERT INTO category(name) VALUES(?)';
        $stmt = $link->prepare($query);
        $stmt->bindValue(1,$category->getName());
        $link->beginTransaction();
        if ($stmt->execute()){
            $link->commit();
            $result = 1;
        }else{
            $link->rollBack();
        }
        PDOUtil::closeConnection($link);
        return $result;
    }
    
    public function updateCategory(Category $category){
        $result = 0;
        $link = PDOUtil::createConnection();
        $query = "UPDATE category SET name = ? WHERE id = ?";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1,$category->getName());
        $stmt->bindValue(2,$category->getId());
        $link->beginTransaction();
        if ($stmt->execute()){
            $link->commit();
            $result = 1;
        }else{
            $link->rollBack();
        }
        PDOUtil::closeConnection($link);
        return $result;
    }
    
    public function deleteCategory($id){
        $result = 0;
        $link = PDOUtil::createConnection();
        $query = "DELETE FROM category WHERE id = ?";
        $stmt = $link->prepare($query);
        $stmt->bindParam(1,$id);
        $link->beginTransaction();
        if($stmt->execute()){
            $link->commit();
            $result = 1;
        }else{
            $link->rollBack();
        }
        PDOUtil::closeConnection($link);
        return $result;
    }
}
