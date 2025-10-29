<?php
require('../model/database.php');
require('../model/product.php');
require('../model/product_db.php');

$selected_ids = $_POST['compare'] ?? [];

include '../view/header.php';
?>

<main>
    <h2>Product Comparison</h2>

    <?php if (count($selected_ids) !== 2): ?>
        <p style="color: red;"><strong>Error:</strong> Please select exactly <strong>2 products</strong> to compare.</p>
        <p><a href="index.php">← Back to Product List</a></p>
    <?php else:
        $product_data1 = get_product($selected_ids[0]);
        $product_data2 = get_product($selected_ids[1]);

        $product1 = new Product();
        $product1->setID($product_data1['productID']);
        $product1->setName($product_data1['name']);
        $product1->setPrice($product_data1['price']);
        $product1->setCode($product_data1['productCode'] ?? '');

        $product2 = new Product();
        $product2->setID($product_data2['productID']);
        $product2->setName($product_data2['name']);
        $product2->setPrice($product_data2['price']);
        $product2->setCode($product_data2['productCode'] ?? '');
    ?>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>Feature</th>
            <th><?php echo htmlspecialchars($product1->getName()); ?></th>
            <th><?php echo htmlspecialchars($product2->getName()); ?></th>
        </tr>
        <tr>
            <td>Product Image</td>
            <td><img src="<?php echo $product1->getImagePath(); ?>" alt="<?php echo $product1->getImageAltText(); ?>" width="200"></td>
            <td><img src="<?php echo $product2->getImagePath(); ?>" alt="<?php echo $product2->getImageAltText(); ?>" width="200"></td>
        </tr>
        <tr>
            <td>Product Name</td>
            <td><?php echo htmlspecialchars($product1->getName()); ?></td>
            <td><?php echo htmlspecialchars($product2->getName()); ?></td>
        </tr>
        <tr>
            <td>Product Code</td>
            <td><?php echo htmlspecialchars($product1->getCode()); ?></td>
            <td><?php echo htmlspecialchars($product2->getCode()); ?></td>
        </tr>
        <tr>
            <td>Price</td>
            <td>$<?php echo $product1->getPriceFormatted(); ?></td>
            <td>$<?php echo $product2->getPriceFormatted(); ?></td>
        </tr>
    </table>

    <p style="margin-top: 20px;">
        <a href="index.php">← Back to Product List</a>
    </p>

    <?php endif; ?>
</main>

<?php include '../view/footer.php'; ?>