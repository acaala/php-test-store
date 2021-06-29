<?php

include('./config/db_connect.php');

$errors = array('name' => '', 'price' => '', 'color' => '');

$name = $color = '';
$price = null;

if (isset($_POST['submit'])) {
    // Check valid name
    if (empty($_POST['name'])) {
        $errors['name'] = 'A Product name is required <br />';
    } else {
        $name = $_POST['name'];
        if (!preg_match('/^[a-zA-Z0-9\s]+$/', $name)) {
            $errors['name'] = "$name is not a valid name";
        }
    }

    // Check valid price
    if (empty($_POST['price'])) {
        $errors['price'] = 'A Product price is required <br />';
    } else {
        $price = $_POST['price'];
        if (!filter_var($price, FILTER_VALIDATE_INT)) {
            $errors['price'] = "$price is not a number <br />";
        }
    }

    // Check valid color
    if (empty($_POST['color'])) {
        $errors['color'] =  'A Product color is required <br />';
    } else {
        $color = $_POST['color'];
        if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $color)) {
            $errors['color'] = "Color must be a comma seperated list";
        }
    }

    if (!array_filter($errors)) {

        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $price = mysqli_real_escape_string($conn, $_POST['price']);
        $color = mysqli_real_escape_string($conn, $_POST['color']);

        // create sql
        $sql = "INSERT INTO products(name, price, color) VALUES('$name','$price', '$color')";


        // save to db and check
        if (mysqli_query($conn, $sql)) {
            // success
            header('Location: index.php');
        } else {
            // error
            echo 'query error: ' . mysqli_error($conn);
        };
    }
}


?>
<!DOCTYPE html>
<html>
<?php include('./templates/header.php') ?>

<section class="container grey-text">
    <h4 class="center">Add a product</h4>
    <form action="add.php" class="white" method="POST">
        <label for="name">Product Name:</label>
        <input type="text" name="name" value=<?php echo $name ?>>
        <div class="red-text">
            <?php echo $errors['name']; ?>
        </div>

        <label for="price">Product Price:</label>
        <input type="number" name="price" value=<?php echo $price ?>>
        <div class="red-text">
            <?php echo $errors['price']; ?>
        </div>

        <label for="color">Product Color (comma seperated):</label>
        <input type="text" name="color" value=<?php echo $color ?>>
        <div class="red-text">
            <?php echo $errors['color']; ?>
        </div>

        <div class="center">
            <input type="submit" name="submit" value="submit" class="btn brand">
        </div>
    </form>
</section>

<?php include('./templates/footer.php'); ?>

</html>