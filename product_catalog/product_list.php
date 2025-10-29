<?php include '../view/header.php'; ?>
<main>
    <aside>
        <h1>Categories</h1>
        <nav>
        <ul>
            <?php foreach ($categories as $category) : ?>
            <li>
                <a href="?category_id=<?php echo $category->getID(); ?>">
                    <?php echo htmlspecialchars($category->getName()); ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
        </nav>
    </aside>

    <section>
        <h1>
            <?php 
            echo $current_category ? htmlspecialchars($current_category->getName()) : "Unknown Category";
            ?>
        </h1>

        <form method="post" action="compare.php">
            <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <td>Product Image</td>
                <td>Product Details</td>
                <td>Compare</td>
            </tr>    
            <tr>
                <?php
                $count = 0;
                foreach ($products as $product) :
                    if ($count > 0 && $count % 3 == 0) {
                        echo '</tr><tr>';
                    }
                ?>
                    <td align="center">
                        <img src="<?php echo $product->getImagePath(); ?>" 
                             alt="<?php echo $product->getImageAltText(); ?>" 
                             width="150"><br>
                    </td>
                    <td align="center">
                        <strong><?php echo htmlspecialchars($product->getName()); ?></strong><br>
                        Price: $<?php echo $product->getPriceFormatted(); ?><br>
                    </td>
                    <td align="center">
                        <label>
                            <input type="checkbox" name="compare[]" value="<?php echo $product->getID(); ?>">
                            Compare
                        </label>
                    </td>
                </tr>
                <?php
                    $count++;
                endforeach;
                ?>
            </table>

            <p style="text-align: center; margin-top: 20px;">
                <button type="submit" name="compare_btn" disabled>Compare Selected Products</button>
            </p>
        </form>
    </section>
</main>
<?php include '../view/footer.php'; ?>

<!-- JavaScript: Enable button only when exactly 2 checkboxes are selected -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const checkboxes = document.querySelectorAll('input[name="compare[]"]');
    const button = document.querySelector('button[name="compare_btn"]');

    const updateButtonState = () => {
        const selected = Array.from(checkboxes).filter(cb => cb.checked);
        button.disabled = selected.length !== 2;
    };

    checkboxes.forEach(cb => cb.addEventListener('change', updateButtonState));
    updateButtonState();
});
</script>