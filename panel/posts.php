<?php
include_once('header.php');
require_once('../includes/config.php');

?>

<div class="container-fluid">
    <div class="row">
        <?php include_once('sidebar.php'); ?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <h1 class="h2">Posts</h1>
            <hr>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add New Post</button>

            <div class="modal fade" id="exampleModal">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Post</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Post Title</label>
                                    <input type="text" class="form-control" name="postData[title]">
                                </div>
                                <div class="form-group">
                                    <label>Post Content</label>
                                    <textarea class="form-control" name="postData[content]" rows="4"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Post Excerpt</label>
                                    <textarea class="form-control" name="postData[excerpt]" rows="2"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Post Image</label>
                                    <input type="file" class="form-control-file" name="image" id="exampleFormControlFile1">
                                </div>
                                <div class="form-group">
                                    <label>Post Author</label>
                                    <input type="text" class="form-control" name="postData[author]">
                                </div>
                                <div class="form-group">
                                    <label>Post Cateory</label>
                                    <select class="form-control" name="postData[category_id]">
                                        <?php
                                        // get category
                                        $queryCategoryList = "SELECT * FROM categories";
                                        $query = mysqli_query($dbConnection, $queryCategoryList);
                                        while ($row = mysqli_fetch_assoc($query)) {
                                        ?>
                                            <option value="<?php echo $row['cat_id'] ?>"><?php echo $row['cat_title'] ?></option>
                                        <?php
                                        };
                                        ?>
                                    </select>
                                </div>

                                <input type="hidden" class="form-control" name="postData[date]" value="<?php echo date(date("Y/m/d")); ?>">

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" name="publish" class="btn btn-primary">Publish</button>
                                </div>
                            </form>
                            <?php
                            // add post
                            if (isset($_POST['publish'])) {
                                $postData = $_POST['postData'];

                                // img
                                $postImgae = $_FILES['image']['name'];
                                $postImageTemp = $_FILES['image']['tmp_name'];
                                move_uploaded_file($postImageTemp, "../uploads/" . $postImgae);

                                $queryInsertPost = "INSERT INTO posts (post_title,post_content,post_excerpt,post_image,post_author,post_category_id,post_date) VALUES ('$postData[title]','$postData[content]','$postData[excerpt]','$postImgae','$postData[author]','$postData[category_id]','$postData[date]')";
                                mysqli_query($dbConnection, $queryInsertPost);
                            };
                            ?>

                        </div>

                    </div>
                </div>
            </div>
            <?php
            // Remove post
            if (isset($_GET['remove'])) {
                $post_id = $_GET['remove'];
                $queryRemovePost = "DELETE FROM posts WHERE post_id = '$post_id'";
                mysqli_query($dbConnection, $queryRemovePost);
            };
            // Update post
            if (isset($_GET['update'])) {
                $post_id = $_GET['update'];
                $queryUpdatePost = "SELECT * FROM posts WHERE post_id = '$post_id'";
                $query = mysqli_query($dbConnection, $queryUpdatePost);
                while ($row = mysqli_fetch_assoc($query)) {
            ?>

                    <form method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Post Title</label>
                            <input type="text" class="form-control" name="postNewData[title]" value="<?php echo $row['post_title']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Post Content</label>
                            <textarea class="form-control" name="postNewData[content]" rows="4"><?php echo $row['post_content']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Post Excerpt</label>
                            <textarea class="form-control" name="postNewData[excerpt]" rows="2"><?php echo $row['post_excerpt']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Post Image</label>
                            <img style="width:100px;" src="../uploads/<?php echo $row['post_image']; ?>" alt="">
                            <input type="file" class="form-control-file" name="image" id="exampleFormControlFile1" value="<?php echo $row['post_image']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Post Author</label>
                            <input type="text" class="form-control" name="postNewData[author]" value="<?php echo $row['post_author']; ?>">
                        </div>

                        <input type="hidden" class="form-control" name="postNewData[date]" value="<?php echo date(date("Y/m/d")); ?>">

                        <button type="submit" name="updatebtn" class="btn btn-primary">update</button>

                        <?php
                        // update post
                        if (isset($_POST['updatebtn'])) {
                            $postNewData = $_POST['postNewData'];
                            // img
                            $postNewImgae = $_FILES['image']['name'];
                            $postNewImageTemp = $_FILES['image']['tmp_name'];
                            move_uploaded_file($postNewImageTemp, "../uploads/" . $postNewImgae);

                            $querySetUpdatePost = "UPDATE posts SET
                           
                            post_title = '$postNewData[title]'
                            ,
                            post_content = '$postNewData[content]'
                            ,
                            post_excerpt = '$postNewData[excerpt]'
                            ,
                            post_image = '$postNewImgae'
                            ,
                            post_author = '$postNewData[author]'
                            ,
                            post_date = '$postNewData[date]'
                            
                           WHERE post_id = '$post_id'";

                            mysqli_query($dbConnection, $querySetUpdatePost);
                        };

                        ?>

                    </form>
            <?php

                };
            };
            ?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Post ID</th>
                        <th scope="col">Post Title</th>
                        <th scope="col">Post Date</th>
                        <th scope="col">Post Status</th>
                        <th scope="col">Post Category</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $querySelectAllPost = "SELECT * FROM posts";
                    $query = mysqli_query($dbConnection, $querySelectAllPost);
                    while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                        <tr>
                            <th scope="row"><?php echo $row['post_id']; ?></th>
                            <td><?php echo $row['post_title']; ?></td>
                            <td><?php echo $row['post_date']; ?></td>
                            <td><?php echo $row['post_status']; ?></td>
                            <td><?php

                                $queryCategorySelectName = "SELECT * FROM categories WHERE cat_id = $row[post_category_id]";
                                $querySelectCat = mysqli_query($dbConnection, $queryCategorySelectName);
                                $rowCatId = mysqli_fetch_assoc($querySelectCat);
                                echo $rowCatId['cat_title'];
                                ?></td>
                            <td>
                                <a class="btn btn-warning btn-sm" name="update" href="posts.php?update=<?php echo $row['post_id']; ?>">Update</a>
                                <a class="btn btn-danger btn-sm" name="remove" href="posts.php?remove=<?php echo $row['post_id']; ?>">Remove</a>

                            </td>

                        </tr>
                    <?php }; ?>
                </tbody>
            </table>


        </main>
    </div>
</div>
<?php
include_once('footer.php');
?>