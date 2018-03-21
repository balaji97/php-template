<?php
session_start();
?>


<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="nitc.png">

<style>

body{
    background-color: #f2f2f2;
}

input[type=submit] {
    background-color: #4CAF50;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button{
    background-color: #4CAF90;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;

}

input[type=text], select, textarea{
    width: 90%; /* Full width */
    padding: 12px; /* Some padding */ 
    border: 1px solid #ccc; /* Gray border */
    border-radius: 4px; /* Rounded borders */
    box-sizing: border-box; /* Make sure that padding and width stays in place */
    margin-top: 6px; /* Add a top margin */
    margin-bottom: 16px; /* Bottom margin */
    resize: vertical /* Allow the user to vertically resize the textarea (not horizontally) */
}

</style>
</head>


<body>
    <a href="logout.php"><img src="123.png" height="50px" width="50px"></a>
<center>
<h1>NATIONAL INSTITUTE OF TECHNOLOGY CALICUT</h1>
<h2>phD Student Project Management System</h2></center>
<br><br>

<center><button onclick="window.location.href='add.php'">Add New Project</button></center>
<br><br>

<form action="search.php" method="POST">
<input type="text" name="search" placeholder="Search by RollNo or Name">
<input type="submit" value="search">
</form>
<form action="searchStatus.php" method="POST">
<label >Search by status</label>
<select  id = 'status' name="status">
<option value="">Select the option</option>    
<option value="option1">option1</option>
<option value="option2">option2</option>
<option value="option3">option3</option>
<option value="option4">option4</option>
<option value="option5">option5</option>
<option value="option6">option6</option>
<option value="option7">option7</option>
<option value="option8">option8</option>
<option value="option9">option9</option>
<option value="option10">option10</option>
</select>
<input type="submit" value="search">
</form>


<?php



$roll="";
    

$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$servername = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);
// Create connection
$conn = new mysqli($servername, $username, $password, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}




$sql = "SELECT name,project.rollno,email,department,guide,guidemail,topic,status,date
FROM project,mtechstudent 
where project.rollno=mtechstudent.rollno";
$result= mysqli_query($conn, $sql);
$availability=0;

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
              
             $availability=1;
              $roll=$row['rollno'];

  ?>
          <div style="width: 30%;float:left;padding: 15px;background-color: #e9dbd8;margin: 5px" >
           
            <?php
  echo  "<h4>Name:  " . $row["name"]."<br> ". " Roll No :  " . $row["rollno"]. " <br> ". " Project : " . $row["topic"]. "<br> "." Guided By: " . $row["guide"]."<br>  ".  "Present Status : " . $row["status"]."<br>  ". "Modified Date : " . $row["date"]."<br>" ; 

?>
<br>
<center>
 <form action="edit.php" method="post" >
  <input type="hidden" name="rollno" value=<?php echo $roll ?> >
  <input type="submit" value="Edit">
</form>
<br>
 <form action="history.php" method="post" >
  <input type="hidden" name="rollno" value=<?php echo $roll ?> >
  <input type="submit" value="History">
</form>


</center>
</div>

<?php
}
}



if($availability==0)
{

  ?>
 <center>
  <?php
  echo "<br><br><br>";
   echo "No projects are available";
}

                  
mysqli_close($conn);
?> 
    </center>
    <footer style="position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    background-color: #333;
    color: white;
    text-align: center;"
  <center>
  
  Logged in as :
    <?php
     echo $_SESSION['username'];
     ?>
  
  </center>
</footer>
   
</body>
</html>



</body>
</html>
