<?php
// connect to database

$conn = mysqli_connect('localhost', 'acaala', 'test1234', 'test_store');

// check connection
if (!$conn) {
    echo 'Connection error:' . mysqli_connect_error();
}

// wrtie query for all products
$sql = 'SELECT name, price, id FROM products ORDER BY created_at';

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

        <?php foreach ($products as $product) { ?>

            <div class="col s6 md3">
                <div class="card">
                    <div class="card-content center">
                        <h6><?php echo htmlspecialchars($product['name']) ?></h6>
                        <div><?php echo htmlspecialchars($product['price']) ?></div>
                    </div>
                    <div class="card-action right-align">
                        <a href="#" class="brand-text">more info</a>
                    </div>
                </div>
            </div>

        <?php } ?>

    </div>
</div>

<?php include('./templates/footer.php') ?>

</html>