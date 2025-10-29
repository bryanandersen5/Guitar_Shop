<?php
require_once('database.php');
require_once('category.php');

class CategoryDB {
    public function getCategories() {
        $db = Database::getDB();
        $query = 'SELECT * FROM categories ORDER BY categoryID';
        $statement = $db->query($query);
        $categories = [];
        foreach ($statement as $row) {
            $category = new Category();
            $category->setID($row['categoryID']);
            $category->setName($row['categoryName']);
            $categories[] = $category;
        }
        return $categories;
    }

    public function getCategory($category_id) {
    $db = Database::getDB();
    $query = 'SELECT * FROM categories WHERE categoryID = :category_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->execute();
    $row = $statement->fetch();
    $statement->closeCursor();

    if ($row) {
        $category = new Category();
        $category->setID((int)$row['categoryID']);
        $category->setName($row['categoryName']);
        return $category;
    } else {
        // Optionally return null or throw an exception
        return null;
    }
}
}
?>