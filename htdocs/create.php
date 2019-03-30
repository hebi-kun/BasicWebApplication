<?php 
// this code will only execute after the submit button is clicked
if (isset($_POST['submit'])) {
	
    // include the config file that we created before
    require "config.php"; 
    
    // this is called a try/catch statement 
	try {
        // FIRST: Connect to the database
        $connection = new PDO($dsn, $username, $password, $options);
		
        // SECOND: Get the contents of the form and store it in an array
        $new_work = array( 
            "director" => $_POST['director'], 
            "movietitle" => $_POST['movietitle'],
            "releasedate" => $_POST['releasedate'],
            "genre" => $_POST['genre'], 
        );
        
        // THIRD: Turn the array into a SQL statement
        $sql = "INSERT INTO movies (director, movietitle, releasedate, genre) VALUES (:director, :movietitle, :releasedate, :genre)";        
        
        // FOURTH: Now write the SQL to the database
        $statement = $connection->prepare($sql);
        $statement->execute($new_work);
	} catch(PDOException $error) {
        // if there is an error, tell us what it is
		echo $sql . "<br>" . $error->getMessage();
	}	
}
?>


<?php include "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) { ?>
<p>Movie Added!</p>
<?php } ?>
<form method="post">
    <label for="director">Director</label>
    <input type="text" name="director" id="director">

    <label for="movietitle">Movie Title</label>
    <input type="text" name="movietitle" id="movietitle">

    <label for="releasedate">Release Date</label>
    <input type="text" name="releasedate" id="releasedate">

    <label for="genre">Genre</label>
    <input type="text" name="genre" id="genre">

    <input type="submit" name="submit" value="Submit">

</form>

<?php include "templates/footer.php"; ?>