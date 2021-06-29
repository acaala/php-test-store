<?php

include('./config/db_connect.php');

// wrtie query for all products
$sql = 'SELECT name, price, id, color FROM products ORDER BY created_at';

// make query & get result
$result = mysqli_query($conn, $sql);

// fetch the resulting rows as an array
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

// free result from memory
mysqli_free_result($result);

// close connection
mysqli_close($conn);


?>
<!DOCTYPE html>
<html>
<?php include('./templates/header.php') ?>

<h4 class="center grey-text">Products</h4>

<div class="container">
    <div class="row">

        <?php foreach ($products as $product) : ?>

            <div class="col s6 md3">
                <div class="card">
                    <div class="card-content center">
                        <h6><?php echo htmlspecialchars($product['name']) ?></h6>
                        <div>£<?php echo htmlspecialchars($product['price']) ?></div>
                        <ul>
                            <?php foreach (explode(',', $product['color']) as $col) : ?>
                                <li><?php echo htmlspecialchars($col) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="card-action right-align">
                        <a href="details.php?id=<?php echo $product['id'] ?>" class="brand-text">more info</a>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>

    </div>
</div>

<?php include('./templates/footer.php') ?>

</html>