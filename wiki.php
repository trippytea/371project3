<?php 
include('db.php'); //connect to database
include('nav.php'); //mobile responsive nav-bar
ensure_logged_in();


function outputArticle ($db) {
    if (isset ($_GET['short_title'])) { 
    $shortTitle = $_GET['short_title'];
    $result = mysqli_fetch_assoc($db -> query ("SELECT * FROM article where shortTitle = '$shortTitle'"));
        $title = $result['articleTitle'];
        $body = $result['articleBody'];
        $user = $result['username'];
        echo 
        "<h2 class='mb-3 mx-auto' style='width:500px'>$title</h6>
        <div class='articleFull mb-4 mx-auto'>
        <p style='color: #3BB3C2'>Written by $user</p> 
        <p class='mb-3'>$body</p>
        <span>
        <a href='index.php' style='text-decoration:none;'>Click here to return home</a>
        <br></br>
        <form action='updateArticle.php' method='GET'>
        <input type='hidden' name='short_title' value='$shortTitle'>
        <input type='submit' name='edit' value='edit'>
        </form>
        </div>";
    }
    else {
        echo "<h2>No article found.</h2><a href='index.php' style='text-decoration:none;'>Click here to return home</a>";
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

            <div class="articleBox mb-4 mt-3 mx-auto">
                <?= outputArticle($db) ?>
            </div>
        </div> <!--col end-->

    <!-- Bootstrap JS Bundle for nav -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
<footer class="centerContent">Copyright &copy 2022 Wiki-Woo!</footer>
</html>
