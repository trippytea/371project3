<?php 
include('db.php'); //connect to database
include('nav.php'); //mobile responsive nav-bar

function getRecentArticles ($db) {
    $result = mysqli_fetch_all($db -> query ("SELECT * FROM article"));
    foreach ($result as $row) {
        $title = $row[1];
        $bodyPrev = substr($row[2],0,130);
        $shortTitle = $row[4];
        echo "
              <h6>$title</h6>
              <div class='articlePrev mb-4'> 
              <p class='mb-2'>$bodyPrev . . .</p>
              <a href='wiki.php?short_title=$shortTitle'>Read More</a>
              </div>";
    }
}
?>
 
<!--php ends-->
<!DOCTYPE html>
<html lang="en-us">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Wiki Woo!</title>
    <link rel="shortcut icon" href ="images/favicon.png">

	<!--Open Sans Font-->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
	rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> 
	
	<!-- Font Awesome icon library -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

 	<!--<link rel="stylesheet" type="text/css" href="css\bootstrap.css"> if wanted offline-->

	<!-- custom CSS Stylesheet -->	  
    <link rel="stylesheet" type="text/css" href="styles.css";>
</head>

<body>
    <img src="images\w-logo.png" class="mx-auto d-flex mt-4" width="110px" height="auto" alt="wiki-woo logo">
    <h1 class="centerContent mt-2">Welcome to Wiki Woo!</h1>
    <p class="centerContent">Your home for the <em>&nbspworst&nbsp</em> articles on the Internet!</p>

    <div class="row mx-auto mt-4">
        <div class="col 4"> 
            <div class="articleBox mb-4 mx-4">
                <h2>Recent Articles</h2>
                <?= getRecentArticles($db) ?>
            </div>
        </div> <!--col end-->

    <div class="col 4"> 
            <div class="articleBox mb-4 mx-4">
                <h2>Add Article</h2>
                <p style='width:200px'>You must be logged in to add an article to Wiki Woo.</p>
                <a href="addarticle.php"><button class="btn-primary btn-lg btn-block mb-3">Add Article</button></a>
            </div>

            <div class="articleBox mb-4 mx-4">
                <h2>Update Article</h2>
                <p style='width:200px'>You must be logged in to add an article to Wiki Woo.</p>
                <a href="updateArticle.php"><button class="btn-primary btn-lg btn-block mb-3">Update Article</button></a>
            </div>


            <div class="articleBox mb-4 mx-4">
                <h2>Sign Up</h2>
                <p>Dont have an account? <br>Click here to sign up!</p>
                <a href="register.php"><button class="btn-primary btn-lg btn-block mb-3">Sign Up</button></a>
            </div>
            </div> <!--col end-->
    </div> <!--row end-->

    <!-- Bootstrap JS Bundle for nav -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
<footer class="centerContent">Copyright &copy 2022 Wiki-Woo!</footer>
</html>
