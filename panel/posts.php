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
                            <form method="post">
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
                                    <label>Post Image URL</label>
                                    <input type="text" class="form-control" name="postData[image]">
                                </div>
                                <div class="form-group">
                                    <label>Post Author</label>
                                    <input type="text" class="form-control" name="postData[author]">
                                </div>
                                <div class="form-group">
                                    <label>Post Tags</label>
                                    <input type="text" class="form-control" name="postData[tags]">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" name="publish" class="btn btn-primary">Publish</button>
                                </div>
                            </form>
                            <?php
                            // add post
                            if (isset($_POST['publish'])) {
                                $postData = $_POST['postData'];
                                var_dump($postData);
                                $queryInsertPost = "INSERT INTO posts (post_title,post_content,post_excerpt,post_image,post_author,post_tags) VALUES ('$postData[title]','$postData[content]','$postData[excerpt]','$postData[image]','$postData[author]','$postData[tags]')";
                                mysqli_query($dbConnection, $queryInsertPost);
                            };
                            // Remove post
                            if (isset($_GET['remove'])) {
                                $post_id = $_GET['remove'];
                                $queryRemovePost = "DELETE FROM posts WHERE post_id = '$post_id'";
                                mysqli_query($dbConnection, $queryRemovePost);
                            };
                            ?>
                        </div>

                    </div>
                </div>
            </div>
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
                            <td><?php echo $row['post_category_id']; ?></td>
                            <td>
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