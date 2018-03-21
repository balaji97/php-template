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

input[type=text], select, textarea{
    width: 100%; /* Full width */
    padding: 12px; /* Some padding */ 
    border: 1px solid #ccc; /* Gray border */
    border-radius: 4px; /* Rounded borders */
    box-sizing: border-box; /* Make sure that padding and width stays in place */
    margin-top: 6px; /* Add a top margin */
    margin-bottom: 16px; /* Bottom margin */
    resize: vertical /* Allow the user to vertically resize the textarea (not horizontally) */
}

input[type=date], select, textarea{
    width: 100%; /* Full width */
    padding: 12px; /* Some padding */ 
    border: 1px solid #ccc; /* Gray border */
    border-radius: 4px; /* Rounded borders */
    box-sizing: border-box; /* Make sure that padding and width stays in place */
    margin-top: 6px; /* Add a top margin */
    margin-bottom: 16px; /* Bottom margin */
    resize: vertical /* Allow the user to vertically resize the textarea (not horizontally) */
}

input[type=time], select, textarea{
    width: 100%; /* Full width */
    padding: 12px; /* Some padding */ 
    border: 1px solid #ccc; /* Gray border */
    border-radius: 4px; /* Rounded borders */
    box-sizing: border-box; /* Make sure that padding and width stays in place */
    margin-top: 6px; /* Add a top margin */
    margin-bottom: 16px; /* Bottom margin */
    resize: vertical /* Allow the user to vertically resize the textarea (not horizontally) */
}


input[type=file], select, textarea{
    width: 100%; /* Full width */
    padding: 12px; /* Some padding */ 
    border: 1px solid #ccc; /* Gray border */
    border-radius: 4px; /* Rounded borders */
    box-sizing: border-box; /* Make sure that padding and width stays in place */
    margin-top: 6px; /* Add a top margin */
    margin-bottom: 16px; /* Bottom margin */
    resize: vertical /* Allow the user to vertically resize the textarea (not horizontally) */
}

/* Style the submit button with a specific background color etc */
input[type=submit] {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

/* When moving the mouse over the submit button, add a darker green color */
input[type=submit]:hover {
    background-color: #45a049;
}

/* Add a background color and some padding around the form */
.container {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
}

</style>


</head>


<body>
<a href="adminhome.php"><img src="back.png" height="50px" width="50px"></a>

<center>
<h1>NATIONAL INSTITUTE OF TECHNOLOGY CALICUT</h1>
<h2>PHD Student Project Management System</h2></center>
<br><br>

<?php
    
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

$rollno=mysqli_real_escape_string($conn, $_POST['rollno']);

$sql = "SELECT name,project.rollno,email,department,guide,guidemail,topic,status,date
FROM project,mtechstudent 
where project.rollno=mtechstudent.rollno
 and project.rollno='$rollno'";
$result= mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
            $roll=$row['rollno'];
  ?>


          <div style="padding: 15px;background-color: #e9dbd8;" >
           
    <?php
  echo  "<h4>Name:  " . $row["name"]."<br> ". " Roll No :  " . $row["rollno"]. " <br> ". " Project : " . $row["topic"]. "<br> "." Guided By: " . $row["guide"]."<br>  ".  "Present Status : " . $row["status"]."<br>  ". "Modified Date : " . $row["date"]."<br>" ; 

}
}


                  
mysqli_close($conn);
?> 
</div>
<br><br>

<form action="editsave.php" method="POST" onsubmit="return confirm('Do you really want to submit the form?');">
<label >New status of the project</label>
<select  name="status">
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
    
<br>
<label >Modified Date</label>
<input type="date"  name="date" placeholder="Date" required="true">

<input type="hidden" name="rollno" value=<?php echo $roll ?> >
<input type="submit" value="Save">
</form>



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
