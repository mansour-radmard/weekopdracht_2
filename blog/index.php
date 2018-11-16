<?php
include_once ("resources/lib/config.php"); // Server and database configuration

$query = "SELECT * FROM posts ORDER BY id DESC";  // Select all posts mysql query

// perfoms the mysql query on databse with given database and server configuration
$result = mysqli_query($conn, $query);

// Check number of rows received from database
$resultCheck = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <!-- Important meta tags -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Title -->
  <title>Blog</title>

  <!-- Favicon -->
  <link rel="shortcut icon" href="#">

  <!-- Google fonts -->
  <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:300i,400,400i,700,700i,800,800i|PT+Sans:400,700,700i" rel="stylesheet">

  <!-- Fontawesome -->
  <link rel="stylesheet" href="resources/icons/css/font-awesome.min.css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

  <!-- Custom CSS -->
  <link rel="stylesheet" type="text/css" href="vendors/css/normalize.css">
  <link rel="stylesheet" type="text/css" href="resources/css/style.css">
  <link rel="stylesheet" type="text/css" href="resources/css/queries.css">

</head>

<body>
<header>
   <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top nav-custom">
      <div class="container">
        <a class="navbar-brand" href="#">
          Blog </a> <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
              <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                  <a class="nav-link smooth-scroll" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link smooth-scroll" href="post.php">New post</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link smooth-scroll" href="#contact-section">Contact</a>
                </li>
              </ul>
            </div>
      </div>
    </nav>
</header>

<div class="container">
   <div class="row text-center">
      <div class="col-md-12">
         Blog / CodeGorilla
      </div>
   </div>
   <div class="row text-center">
      <div class="col-md-12">
         <div>
            <h1>Begin aan een nieuw leven als <br />IT-professional samen met CodeGorilla.</h1>
         </div>
      </div>
   </div>
   <div class="row text-center">
      <div class="col-md-12">
         <h6 id="name">Written by <br/>
         Mansour Radmard</h6>
         <h6 id="date">13.11.2018</h6>
      </b/>
      </div>
   </div>

   <?php
// If number of rows are bigger than 0
if ($resultCheck > 0) {
    while ($row = mysqli_fetch_assoc($result)) { // convert the received datatype object into associative array (value=>key) pair
        ?>

   <div class="row">
      <div class="col-md-6 offset-md-3">
         <div class="item-box">
             <h1 class="blog-title"><?php echo $row['title']; ?></h1>
             <div class="date">Published on: <?php echo $row['date']; ?></div>
            <p class="blog-content"><?php echo $row['content']; ?></p>
            <button class="btn btn-danger" onclick="deleteBlog(<?php echo $row['id']; ?>)">Delete</button>
         </div>
      </div>
   </div>

   <?php
}
}
?>

</div>




<!-- JQuery -->
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<!-- Custom JS -->
<script src="resources/js/custom.js"></script>

<!-- Ajax call function to delete a blog post-->
<script>

   // Ajax call function, calls php delete script with the id of the post as a parameter in the function
   function deleteBlog(id){
      if(confirm('Are you sure to delete this blog?')){
         $.ajax({
            type: 'POST',
            url: 'resources/lib/delete_post.php',
            data: {
               delete_id: id
            }
         });
      }
      location.reload(); // reload the page after delete is completed
   }

</script>

</body>
</html>
