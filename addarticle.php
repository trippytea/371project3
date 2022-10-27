

<!--php outputs body element-->
<?php 
include 'db.php';
include 'nav.php'; //nav-bar

ensure_logged_in();
mysqli_report(MYSQLI_REPORT_STRICT);

# variable default values
$error = false;

# post process for when the button submit is activated
if (isset($_POST['addArticleButton'])){

    if($db === false){
        die("ERROR: Could not connect. ". mysqli_connect_error());
    }

    # required fields
    $required = array('articleTitle', 'articleBody', 'short_title');

    # checks required fields, sets empty var to true if one is empty
    foreach($required as $field) {
        if (empty($_POST[$field])) {
            $error = true;
        }
    }

    # if fields are empty sets requiredError var, else it moves on
    if ($error) {
        $requiredError="please enter a team name and select all fields";
    } else {
	    $error= false;
        
        #db variables and checks for escape strings
        $articleTitle= mysqli_real_escape_string(
        $db, $_REQUEST['articleTitle']);
        $articleBody = mysqli_real_escape_string(
        $db, $_REQUEST['articleBody']);
        $short_title = mysqli_real_escape_string(
        $db, $_REQUEST['short_title']);
        $name = $_SESSION['name'];
        
        $sql = "INSERT INTO article (articleTitle, articleBody, username, shortTitle)
        VALUES ('$articleTitle','$articleBody','$name', '$short_title')";

        #ERROR MESSAGE
        # attempts the sql insert, if it fails the uniqueError is set
        if(mysqli_query($db, $sql)){
            header("location:addArticle.php?articleAdded");
            exit();
        } else {
            if(mysqli_errno($db) == 1062)
            header("location:ArticleError.php?articleError");
            exit();
        }
    } 
}
?>

<!DOCTYPE html>
<html lang="en-us">
<html> 
    <head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Create Article</title>

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
        <h1 style='margin-left: 10px;margin-top: 15px'>Add New Article</h1>
        <?=$promptMessage();?>

        <form style='margin-left: 15px' id='createArticle' action='addArticle.php' method='POST'>
            <span> <strong>Article Short Title</strong></span><br>
            <input style='width: 155px' type='text' id='short_title' name='short_title' maxlength='16' required>
            <br><br>
            <span> <strong>Article Title</strong> </span><br>
            <input style='width: 30%;' type='text' id='articleTitle' name='articleTitle' required>
            <br><br>
            <span> <strong>Article Body</strong> </span><br>
            <!-- i wonder if we could use a template for a text editor box -->
            <textarea type='text' style='width: 45%;   height: 250px' id='articleBody' name='articleBody'></textarea>
            <br><br>
            <button class="btn-primary btn-lg btn-block mb-3" type="submit" id='addArticleButton' name='addArticleButton' value='Add'>Add</button>
        </form>
    </div>

    <!-- Bootstrap JS Bundle with Popper ***needed for navbar collapse*** -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
    <footer class="centerContent">Copyright &copy 2022 Wiki-Woo!</footer>
</html>
