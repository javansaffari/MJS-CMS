<?php
include_once('header.php');
require_once('../includes/config.php');

?>

<div class="container-fluid">
  <div class="row">
    <?php include_once('sidebar.php'); ?>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <h1 class="h2">New Category</h1>
      <hr>
      <form method="post">
        <div class="form-group">
          <label>Category name</label>
          <input type="text" class="form-control" name="cat_name">
        </div>
        <button type="submit" name="btn_name" class="btn btn-primary">Add</button>
      </form>
      <br>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Cat ID</th>
            <th scope="col">Category Name</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $querySelectAllCat = "SELECT * FROM categories";
          $query = mysqli_query($dbConnection, $querySelectAllCat);
          while ($row = mysqli_fetch_assoc($query)) {
          ?>
            <tr>
              <th scope="row"><?php echo $row['cat_id']; ?></th>
              <td><?php echo $row['cat_title']; ?></td>
              <td>
                <a class="btn btn-danger btn-sm" name="remove" href="category.php?remove=<?php echo $row['cat_id']; ?>">Remove</a>
              </td>
            </tr>
          <?php }; ?>
        </tbody>
      </table>
      <?php
      // Add New category
      if (isset($_POST['btn_name'])) {
        $cat_name = $_POST['cat_name'];
        if (!$cat_name) {
          echo "Input is Empty!";
        } else {
          $queryInsertCat = "INSERT INTO categories (cat_title) VALUES ('$cat_name')";
          mysqli_query($dbConnection, $queryInsertCat);
        };
      };
      // Remove Cat
      if (isset($_GET['remove'])) {
        $cat_id = $_GET['remove'];
        $queryRemoveCat = "DELETE FROM categories WHERE cat_id = '$cat_id'";
        mysqli_query($dbConnection, $queryRemoveCat);
      };


      ?>
    </main>
  </div>
</div>
<?php
include_once('footer.php');
?>