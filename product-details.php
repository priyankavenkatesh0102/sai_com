<?php
include "adminlogin/config.php";
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) { header("Location: index.php"); exit; }

$stmt = mysqli_prepare($conn, "SELECT * FROM products WHERE id = ? LIMIT 1");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$p = mysqli_fetch_assoc($res);
if (!$p) { header("Location: index.php"); exit; }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo htmlspecialchars($p['brand'] . ' ' . $p['model']); ?></title>
<link rel="stylesheet" href="css/style.css">
<style>
.product-detail { width:90%; margin:30px auto; display:flex; gap:20px; flex-wrap:wrap; }
.gallery { flex:1 1 380px; }
.gallery img { width:100%; max-width:400px; border-radius:8px; margin-bottom:8px; object-fit:cover; }
.details { flex:1 1 380px; }
.price { font-size:24px; color:#111; font-weight:700; margin-top:10px; }
.addcart { display:inline-block; padding:10px 16px; background:#007bff; color:#fff; border-radius:8px; text-decoration:none; margin-top:12px; }
</style>
</head>
<body>

<div class="product-detail">
  <div class="gallery">
    <img src="adminlogin/uploads/<?php echo htmlspecialchars($p['image'] ?: 'no-image.png'); ?>" alt="">
    <div style="display:flex; gap:8px; margin-top:8px;">
      <img src="adminlogin/uploads/<?php echo htmlspecialchars($p['image2'] ?: 'no-image.png'); ?>" style="width:32%; height:80px; object-fit:cover;">
      <img src="adminlogin/uploads/<?php echo htmlspecialchars($p['image3'] ?: 'no-image.png'); ?>" style="width:32%; height:80px; object-fit:cover;">
    </div>
  </div>

  <div class="details">
    <h1><?php echo htmlspecialchars($p['brand'] . ' ' . $p['model']); ?></h1>
    <div class="price">₹<?php echo number_format($p['price'],2); ?></div>
    <div style="margin-top:12px;"><?php echo nl2br(htmlspecialchars($p['description'])); ?></div>

    <!-- simple Add to Cart (non-logged, demo) -->
    <form action="cart_add.php" method="post" style="margin-top:16px;">
      <input type="hidden" name="product_id" value="<?php echo $p['id']; ?>">
      <label>Quantity:
        <input type="number" name="qty" value="1" min="1" style="width:70px; margin-left:6px;">
      </label>
      <br>
      <button class="addcart" type="submit">Add to cart</button>
    </form>
  </div>
</div>

</body>
</html>
