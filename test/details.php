<?php

include('config/db_connect.php');
// check GET request id param
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // make sql
    $sql = "SELECT * FROM products WHERE id = $id";

    // get the query result
    $result = mysqli_query($conn, $sql);

    // fetch result in array format
    $product = mysqli_fetch_assoc($result);

    mysqli_free_result($result);
    mysqli_close($conn);
}

?>

<!DOCTYPE html>
<html>

<?php include('templates/header.php'); ?>

<div class="container center">
    <?php if ($product) : ?>
        <h2><?php echo htmlspecialchars($product['name']) ?></h2>
        <h3>Price: £<?php echo htmlspecialchars($product['price']) ?></h3>
        <p>Colors: <br /><?php echo htmlspecialchars($product['color']) ?></p>
    <?php else : ?>
        <h5>No such product exists!</h5>
    <?php endif; ?>
</div>


<?php include('templates/footer.php'); ?>

</html>