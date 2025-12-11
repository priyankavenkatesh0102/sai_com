<?php
// FIX: always load config correctly
include "adminlogin/config.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo htmlspecialchars($categoryName); ?></title>

<style>
.product-grid {
  width: 90%;
  margin: 30px auto;
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
  gap: 20px;
}
.product-card {
  background:#fff; padding:12px; border-radius:10px; text-align:center;
  border:1px solid #eee; box-shadow:0 4px 10px rgba(0,0,0,0.04);
}
.product-card img {
  width:100%; height:200px; object-fit:cover; border-radius:6px;
}
.price { font-weight:700; color:#111; }
</style>

</head>
<body>

<h1 style="text-align:center;"> <?php echo $categoryName; ?> </h1>

<div class="product-grid">

<?php

// FIX: escape category
$cat = mysqli_real_escape_string($conn, $categoryName);

$sql = "SELECT * FROM products WHERE category='$cat' ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {

    while ($p = mysqli_fetch_assoc($result)) {

        $img = !empty($p['image'])
            ? "adminlogin/uploads/" . $p['image']
            : "adminlogin/uploads/no-image.png";
?>
    <div class="product-card">
        <a href="product-details.php?id=<?php echo $p['id']; ?>">
          <img src="<?php echo $img; ?>" alt="">
        </a>
        <h3><?php echo $p['brand']." ".$p['model']; ?></h3>
        <div class="price">₹<?php echo number_format($p['price']); ?></div>
    </div>

<?php
    }
} else {
    echo "<p>No products found.</p>";
}
?>

</div>

</body>
</html>
