<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php
$_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
 Confirm_Login(); ?>
<?php
if(isset($_POST["Submit"])){
  $Username        = $_POST["Username"];
  $Name            = $_POST["Name"];
  $Admin = $_SESSION["UserName"];
  $Role = $_POST["Role"];    
 

  if(empty($Username)){
    $_SESSION["ErrorMessage"]= "All fields must be filled out";
    Redirect_to("Admintest.php");
  }elseif (strlen($Username)<3) {
    $_SESSION["ErrorMessage"]= "Category title should be greater than 2 characters";
    Redirect_to("Admintest.php");
  }elseif (strlen($Username)>49) {
    $_SESSION["ErrorMessage"]= "Category title should be less than than 50 characters";
    Redirect_to("Admintest.php");
  }else{
    // Query to insert category in DB When everything is fine
    global $ConnectingDB;
    $sql = "INSERT INTO Staff(Name,Username,Added_By,RoleID)";
    $sql .= "VALUES(:username,:name,:adminName,:role)";
    $stmt = $ConnectingDB->prepare($sql);
    $stmt->bindValue(':username',$Username);
    $stmt->bindValue(':name',$Name);
    $stmt->bindValue(':adminName',$Admin);
    $stmt->bindValue(':role',$Role);
    $Execute=$stmt->execute();

    if($Execute){
      $_SESSION["SuccessMessage"]="Member has been created Successfully";
      Redirect_to("Admintest.php");
    }else {
      $_SESSION["ErrorMessage"]= "Something went wrong. Try Again !";
      Redirect_to("Admintest.php");
    }
  }
} //Ending of Submit Button If-Condition
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="stylesheet" href="Css/Styles.css">
  <title>Categories</title>
</head>
<body>
  <!-- NAVBAR -->
  <div style="height:10px; background:#27aae1;"></div>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a href="/" class="navbar-brand"> GucciGang Enterprise</a>
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarcollapseCMS">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
        <a href="MyProfile.php" class="nav-link"> <i class="fas fa-user text-success"></i> My Profile</a>
        </li>
        <li class="nav-item">
          <a href="Dashboard.php" class="nav-link">Dashboard</a>
        </li>
        <li class="nav-item">
          <a href="Posts.php" class="nav-link">Posts</a>
        </li>
        <li class="nav-item">
          <a href="Categories.php" class="nav-link">Categories</a>
        </li>
           <li class="nav-item">
          <a href="Departments.php" class="nav-link">Departments</a>
        </li>
        <li class="nav-item">
          <a href="Admins.php" class="nav-link">Members</a>
        </li>
        <li class="nav-item">
          <a href="Comments.php" class="nav-link">Comments</a>
        </li>
         <li class="nav-item">
          <a href="Statistics.php" class="nav-link">Statistics</a>
        </li>  
        
        <li class="nav-item">
          <a href="Blog.php?page=1" class="nav-link" target="_blank">View Ideas</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a href="Logout.php" class="nav-link text-danger">
          <i class="fas fa-user-times"></i> Logout</a></li>
      </div>
    </div>
  </nav>
    <div style="height:10px; background:#27aae1;"></div>
    <!-- NAVBAR END -->
    <!-- HEADER -->
    <header class="bg-dark text-white py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
          <h1><i class="fas fa-edit" style="color:#27aae1;"></i> Manage Members</h1>
          </div>
        </div>
      </div>
    </header>
    <!-- HEADER END -->

     <!-- Main Area -->
<section class="container py-2 mb-4">
  <div class="row">
    <div class="offset-lg-1 col-lg-10" style="min-height:400px;">
      <?php
       echo ErrorMessage();
       echo SuccessMessage();
       ?>
      <form class="" action="Admintest.php" method="post">
        <div class="card bg-secondary text-light mb-3">
          <div class="card-header">
            <h1>Add New Member</h1>
          </div>
          <div class="card-body bg-dark">
            <div class="form-group">
              <label for="Username"> <span class="FieldInfo"> Username: </span></label>
               <input class="form-control" type="text" name="Username" id="Username" placeholder="Please Enter the Username for new member" value="">
          
              
                 
            <div class="form-group">
              <label for="Name"> <span class="FieldInfo"> Name: </span></label>
               <input class="form-control" type="text" name="Name" id="Name" placeholder="Please Enter Name of new member" value="">
                      </div>
                
                <div class="form-group">
			<label><span class="FieldInfo">Role</span></label>
			<select name="Role" id="Role" >
				<option value=""></option>
				<option value="1">Staff</option>
				<option value="2">QA Coordinator</option>
                <option value="3">QA Manager</option>
                <option value="4">Admin</option>
			</select>
                </div> 
                
                
                
            </div>
            <div class="row">
              <div class="col-lg-6 mb-2">
                <a href="Dashboard.php" class="btn btn-warning btn-block"><i class="fas fa-arrow-left"></i> Back To Dashboard</a>
              </div>
              <div class="col-lg-6 mb-2">
                <button type="submit" name="Submit" class="btn btn-success btn-block">
                  <i class="fas fa-check"></i> Publish
                </button>
              </div>
            </div>
          </div>
        </div>
      </form>
      <h2>Existing Staff</h2>
      <table class="table table-striped table-hover">
        <thead class="thead-dark">
          <tr>
          
               <th>Username </th>
            <th>  Name</th>
               <th>Email</th>
            <th>Created By</th>
            <th>Date Created</th>
              <th>Last Login</th>
            <th>Roles</th>
            <th>Edit</th>
              <th>Delete</th>
          </tr>
        </thead>
      <?php
      global $ConnectingDB;
      $sql = "SELECT Staff.Username, Staff.Name, Staff.Added_By, Staff.Date_Joined, Staff.Email, Staff.Last_Logged, Roles.Roles
FROM Staff
Left JOIN Roles
ON Staff.RoleID = Roles.RoleID
Order by Date_Joined DESC";
      $Execute =$ConnectingDB->query($sql);
      
      while ($DataRows=$Execute->fetch()) {
      
            $Username = $DataRows["Username"];
            $Name = $DataRows["Name"];
            $Email = $DataRows["Email"];
            $CreatorName= $DataRows["Added_By"];
            $UserDate = $DataRows["Date_Joined"];
            $Lastl = $DataRows["Last_Logged"];
            $Role = $DataRows["Roles"];
       
              
        
      ?>
      <tbody>
        <tr>
          
                <td><?php echo htmlentities($Username); ?></td>
            
          <td><?php echo htmlentities($Name); ?></td>
          <td><?php echo htmlentities($Email); ?></td>
          <td><?php echo htmlentities($CreatorName); ?></td>
          <td><?php echo htmlentities($UserDate); ?></td>
              <td><?php echo htmlentities($Lastl); ?></td>
            <td><?php echo htmlentities($Role); ?></td>
   
           <td>  <a href="EditMembers.php?id=<?php echo $Id; ?>"><span class="btn btn-warning">Edit</span></a></td>
          <td> <a href="DeleteCategory.php?id=<?php echo $CategoryId;?>" class="btn btn-danger">Delete</a>  </td>

      </tbody>
      <?php } ?>
      </table>
    </div>
  </div>

</section>



    <!-- End Main Area -->
    <!-- FOOTER -->
  <?php include("footer-global.php"); ?>
    <!-- FOOTER END-->

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script>
  $('#year').text(new Date().getFullYear());
</script>
</body>
</html>
