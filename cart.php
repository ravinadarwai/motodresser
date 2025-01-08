<?php
session_start();
require './includes/db.php';

$user_full_name = $_SESSION['username'];

// Fetch customer_login_id based on full_name
$stmt = $con->prepare("SELECT id FROM customer_login WHERE full_name = ?");
$stmt->bind_param("s", $user_full_name);
$stmt->execute();
$result = $stmt->get_result();
$user_id = $result->fetch_assoc()['id'];

$cart_query = "SELECT cart.*, products.product_title, products.product_id, products.shipping_charges FROM cart
JOIN products ON cart.p_id = products.product_id
WHERE cart.customer_login_id = '$user_id'";
$cart_result = $con->query($cart_query);
$cart_items = $cart_result->num_rows;
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>Cart – ProMotors – Car Service & Detailing Template</title>
  <?php include 'includes/head-links.php'; ?>
</head>

<body>
  <?php include 'includes/top-bar.php'; ?>
  <div class="page_wrapper">
    <?php include 'includes/header.php'; ?>
    <main class="page_content" style="margin-top: 140px;">
      <section class="page_banner" style="background-image: url('assets/images/shapes/tyre_print_3.svg')">
        <div class="container">
          <ul class="breadcrumb_nav unordered_list">
            <li><a href="index">Home</a></li>
            <li><a href="cart">Cart</a></li>
          </ul>
          <h1 class="page_title wow" data-splitting>Shopping Cart</h1>
        </div>
      </section>

      <section class="cart_section section_space_lg pb-0">
        <div class="container mt-1">
          <!-- <div class="section_heading">
            <h2 class="heading_text mb-0 wow" data-splitting>
              Shopping Cart -
            </h2>
          </div> -->
          <div class="row">
            <div class="col-lg-9">
              <div class="cart_table">
                <ul class="table_head unordered_list">
                  <li>Product type</li>
                  <li>Color</li>
                  <li>Size</li>
                  <li>Price</li>
                  <li>QTY</li>
                  <li>Subtotal</li>
                  <li>Remove</li>
                </ul>


                <?php
                $total = 0; // Initialize total for all cart items
                $shipping_total = 0; // Initialize total for shipping charges
                if ($cart_items > 0):
                  while ($cart_row = $cart_result->fetch_assoc()):
                    $product_id = $cart_row['product_id'];
                    $product_color = $cart_row['color'];
                    $product_size = $cart_row['size'];

                    // Fetch image for the product based on ID
                    $query10 = "SELECT * FROM product_images WHERE product_id = $product_id";
                    $result10 = mysqli_query($con, $query10);
                    $post10 = mysqli_fetch_assoc($result10);

                    $product_title = $cart_row['product_title'];
                    $product_img = $post10['image'];
                    $product_price = $cart_row['p_price'];
                    $quantity = $cart_row['qty'];

                    $subtotal = $product_price * $quantity;
                    $shipping_charge = $cart_row['shipping_charges'];
                    $shipping_total += $shipping_charge;
                    $total += $subtotal;
                    ?>

                    <ul class="unordered_list">
                      <li>
                        <div class="cart_product_item">
                          <div class="item_image">
                            <img src="./admin_area/product_images/<?php echo $product_img; ?>" alt="Product Image" />
                          </div>
                          <div class="item_content">
                            <h3 class="item_title"><?php echo $product_title; ?></h3>
                          </div>
                        </div>
                      </li>
                      <li><span class="title_text">Color</span><span class="price_text"><?php echo $product_color; ?></span></li>
                      <li><span class="title_text">Size</span><span class="price_text"><?php echo $product_size; ?></span></li>
                      <li><span class="title_text">Price</span><span class="price_text">₹<?php echo $product_price; ?></span></li>
                      <li>
  <span class="title_text">QTY</span>
 
  <form action="update_cart.php" method="POST">
    <input type="hidden" name="product_id" value="<?= $product_id?>">
    <input type="hidden" name="size" value="<?=$product_size?>">
    <input type="number" name="quantity" value="<?=$quantity?>" min="1">
    <button type="submit" style="background:red;">Update Quantity</button>
</form>

</li>                <?php
// session_start();
if (isset($_SESSION['message']) || isset($_SESSION['error'])) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    if (isset($_SESSION['message'])) {
        echo "
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '{$_SESSION['message']}',
                    confirmButtonText: 'OK'
                });
            </script>
        ";
        unset($_SESSION['message']);
    }
   
}
?>

                      <li><span class="title_text">Subtotal</span><span class="price_text subtotal" data-product-id="<?php echo $cart_row['p_id']; ?>">₹<?php echo $subtotal; ?></span></li>
                      <li>
    <form class="remove_item_form" style="display: inline;">
      <input type="hidden" name="product_id" value="<?php echo $cart_row['p_id']; ?>">
      <input type="hidden" name="size" value="<?php echo $cart_row['size']; ?>">
      <input type="hidden" name="color" value="<?php echo $cart_row['color']; ?>">
      <button type="button" class="remove_btn" data-product-id="<?php echo $cart_row['p_id']; ?>" data-size="<?php echo $cart_row['size']; ?>" data-color="<?php echo $cart_row['color']; ?>">
        <i class="fa-regular fa-trash-can"></i> <span class="title_text">Remove</span>
      </button>
    </form>
  </li>
                    </ul>

                  <?php endwhile; ?>
                <?php else: ?>
                  <p>Your cart is currently empty.</p>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="order_summary">
                <h3 class="area_title">Order Summary</h3>
                <ul class="unordered_list_block">
                  <li><span>Subtotal</span> <span>₹<?php echo $total; ?></span></li>
                  <li><span>Shipping Charges</span> <span>₹<?php echo $shipping_total; ?></span></li>
                  <li><span>Total</span> <span>₹<?php echo number_format($total + $shipping_total, 2); ?></span></li>
                </ul>
                <a class="btn btn-primary w-100" href="checkout"><span class="btn_text">Checkout</span></a>
                <p class="mb-0">
                  *Taxes and fees are subject to change which may result in a change in your total price.
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="product_section section_space_lg">
        <div class="container">
          <div class="section_heading">
            <h2 class="heading_text mb-0 wow" data-splitting>
              Other Products
            </h2>
          </div>
          <div class="row">
            <?php
            $query = "SELECT * FROM products LIMIT 4";
            $result = mysqli_query($con, $query);
            while ($post = mysqli_fetch_assoc($result)):
              $product_id = $post['product_id'];
              $query10 = "SELECT * FROM product_images where product_id = $product_id";
              $result10 = mysqli_query($con, $query10);
              $post10 = mysqli_fetch_assoc($result10);
              ?>
              <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="product_item">
                  <ul class="badge_group unordered_list">
                    <li><span class="badge badge-primary"><?= $post['product_label'] ?></span></li>
                  </ul>
                  <a class="item_image" href="shop_details"><img src="admin_area/product_images/<?= $post10['image'] ?>" alt="ProMotors - Product Image" /></a>
                  <div class="item_content">
                    <h3 class="item_title">
                      <a href="shop_details"><?= $post['product_title'] ?></a>
                    </h3>
                    <a class="item_brand" href="#!"><?= $post['product_keywords'] ?></a>
                    <div class="item_footer">
                      <div class="item_price">
                        <span class="price_text">₹<?= $post['product_price'] ?></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php endwhile; ?>
          </div>
        </div>
      </section>
    </main>
  </div>
  <?php
    include 'includes/footer.php';
    ?>
  </div>
  <?php
  include 'includes/script-links.php';
  ?>


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
<script>
   
    // Remove item using AJAX
    $(document).on('click', '.remove_btn', function (e) {
        e.preventDefault();

        const productId = $(this).data('product-id');
        const size = $(this).data('size');
        const color = $(this).data('color');

        $.ajax({
            url: 'remove_from_cart.php', // Backend script URL
            type: 'POST',
            data: {
                product_id: productId,
                size: size,
                color: color
            },
            success: function (response) {
                try {
                    if (response.trim() === 'success') {
                        Swal.fire({
                            title: 'Item Removed',
                            text: 'The product has been removed from your cart successfully.',
                            icon: 'success',
                            confirmButtonText: 'OK',
                        }).then(() => {
                            location.reload(); // Reload the page to reflect changes
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: 'Unable to remove the product. Please try again.',
                            icon: 'error',
                            confirmButtonText: 'OK',
                        });
                    }
                } catch (e) {
                    console.error('Error parsing JSON response:', e);
                    Swal.fire({
                        title: 'Error',
                        text: 'There was an error processing your request. Please try again.',
                        icon: 'error',
                        confirmButtonText: 'OK',
                    });
                }
            },
            error: function () {
                console.error('AJAX error.');
                Swal.fire({
                    title: 'Error',
                    text: 'Failed to communicate with the server. Please try again.',
                    icon: 'error',
                    confirmButtonText: 'OK',
                });
            }
        });
    });
</script>

</body>

</html>
