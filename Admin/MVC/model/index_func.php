<?php
ob_start();
//xóa danh mục 
function delete_category($conn, $id_cate)
{
        $query = "delete  from category where CateID = '$id_cate'";
        $statement = $conn->prepare($query);
        $statement->execute();
        $statement->closeCursor();
}

function getOne_cate ($conn, $id){
        $sql = "select * from category where CateID = '$id'";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $rs = $statement->fetchAll();
        return $rs;
}

function edit_cate ($conn, $id, $newname){
        $sql = "update category set CateName = '$newname' where CateID ='$id'";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $statement->closeCursor();
}
function addCategory($conn, $cateName){
        $sql = "insert into category value ('null', '$cateName')";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $statement->closeCursor();
}

?>