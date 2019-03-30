<?php 

    // include the config file that we created last week
    require "config.php";
    require "common.php";
    //simple if/else statement to check if the id is available

    if (isset($_POST['submit'])) {
        try {
            $connection = new PDO($dsn, $username, $password, $options);  
            
            
            } catch(PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    }

    //grab elements from form and set as varaible
    $work =[
        "id"         => $_POST['id'],
        "director" => $_POST['director'],
        "movietitle"  => $_POST['movietitle'],
        "releasedate"   => $_POST['releasedate'],
        "genre"   => $_POST['genre'],
        "date"   => $_POST['date'],
      ];
  
      // create SQL statement
      $sql = "UPDATE `movies` 
              SET id = :id, 
                  director = :director, 
                  movietitle = :movietitle, 
                  releasedate = :releasedate, 
                  genre = :genre, 
                  date = :date 
              WHERE id = :id";
  
      //prepare sql statement
      $statement = $connection->prepare($sql);
  
      //execute sql statement
      $statement->execute($work);

    if (isset($_GET['id'])) {
        //yes the id exists 
        
        // quickly show the id on the page
        echo $_GET['id'];

        try {
            // standard db connection
            $connection = new PDO($dsn, $username, $password, $options);
            
            // set if as variable
            $id = $_GET['id'];
            
            //select statement to get the right data
            $sql = "SELECT * FROM movies WHERE id = :id";
            
            // prepare the connection
            $statement = $connection->prepare($sql);
            
            //bind the id to the PDO id
            $statement->bindValue(':id', $id);
            
            // now execute the statement
            $statement->execute();
            
            // attach the sql statement to the new work variable so we can access it in the form
            $work = $statement->fetch(PDO::FETCH_ASSOC);
            
        } catch(PDOExcpetion $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
        
    } else {
        // no id, show error
        echo "No id - something went wrong";
        //exit;
    }
?>

<?php include "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) : ?>
	<p>Work successfully updated.</p>
<?php endif; ?>

<h2>Edit A Work</h2>

<form method="post">
    
    <label for="id">ID</label>
    <input type="text" name="id" id="id" value="<?php echo escape($work['id']); ?>" >

    <label for="director">Director</label>
    <input type="text" name="director" id="director" value="<?php echo escape($work['director']); ?>">

    <label for="movietitle">Movie Title</label>
    <input type="text" name="movietitle" id="movietitle" value="<?php echo escape($work['movietitle']); ?>">

    <label for="releasedate">Release Date</label>
    <input type="text" name="releasedate" id="releasedate" value="<?php echo escape($work['releasedate']); ?>">

    <label for="genre">Genre</label>
    <input type="text" name="genre" id="genre" value="<?php echo escape($work['movietitle']); ?>">

    <input type="submit" name="submit" value="Submit">

</form>

<?php include "templates/footer.php"; ?>