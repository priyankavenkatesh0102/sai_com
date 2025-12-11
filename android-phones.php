<?php
include __DIR__ . "/adminlogin/config.php";
?>


<!DOCTYPE html>
<html>
<head>
    <title>Android Phones</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h1>Android Phones</h1>

<?php
// Fetch only Android category products
$sql = "SELECT * FROM products WHERE category='Android' ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0){
?>
    <div class="product-container">
    <?php while($row = mysqli_fetch_assoc($result)){ ?>
        
        <div class="product-card">
            <img src="adminlogin/uploads/<?php echo $row['image']; ?>" width="150">

            <h3><?php echo $row['brand'] . " " . $row['model']; ?></h3>
            <p><?php echo $row['type']; ?></p>

            <p><strong>₹<?php echo $row['price']; ?></strong></p>

            <a href="product-details.php?id=<?php echo $row['id']; ?>">
                <button>View Details</button>
            </a>
        </div>

    <?php } ?>
    </div>
<?php
} else {
    echo "<p>No Android phones available.</p>";
}
?>

</body>
</html>
