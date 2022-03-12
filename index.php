<?php
//creating a database......
//INSERT INTO `notes` (`s.no_`, `title`, `description`, `timestamp`) VALUES ('1', 'Go to bed', 'Hey Everyone,\r\n\r\nI hope you all are doing well..!!', current_timestamp());
//INSERT INTO `notes` (`s.no_`, `title`, `description`, `timestamp`) VALUES ('2', 'wAKE-UP EARLY', 'Good morning Everyone,\r\n\r\nIt\'s time to get ready for school....', current_timestamp());
$insert=false;
$update=false;
$Delete=false;


$servername="localhost";
$username="root";
$password="";
$database="notes";

//create a connection..............

$conn= mysqli_connect($servername,$username,$password,$database);


//die if connection was not successful............
if(!$conn){
    die("sorry you are fail to connect:" . mysqli_connect_error());
}
//INSURT THE RECORDS.........

if(isset($_GET['Delete'])){
$s_no=$_GET['Delete'];
$Delete=true;
//echo $s_no;
  
//Delete a data.............
$sql="DELETE FROM `notes` WHERE `notes`.`s_no` =$s_no";
$result=mysqli_query($conn,$sql);
}
if($_SERVER['REQUEST_METHOD']=='POST'){
if(isset($_POST['s_noEdit'])){
  //update the record...........
  $s_no=$_POST["s_noEdit"];
  $title=$_POST["titleEdit"];
  $description=$_POST["descriptionEdit"];
  $sql="UPDATE `notes` SET `title` = '$title' , `description` = '$description' WHERE `notes`.`s_no` = $s_no";
  $result=mysqli_query($conn,$sql);
  

if($result){
  $update=true;

}
else {
  echo "<br>The table was not updated successfully because of error:";
}
}

//inserting normally..........
else{

  $title=$_POST["title"];
   $description=$_POST["description"];
   
   if(!empty($title)&&!empty($description)){

  // insurting inside table.........
  
    $sql="INSERT INTO `notes` (`title`, `description`) VALUES ('$title', '$description')";
    //$sql="INSERT INTO `festival` ( `name`, `role`, `day`, `fest_name`) VALUES ('$name','$role','$day','$fest_name')";
    $result=mysqli_query($conn,$sql);
    
  //check for the table creation success.............
    if($result){
     // echo "The recored has been successfully submitted <br>";
     $insert=true;
    }
   else {
      echo "<br>The recored has not been successfully submitted because of this error:". mysqli_error($conn);
    
    }
 }
 else{
  echo"<div class='alert alert-warning alert-dismissible fade show' role='alert'>
      <strong>PLEASE! Enter the data correctly, you have entered empty data!!!.
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
}
}
}



//echo "<br>connection was successful <br>";

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
    
    <title>PHP CRUD!</title>


  </head>
  <body>
    
  <!-- Edit Button trigger modal -->
<!--<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
Edit Modal
</button>-->

<!--Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLable" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit this note</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/CRUD-operation/index.php" method="POST">
      <div class="modal-body">
     
        <input type="hidden" name="s_noEdit" id="s_noEdit">

<div class="mb-3">
  <label for="title" class="form-label">Note title</label>
  <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">
</div>


<div class="mb-3">
  <label for="description" class="form-label">Note Description</label>
  <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>
</div>
<!--<button type="submit" class="btn btn-primary">update Note</button>-->

      </div>
      <div class="modal-footer d-block mr-auto">
        <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">update Note</button>
      </div>
      </form>
    </div>
  </div>
</div>


    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"><img src="/CRUD-operation/php-logo.jpg" width=50px height=40px alt=""></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact us</a>
            </li>
         
          </ul>
          
        </div>
      </div>
    </nav>
<?php
    //alert....

    if($insert){
      echo"<div class='alert alert-success alert-dismissible fade show' role='alert'>
      <strong>SUCCESSFULLY!</strong> Your notes has been submitted!!!.
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
    }
   ?>

<?php
    //alert....

    if($Delete){
      echo"<div class='alert alert-success alert-dismissible fade show' role='alert'>
      <strong>SUCCESSFULLY!</strong> Your notes has been deleted successfully!!!.
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
    }
   ?>

<?php
    //alert....

    if($update){
      echo"<div class='alert alert-success alert-dismissible fade show' role='alert'>
      <strong>SUCCESSFULLY!</strong> Your notes has been updated  successfully!!!.
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
    }
   ?>
    <!--<div class="container my-4">
      <h2>Write a Note to iNotes</h2>
      <form action="/CRUD-operation/index.php" method="POST">

        <div class="mb-3">
          <label for="title" class="form-label">Note title</label>
          <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
        </div>
        
     
        <div class="mb-3">
          <label for="description" class="form-label">Note Description</label>
          <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary"> Add-Note</button>
        
      </form>
    </div> -->

    <!-- Button trigger modal -->
    <div class="container">
      <button type="button" class="btn btn-primary my-4" data-bs-toggle="modal" data-bs-target="#add_note">
        Add-Note
      </button>
    </div>

<!-- Modal -->
<div class="modal fade" id="add_note" tabindex="-1" aria-labelledby="add_noteLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="add_noteLabel">Note title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>


      <div class="modal-body">
      <form action="/CRUD-operation/index.php" method="POST">

<div class="mb-3">
  <label for="title" class="form-label">Note title</label>
  <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
</div>


<div class="mb-3">
  <label for="description" class="form-label">Note Description</label>
  <textarea class="form-control" id="description" name="description" rows="3"></textarea>
</div>
<button type="submit" class="btn btn-primary"> Save-Note</button>

</form>
      
      </div>
    </div>
  </div>
</div>








    <div class="container my-4">
<table class="table" id="myTable">
  
  <thead>
    <tr>
      <th scope="col">s_no</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Action</th>
    </tr>
    <hr>
  </thead>
  <tbody>

  
  <?php
      $sql="SELECT * FROM `notes`";
      $result=mysqli_query($conn,$sql);
      $s_no=0;
    while($row=mysqli_fetch_assoc($result)){
      $s_no=$s_no +1;
      // echo $row['s.no_']." hello ".$row['name']." welcome to ".$row['dept'];
      echo"<tr>
      <th scope='row'> ". $s_no ."</th>
      <td>".$row['title']."</td>
      <td>".$row['description']."</td>
      <td>  <button class='edit btn btn-sm btn-primary' id=".$row['s_no'].">Edit</button> 
      <button class='Delete btn btn-sm btn-primary' id=d".$row['s_no'].">Delete</button> </td>
    </tr>";
    }
  
    ?>
    
  </tbody>
</table>
    </div>
    

    <!-- Optional JavaScript; choose one of the two! -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  


    <script src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>


    <script>
       $(document).ready( function () {
       $('#myTable').DataTable();
       } );
    </script>

<script>
  edits = document.getElementsByClassName('edit');
  Array.from(edits).forEach((element)=>{
    element.addEventListener("click", (e)=>{
      console.log("edit",);
      tr=e.target.parentNode.parentNode;
      title=tr.getElementsByTagName("td")[0].innerText;
      description=tr.getElementsByTagName("td")[1].innerText;
      console.log(title,description);
      titleEdit.value=title;
      descriptionEdit.value=description;
      s_noEdit.value=e.target.id;
      console.log(e.target.id)
      $('#editModal').modal('toggle');
      //editModal.toggle()
      
    })
  })

  Deletes = document.getElementsByClassName('Delete');
  Array.from(Deletes).forEach((element)=>{
    element.addEventListener("click", (e)=>{
      //console.log("edit",);
      s_no = e.target.id.substr(1,);
      //console.log(s_no);
      if(confirm("Are you sure you want to delete this note!")){
        console.log("yes");
        window.location=`/CRUD-operation/index.php?Delete=${s_no}`;
    //authentication system

    // create a form and use post request to submit a form.........


      }
      else{
        console.log("no");

      }
      
    })
  })
</script>
  </body>
  
</html>