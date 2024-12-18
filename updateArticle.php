<?php
include 'db.php';
include 'nav.php'; //nav-bar

ensure_logged_in();
mysqli_report(MYSQLI_REPORT_STRICT);
if (isset ($_GET['short_title'])) { 
    $shortTitle = $_GET['short_title'];
}
if (isset ($_POST['short_title'])) { 
    $shortTitle = $_POST['short_title'];
}

$sql = "SELECT * FROM article WHERE shortTitle = '$shortTitle'";
$article = mysqli_query($db, $sql);
$row = mysqli_fetch_array($article);
?>


<!DOCTYPE html>
<html lang="en-us">
<html> 
    <head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Update Article</title>

    <!--Open Sans Font--> 
    <link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Open+Sans' />

    <!-- Bootstrap CSS -->
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css' 
    rel='stylesheet' integrity='sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC' crossorigin='anonymous'> 

    <!-- Font Awesome icon library -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css'>

    <!-- custom CSS Stylesheet -->	  
    <link rel='stylesheet' type='text/css' href='styles.css';>
</head>
<body>
    <div style='margin-left: 20px;margin-top: 10px'>   
        <h1 style='margin-left: 10px;margin-top: 15px'>Update Article</h1>
        <?=$promptMessage();?>

        <form style='margin-left: 15px' id='createArticle' action='updateArticle.php' method='POST'>
        <!--<span> Enter the name of the article you want to change below: </span><br>
            <input style='width: 500px' type='text' id='articleTitle' name='articleTitle' required>
            <br><br>-->
            <span> Edit Title </span><br>
            <textarea style='width: 500px' type='text' id='newArticleTitle' name='newArticleTitle' required><?=$row['articleTitle']?></textarea>
            <br><br>
            <span> Edit Short Title </span><br>
            <textarea style='width: 500px' type='text' id='short_title' name='short_title' required><?=$row['shortTitle']?></textarea>
            <br><br>
            <span> Edit Article Body </span><br>
            <!-- i wonder if we could use a template for a text editor box -->
            <textarea type='text' style='width: 98%;   height: 250px' id='articleBody' name='articleBody'><?=$row['articleBody']?></textarea>
            <br><br>
            <input class='Add navbar-dark navbar-brand ' type='hidden' id='articleTitle' name='articleTitle' value='<?=$row['articleTitle']?>'>
            <button class="btn-primary btn-lg btn-block mb-3" type="submit" id='addArticleButton' name='addArticleButton' value='Add'>Update</button>
        </form>
    </div>

    <!-- Bootstrap JS Bundle with Popper ***needed for navbar collapse*** -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
    <footer class="centerContent">Copyright &copy 2022 Wiki-Woo!</footer>
</html>
<?php
if (isset($_POST['addArticleButton'])){
    $articleTitle = $_POST['articleTitle'];
    $newArticleTitle = $_POST['newArticleTitle'];
    $articleBody = $_POST['articleBody'];
    $shortTitle = $_POST['short_title'];
	$updateSql = "update article set articleTitle='$newArticleTitle',articleBody='$articleBody',shortTitle='$shortTitle' WHERE articleTitle='$articleTitle'";
	$updatedArticle = mysqli_query($db, $updateSql);
    
    ?>
    <script type="text/javascript">
    window.location="index.php?updateteamsuccess";
    </script>
    <?php
    
}
    ?>