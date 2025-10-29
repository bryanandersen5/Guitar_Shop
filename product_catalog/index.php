<?php
require('../model/database.php');
require('../model/category.php');
require('../model/category_db.php');
require('../model/product.php');
require('../model/product_db.php');

$categoryDB = new CategoryDB();

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'list_products';
    }
}

switch ($action) {
    case 'list_products':
        $category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
        if ($category_id === NULL || $category_id === FALSE) {
            $category_id = 1;
        }

        $current_category = $categoryDB->getCategory($category_id);
        $categories = $categoryDB->getCategories();
        $products = get_products_by_category($category_id);

        include('product_list.php');
        break;

    case 'view_product':
        $categories = $categoryDB->getCategories();
        $product_id = filter_input(INPUT_GET, 'product_id', FILTER_VALIDATE_INT);
        if ($product_id === NULL || $product_id === FALSE) {
            echo "<p>Invalid product ID.</p>";
            exit;
        }

        $product = get_product($product_id);
        include('product_view.php');
        break;
}
?>