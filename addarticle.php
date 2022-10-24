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

<!--php outputs body element-->
<?php 
include 'db.php';
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
    $required = array('articleTitle', 'articleBody');

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
        
        $sql = "INSERT INTO team (articeTitle, articelBody, username)
        VALUES ('$articleTitle','$articleBody','$_SESSION["name"]')";

        #ERROR MESSAGE
        # attempts the sql insert, if it fails the uniqueError is set
        if(mysqli_query($db, $sql)){
            #header("location:create-teams.php?teamAdded");
            exit();
        } else {
            if(mysqli_errno($db) == 1062)
            #header("location:create-teams.php?duplicateTeam");
            exit();
        }
    } 
}
?>
<body>
    <div style='margin-left: 20px;margin-top: 10px'>   
        <h1 style='margin-left: 10px;margin-top: 15px'>Add New Article</h1>
        <?=$promptMessage();?>

        <form style='margin-left: 15px' id='createteams' action='create-teams.php' method='POST'>
            <span> Article Title </span><br>
            <input type='text' id='articleTitle' name='articleTitle'
            placeholder='Enter a title for the article' required>
            <br><br>
            <span> Article Body </span><br>
            <!-- i wonder if we could use a template for a text editor box -->
            <textarea type='text' id='articleBody' name='articleBody'>
            <br><br>
            <input class='Add navbar-dark navbar-brand ' type='submit' id='addArticleButton' name='addArticleButton' value='Add'>
        </form>
    </div>

    
    <!-- Bootstrap JS Bundle with Popper ***needed for navbar collapse*** -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
    <footer class="centerContent">simpleWIKI</footer> -->
</html>

 