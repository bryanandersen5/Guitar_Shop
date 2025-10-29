<?php include '../view/header.php'; ?>
<main>
    <h1>Product List</h1>

    <aside>
        <!-- display a list of categories -->
        <h2>Categories</h2>
        <nav>
        <ul>
        <?php foreach ($categories as $category) : ?>
            <li>
            <a href="?category_id=<?php echo $category['categoryID']; ?>">
                <?php echo $category['categoryName']; ?>
            </a>
            </li>
        <?php endforeach; ?>
        </ul>
        </nav>
    </aside>

    <section>
        <!-- display a table of products -->
        <h2><?php echo $category_name; ?></h2>
        <table>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th class="right">Price</th>
                <th>Delete</th>
                <th>Edit</th>
            </tr>
            <?php foreach ($products as $product) : ?>
            <tr>
                <td><?php echo $product['categoryID']; ?></td>
                <td><?php echo $product['name']; ?></td>
                <td class="right"><?php echo $product['price']; ?></td>

                <!-- Delete Button -->
                <td>
                    <form action="." method="post" onsubmit="return confirmDelete(this);">
                        <input type="hidden" name="action" value="delete_product">
                        <input type="hidden" name="product_id" value="<?php echo $product['productID']; ?>">
                        <input type="hidden" name="category_id" value="<?php echo $product['categoryID']; ?>">
                        <input type="submit" value="Delete">
                    </form>
                </td>

                <td>
                    <form action="." method="get">
                        <input type="hidden" name="action" value="show_edit_form">
                        <input type="hidden" name="product_id" value="<?php echo $product['productID']; ?>">
                        <input type="submit" value="Edit">
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>

        <p class="last_paragraph">
            <a href="?action=show_add_form">Add Product</a>
        </p>
    </section>
</main>

<!-- JavaScript confirmation prompt -->
<script>
function confirmDelete(form) {
    const userInput = prompt("Type DELETE to confirm deletion of this product:");
    if (userInput === "DELETE" || userInput === "delete") {
        return true;
    }
    alert("Deletion cancelled.");
    return false;
}
</script>

<?php include '../view/footer.php'; ?>