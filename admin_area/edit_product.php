<?php

if (!isset($_SESSION['admin_email'])) {

  echo "<script>window.open('login','_self')</script>";
} else {

?>

  <?php

  if (isset($_GET['edit_product'])) {

    $edit_id = $_GET['edit_product'];

    $get_p = "select * from products where product_id='$edit_id'";

    $run_edit = mysqli_query($con, $get_p);

    $row_edit = mysqli_fetch_array($run_edit);

    $p_id = $row_edit['product_id'];

    $p_title = $row_edit['product_title'];

    $p_cat = $row_edit['p_cat_id'];

    $cat = $row_edit['cat_id'];

    $m_id = $row_edit['manufacturer_id'];

    $p_price = $row_edit['product_price'];

    $p_desc = $row_edit['product_desc'];

    $p_short_desc = $row_edit['product_short_desc'];

    $p_keywords = $row_edit['product_keywords'];

    $psp_price = $row_edit['product_psp_price'];

    $p_shipping_charges = $row_edit['shipping_charges'];

    $p_label = $row_edit['product_label'];

    // $p_url = $row_edit['product_url'];

    $p_features = $row_edit['product_features'];

    // $p_video = $row_edit['product_video'];
  }

  $get_manufacturer = "select * from manufacturers where manufacturer_id='$m_id'";

  $run_manufacturer = mysqli_query($con, $get_manufacturer);

  $row_manfacturer = mysqli_fetch_array($run_manufacturer);

  $manufacturer_id = $row_manfacturer['manufacturer_id'];

  $manufacturer_title = $row_manfacturer['manufacturer_title'];


  $get_p_cat = "select * from product_categories where p_cat_id='$p_cat'";

  $run_p_cat = mysqli_query($con, $get_p_cat);

  $row_p_cat = mysqli_fetch_array($run_p_cat);

  $p_cat_title = $row_p_cat['p_cat_title'];


  $get_cat = "select * from categories where cat_id='$cat'";

  $run_cat = mysqli_query($con, $get_cat);

  $row_cat = mysqli_fetch_array($run_cat);

  $cat_title = $row_cat['cat_title'];


  // Fetch product details
  $productQuery = "SELECT * FROM products WHERE product_id = '$p_id'";
  $productResult = mysqli_query($con, $productQuery);
  $product = mysqli_fetch_assoc($productResult);

  // Fetch product colors
  $colorQuery = "SELECT * FROM product_colors WHERE product_id = '$p_id'";
  $colorResult = mysqli_query($con, $colorQuery);
  $colors = [];
  while ($colorRow = mysqli_fetch_assoc($colorResult)) {
    $colors[] = $colorRow;
  }

  // Fetch product sizes
  $sizeQuery = "SELECT * FROM product_sizes WHERE product_id = '$p_id'";
  $sizeResult = mysqli_query($con, $sizeQuery);
  $sizes = [];
  while ($sizeRow = mysqli_fetch_assoc($sizeResult)) {
    $sizes[] = $sizeRow;
  }

  // Fetch product images
  $imageQuery = "SELECT * FROM product_images WHERE product_id = '$p_id'";
  $imageResult = mysqli_query($con, $imageQuery);
  $images = [];
  while ($imageRow = mysqli_fetch_assoc($imageResult)) {
    $images[] = $imageRow;
  }

  // Fetch suggested products with their titles
  $suggestionQuery = "
SELECT ps.id, ps.suggested_product_id, p.product_title 
FROM product_suggestions ps 
JOIN products p ON ps.suggested_product_id = p.product_id 
WHERE ps.product_id = '$p_id'
";
  $suggestionResult = mysqli_query($con, $suggestionQuery);
  $suggestedProducts = [];
  while ($suggestionRow = mysqli_fetch_assoc($suggestionResult)) {
    $suggestedProducts[] = [
      'id' => $suggestionRow['suggested_product_id'],
      'title' => $suggestionRow['product_title'],
      'id_sugg' => $suggestionRow['id']
    ];
  }




  ?>




  <!DOCTYPE html>

  <html>

  <head>

    <title> Edit Products </title>

    <script src="https://cdn.tiny.cloud/1/tivliw00diinjpat2gqkqs9s3h97o4aenmpku53jbkejs0rz/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        selector: '#product_desc,#product_features',
        height: 500, // Editor height set karo
        plugins: [
          'advlist autolink link image lists charmap print preview hr anchor pagebreak',
          'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
          'save table directionality emoticons template paste'
        ], // Enable more plugins
        toolbar: 'undo redo | styleselect | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify |' +
          'bullist numlist outdent indent | link image media | code preview fullscreen | forecolor backcolor emoticons |' +
          'table insertdatetime charmap hr anchor', // Add more buttons to the toolbar
        menubar: 'file edit view insert format tools table', // You can enable a full menubar too
        image_advtab: true, // Image advanced tab enabled
        branding: false, // Remove TinyMCE branding
        content_css: '//www.tiny.cloud/css/codepen.min.css' // Custom content CSS
      });
    </script>

  </head>

  <body>

    <div class="row"><!-- row Starts -->

      <div class="col-lg-12"><!-- col-lg-12 Starts -->

        <ol class="breadcrumb"><!-- breadcrumb Starts -->

          <li class="active">

            <i class="fa fa-dashboard"> </i> Dashboard / Edit Products

          </li>

        </ol><!-- breadcrumb Ends -->

      </div><!-- col-lg-12 Ends -->

    </div><!-- row Ends -->


    <div class="row"><!-- 2 row Starts -->

      <div class="col-lg-12"><!-- col-lg-12 Starts -->

        <div class="panel panel-default"><!-- panel panel-default Starts -->

          <div class="panel-heading"><!-- panel-heading Starts -->

            <h3 class="panel-title">

              <i class="fa fa-money fa-fw"></i> Edit Products

            </h3>
            <h3 style="text-align: center; color: red;">Note - 'Please fill Seriously Don't be play with color, sizes and image etc.'</h3>


          </div><!-- panel-heading Ends -->

          <div class="panel-body"><!-- panel-body Starts -->

            <form class="form-horizontal" method="post" enctype="multipart/form-data"><!-- form-horizontal Starts -->

              <div class="form-group"><!-- form-group Starts -->

                <label class="col-md-3 control-label"> Product Title </label>

                <div class="col-md-6">

                  <input type="text" name="product_title" class="form-control" required value="<?php echo $p_title; ?>">

                </div>

              </div><!-- form-group Ends -->

              <div class="form-group"><!-- form-group Starts -->

                <label class="col-md-3 control-label"> Select A Brand </label>

                <div class="col-md-6">

                  <select name="manufacturer" class="form-control">

                    <option value="<?php echo $manufacturer_id; ?>">
                      <?php echo $manufacturer_title; ?>
                    </option>

                    <?php

                    $get_manufacturer = "select * from manufacturers";

                    $run_manufacturer = mysqli_query($con, $get_manufacturer);

                    while ($row_manfacturer = mysqli_fetch_array($run_manufacturer)) {

                      $manufacturer_id = $row_manfacturer['manufacturer_id'];

                      $manufacturer_title = $row_manfacturer['manufacturer_title'];

                      echo "
<option value='$manufacturer_id'>
$manufacturer_title
</option>
";
                    }

                    ?>

                  </select>

                </div>

              </div><!-- form-group Ends -->

              <div class="form-group"><!-- form-group Starts -->

                <label class="col-md-3 control-label"> Product Category </label>

                <div class="col-md-6">

                  <select name="product_cat" class="form-control">

                    <option value="<?php echo $p_cat; ?>"> <?php echo $p_cat_title; ?> </option>


                    <?php

                    $get_p_cats = "select * from product_categories";

                    $run_p_cats = mysqli_query($con, $get_p_cats);

                    while ($row_p_cats = mysqli_fetch_array($run_p_cats)) {

                      $p_cat_id = $row_p_cats['p_cat_id'];

                      $p_cat_title = $row_p_cats['p_cat_title'];

                      echo "<option value='$p_cat_id' >$p_cat_title</option>";
                    }


                    ?>


                  </select>

                </div>

              </div><!-- form-group Ends -->

              <div class="form-group"><!-- form-group Starts -->

                <label class="col-md-3 control-label"> Product Sub-Category </label>

                <div class="col-md-6">


                  <select name="cat" class="form-control">

                    <option value="<?php echo $cat; ?>"> <?php echo $cat_title; ?> </option>

                    <?php

                    $get_cat = "select * from categories ";

                    $run_cat = mysqli_query($con, $get_cat);

                    while ($row_cat = mysqli_fetch_array($run_cat)) {

                      $cat_id = $row_cat['cat_id'];

                      $cat_title = $row_cat['cat_title'];

                      echo "<option value='$cat_id'>$cat_title</option>";
                    }

                    ?>


                  </select>

                </div>

              </div><!-- form-group Ends -->

              <div id="colorContainer">
                <div class="form-group">
                  <label class="col-md-3 control-label">Colors</label>
                  <div class="col-md-6">
                    <?php foreach ($colors as $color): ?>
                      <div style="display: flex; align-items: center;">
                        <input type="text" name="colors[]" class="form-control" value="<?php echo $color['color']; ?>" readonly>
                        <input type="hidden" name="color_ids[]" value="<?php echo $color['id']; ?>">
                        <input type="checkbox" name="delete_colors[]" value="<?php echo $color['id']; ?>"> Delete
                      </div><br>
                    <?php endforeach; ?>
                    <!-- <button type="button" id="addColor" class="btn btn-info">Add Color</button> -->
                  </div>
                </div>
              </div>


              <div id="sizeContainer">
                <div class="form-group">
                  <label class="col-md-3 control-label">Sizes</label>
                  <div class="col-md-6">
                    <?php foreach ($sizes as $size): ?>
                      <div style="display: flex; align-items: center;">
                        <input type="text" name="sizes[]" class="form-control" value="<?php echo $size['size']; ?>" readonly>
                        <input type="hidden" name="size_ids[]" value="<?php echo $size['id']; ?>">
                        <input type="checkbox" name="delete_sizes[]" value="<?php echo $size['id']; ?>"> Delete
                      </div><br>
                    <?php endforeach; ?>
                    <!-- <button type="button" id="addSize" class="btn btn-info">Add Size</button> -->
                  </div>
                </div>
              </div>


              <!-- <div id="imageContainer">
                <div class="form-group">
                  <label class="col-md-3 control-label">Product Images</label>
                  <div class="col-md-6">
                    <?php foreach ($images as $image): ?>
                      <div style="border: 1px solid black; padding: 20px; margin-bottom: 10px;">
                        <input type="file" name="images[]">
                        <br><img src="product_images/<?php echo $image['image']; ?>" width="70" height="70">
                        <span>Color: <strong><?php echo $image['color']; ?></strong></span>
                        <input type="hidden" name="image_ids[]" value="<?php echo $image['id']; ?>">
                        <input type="checkbox" name="delete_images[]" value="<?php echo $image['id']; ?>"> Delete
                      </div>
                    <?php endforeach; ?>
                    <button type="button" id="addImage" class="btn btn-info">Add Image</button>
                  </div>
                </div>
              </div> -->

              <div class="form-group"><!-- form-group Starts -->

                <label class="col-md-3 control-label"> Product Price </label>

                <div class="col-md-6">

                  <input type="text" name="product_price" class="form-control" required value="<?php echo $p_price; ?>">

                </div>

              </div><!-- form-group Ends -->

              <div class="form-group"><!-- form-group Starts -->

                <label class="col-md-3 control-label"> Product Sale Price </label>

                <div class="col-md-6">

                  <input type="text" name="psp_price" class="form-control" required value="<?php echo $psp_price; ?>">

                </div>

              </div><!-- form-group Ends -->

              <div class="form-group"><!-- form-group Starts -->

                <label class="col-md-3 control-label"> Product Keywords </label>

                <div class="col-md-6">

                  <input type="text" name="product_keywords" class="form-control" required value="<?php echo $p_keywords; ?>">

                </div>

              </div><!-- form-group Ends -->

              <div class="form-group"><!-- form-group Starts -->

                <label class="col-md-3 control-label"> Product Label </label>

                <div class="col-md-6">

                  <input type="text" name="product_label" class="form-control" required value="<?php echo $p_label; ?>">

                </div>

              </div><!-- form-group Ends -->

              <div class="form-group"><!-- form-group Starts -->

                <label class="col-md-3 control-label"> Product Short Description </label>

                <div class="col-md-6">

                  <input type="text" name="product_short_desc" class="form-control" required value="<?php echo $p_short_desc; ?>">

                </div>

              </div><!-- form-group Ends -->

              <div class="form-group">
                <label class="col-md-3 control-label">Shipping Charges</label>
                <div class="col-md-6">
                  <input type="text" name="shipping_charges" class="form-control" value="<?php echo $p_shipping_charges; ?>">
                </div>
              </div>

              <div id="suggestedProductsContainer">
                <div class="form-group">
                  <label class="col-md-3 control-label">Suggested Products</label>
                  <div class="col-md-6">
                    <?php foreach ($suggestedProducts as $suggestedProduct): ?>
                      <div style="display: flex; align-items: center;">
                        <input type="text" name="suggested_products[]" class="form-control" value="<?php echo $suggestedProduct['title']; ?>" readonly>
                        <input type="hidden" name="suggested_product_ids[]" value="<?php echo $suggestedProduct['id_sugg']; ?>">
                        <input type="checkbox" name="delete_suggested_products[]" value="<?php echo $suggestedProduct['id_sugg']; ?>"> Delete
                      </div><br>
                    <?php endforeach; ?>
                    <!-- <button type="button" id="addSuggestedProduct" class="btn btn-info">Add Suggested Product</button> -->
                  </div>
                </div>
              </div>



              <div class="form-group"><!-- form-group Starts -->

                <label class="col-md-3 control-label"> Product Tabs </label>

                <div class="col-md-6">

                  <ul class="nav nav-tabs"><!-- nav nav-tabs Starts -->

                    <li class="active">

                      <a data-toggle="tab" href="#description"> Product Description </a>

                    </li>

                    <li>

                      <a data-toggle="tab" href="#features"> Product Features </a>

                    </li>

                  </ul><!-- nav nav-tabs Ends -->

                  <div class="tab-content"><!-- tab-content Starts -->

                    <div id="description" class="tab-pane fade in active"><!-- description tab-pane fade in active Starts -->

                      <br>

                      <textarea name="product_desc" class="form-control" rows="15" id="product_desc">

<?php echo $p_desc; ?>

</textarea>

                    </div><!-- description tab-pane fade in active Ends -->


                    <div id="features" class="tab-pane fade in"><!-- features tab-pane fade in Starts -->

                      <br>

                      <textarea name="product_features" class="form-control" rows="15" id="product_features">

<?php echo $p_features; ?>

</textarea>

                    </div><!-- features tab-pane fade in Ends -->


                  </div><!-- tab-content Ends -->

                </div>

              </div><!-- form-group Ends -->

              <div class="form-group"><!-- form-group Starts -->

                <label class="col-md-3 control-label"></label>

                <div class="col-md-6">

                  <input type="submit" name="update" value="Update Product" class="btn btn-primary form-control">

                </div>

              </div><!-- form-group Ends -->

            </form><!-- form-horizontal Ends -->

          </div><!-- panel-body Ends -->

        </div><!-- panel panel-default Ends -->

      </div><!-- col-lg-12 Ends -->

    </div><!-- 2 row Ends -->


  </body>

  </html>

  <?php

  if (isset($_POST['update'])) {



    if (!empty($_POST['delete_colors'])) {
      $delete_colors = $_POST['delete_colors'];
      foreach ($delete_colors as $color_id) {
        $delete_color_query = "DELETE FROM product_colors WHERE id='$color_id'";
        mysqli_query($con, $delete_color_query);
      }
    }

    // Delete selected sizes
    if (!empty($_POST['delete_sizes'])) {
      $delete_sizes = $_POST['delete_sizes'];
      foreach ($delete_sizes as $size_id) {
        $delete_size_query = "DELETE FROM product_sizes WHERE id='$size_id'";
        mysqli_query($con, $delete_size_query);
      }
    }

    // Delete selected images
    if (!empty($_POST['delete_images'])) {
      $delete_images = $_POST['delete_images'];
      foreach ($delete_images as $image_id) {
        $delete_image_query = "DELETE FROM product_images WHERE id='$image_id'";
        mysqli_query($con, $delete_image_query);
      }
    }

    // Delete selected suggested products
    if (!empty($_POST['delete_suggested_products'])) {
      $delete_suggested = $_POST['delete_suggested_products'];
      foreach ($delete_suggested as $suggested_id) {
        $delete_suggested_query = "DELETE FROM product_suggestions WHERE id='$suggested_id'";
        mysqli_query($con, $delete_suggested_query);
      }
    }



    // Escape user inputs to prevent SQL injection
    $product_title = mysqli_real_escape_string($con, $_POST['product_title']);
    $product_cat = mysqli_real_escape_string($con, $_POST['product_cat']);
    $cat = mysqli_real_escape_string($con, $_POST['cat']);
    $manufacturer_id = mysqli_real_escape_string($con, $_POST['manufacturer']);
    $product_price = mysqli_real_escape_string($con, $_POST['product_price']);
    $product_desc = mysqli_real_escape_string($con, $_POST['product_desc']);
    $product_short_desc = mysqli_real_escape_string($con, $_POST['product_short_desc']);
    $product_keywords = mysqli_real_escape_string($con, $_POST['product_keywords']);
    $psp_price = mysqli_real_escape_string($con, $_POST['psp_price']);
    $product_label = mysqli_real_escape_string($con, $_POST['product_label']);
    $product_features = mysqli_real_escape_string($con, $_POST['product_features']);
    $product_shipping_charges = mysqli_real_escape_string($con, $_POST['shipping_charges']);

    // Update main product details
    $update_product = "UPDATE products SET 
      product_short_desc='$product_short_desc',
      p_cat_id='$product_cat',
      cat_id='$cat',
      manufacturer_id='$manufacturer_id',
      date=NOW(),
      product_title='$product_title',
      product_price='$product_price',
      product_psp_price='$psp_price',
      product_desc='$product_desc',
      product_features='$product_features',
      product_keywords='$product_keywords',
      product_label='$product_label',
      shipping_charges='$product_shipping_charges'
      WHERE product_id='$p_id'";

    $run_product = mysqli_query($con, $update_product);

    if ($run_product) {

      echo "<script> alert('Product has been updated successfully') </script>";
      echo "<script>window.open('index?view_products','_self')</script>";
    } else {
      echo "<script> alert('Error updating product') </script>";
    }
  }

  ?>


<?php } ?>