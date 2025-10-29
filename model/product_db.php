<?php
require_once('database.php');

function get_products_by_category($category_id) {
    $db = Database::getDB();
    $query = 'SELECT * FROM products WHERE categoryID = :category_id ORDER BY productID';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->execute();
    $rows = $statement->fetchAll();
    $statement->closeCursor();

    $products = [];
    foreach ($rows as $row) {
        $product = new Product();
        $product->setID($row['productID']);
        $product->setName($row['name']);
        $product->setPrice($row['price']);
        // Optional: only if these fields exist
        if (isset($row['productCode'])) {
            $product->setCode($row['productCode']);
        }
        if (isset($row['description'])) {
            $product->setDescription($row['description']);
        }
        $products[] = $product;
    }
    return $products;
}

function get_product($product_id) {
    $db = Database::getDB();
    $query = 'SELECT * FROM products WHERE productID = :product_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':product_id', $product_id);
    $statement->execute();
    $product = $statement->fetch();
    $statement->closeCursor();
    return $product;
}

function delete_product($product_id) {
    $db = Database::getDB();
    $query = 'DELETE FROM products WHERE productID = :product_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':product_id', $product_id);
    $statement->execute();
    $statement->closeCursor();
}

function add_product($category_id, $code, $name, $price) {
    $db = Database::getDB();
    $query = 'INSERT INTO products (categoryID, productCode, productName, listPrice)
              VALUES (:category_id, :code, :name, :price)';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->bindValue(':code', $code);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':price', $price);
    $statement->execute();
    $statement->closeCursor();
}

function update_product($product_id, $code, $name, $price, $category_id) {
    $db = Database::getDB();
    $query = 'UPDATE products
              SET productCode = :code,
                  name = :name,
                  listPrice = :price,
                  categoryID = :category_id
              WHERE productID = :product_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':code', $code);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':price', $price);
    $statement->bindValue(':category_id', $category_id);
    $statement->bindValue(':product_id', $product_id);
    $statement->execute();
    $statement->closeCursor();
}
?>