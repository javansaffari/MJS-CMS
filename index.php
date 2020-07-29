<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>MJS CMS</title>
    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- Github JS -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</head>

<body>
    <?php
    // General includes
    require_once('includes/config.php');
    ?>
    <header>
        <div class="collapse bg-dark" id="navbarHeader">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-md-7 py-4">
                        <h4 class="text-white">About</h4>
                        <p class="text-muted">A Simple and Useful Content Management System Just for practice PHP. This CMS used PHP and Bootstrap Framework.
                        </p>
                    </div>
                    <div class="col-sm-4 offset-md-1 py-4">
                        <h4 class="text-white">Contact</h4>
                        <ul class="list-unstyled">
                            <li><a href="https://twitter.com/javansaffari" class="text-white">Follow on Twitter</a></li>
                            <li><a href="https://www.linkedin.com/in/mohammad-javan-saffari/" class="text-white">Visit My linkedin</a></li>
                            <li><a href="mailto:javansaffari@gmail.com?subject=MJS CMS" class="text-white">Email me</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar navbar-dark bg-dark shadow-sm">
            <div class="container d-flex justify-content-between">
                <a href="#" class="navbar-brand d-flex align-items-center">
                    <strong>📚 MJS CMS</strong>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
            </div>
        </div>
    </header>


    <main role="main">

        <section class="jumbotron text-center">
            <div class="container">
                <h1>MJS CMS<span class="badge badge-info" style="font-size: 10px;">V0.6</span></h1>

                <p class="lead text-muted">🚀 A Simple and Useful Content Management System Just for practice PHP. This CMS used PHP and Bootstrap Framework.</p>
                <p>
                    <a class="github-button " href="https://github.com/javansaffari/MJS-CMS" data-icon="octicon-star" aria-label="Star javansaffari/MJS-CMS on GitHub">Star</a>
                    <a class="github-button" href="https://github.com/javansaffari/MJS-CMS/fork" data-icon="octicon-repo-forked" aria-label="Fork javansaffari/MJS-CMS on GitHub">Fork</a> </p>
            </div>
        </section>

        <div class="bg-light">
            <div class="container ">
                <div class="row">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                          <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">
                                <?php
                            $querySelectAllCat = 'SELECT * FROM categories';
                            $query = mysqli_query($dbConnection, $querySelectAllCat);
                             while ($row = mysqli_fetch_assoc($query)) {
                                ?>
                                <li class="nav-item active">
                                    <a class="nav-link" href="#"><?php echo $row['cat_title']; ?></a>
                                </li>
<?php
};
?>
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="row">

                <?php
                            $querySelectAllPosts = "SELECT * FROM posts";
                            $query = mysqli_query($dbConnection, $querySelectAllPosts);
                             while ($row = mysqli_fetch_assoc($query)) {
                                ?>


                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                        <img src="<?php echo $row['post_image'];?>" alt="">
                            <div class="card-body">
                                <h2><?php echo $row['post_title'];?></h2>
                                <p class="card-text"><?php echo $row['post_excerpt'];?></p>
                                <div class="d-flex justify-content-between align-items-center">

                                    <small class="text-muted"><?php echo $row['post_date'];?></small>
                                </div>
                            </div>
                        </div>
                    </div>
                             <?php };?>
                </div>
            </div>
        </div>

    </main>

    <footer class="text-muted">
        <div class="container">
            <p class="float-right">
                <a href="#">Back to top</a>
            </p>


            <p>Powered by Mohammad Javan Saffari With ❤️. If ($You_want = true){
                <a href="https://www.linkedin.com/in/mohammad-javan-saffari/"> Visit My Linkedin</a> } else {echo"Enjoy Your time 😊"};
            </p>

        </div>
    </footer>
    <script src="assets/js/jquery.min.js"></script>
    <script>
        window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')
    </script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>