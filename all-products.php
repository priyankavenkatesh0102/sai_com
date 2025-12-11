<?php
include "adminlogin/config.php";

?>
<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><title>All Products</title><link rel="stylesheet" href="css/style.css"></head>
<body>
<h1 style="text-align:center; margin-top:20px;">All Products</h1>
<div class="product-grid">
<?php
$sql = "SELECT * FROM products ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
if ($result && mysqli_num_rows($result) > 0) {
  while ($p = mysqli_fetch_assoc($result)) {
    $img = !empty($p['image']) ? 'adminlogin/uploads/' . $p['image'] : 'adminlogin/uploads/no-image.png';
?>
  <div class="product-card">
    <a href="product-details.php?id=<?php echo $p['id']; ?>">
      <img src="<?php echo htmlspecialchars($img); ?>" alt="">
    </a>
    <h3><?php echo htmlspecialchars($p['brand'] . ' ' . $p['model']); ?></h3>
    <div class="price">₹<?php echo number_format($p['price'],2); ?></div>
  </div>
<?php
  }
} else {
  echo "<p style='text-align:center;width:100%'>No products found.</p>";
}
?>
</div>
</body>
</html>
