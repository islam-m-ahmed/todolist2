<?php 
    $connect = mysqli_connect("localhost","root","","todos");
    if(mysqli_connect_errno()){
        $errormassage = "database connect faild:" . mysqli_connect_error();
        exit($errormassage);
    }
    if(isset($_POST['todo'])){
      $todo = $_POST['todo'];
      $query1 = "insert into todo(task) values('$todo')";
      mysqli_query($connect, $query1);
    }
    if(isset($_GET['complete1'])){
      $todo1 = $_GET['complete1'];
      $query2 = "Update todo set complete=1 where id=$todo1";
      mysqli_query($connect, $query2);
    }
    if(isset($_GET['delete'])){
      $todo2 = $_GET['delete'];
      $query3 = "delete from todo where id= $todo2";
      mysqli_query($connect, $query3);
    }
    $query = "select * from todo;";
    $todos = mysqli_query($connect, $query);
    
    ;
    $new = [];
    while($record = mysqli_fetch_assoc($todos)){
        array_push($new, $record);
    }
    //  header("Location: #");
    
    
    mysqli_free_result($todos);
    mysqli_close($connect);
   
        
  
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>todo list</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" > -->
    <!-- <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

</head>
<body>
    <div class="container">
        <div class="b-sloid"></div>
        <h1 class="display-2 m-4 ">todo list</h1>
        <form action="/todolist/todolist1/todo.php" method="POST" class="flex m-4">
            <div class="row m-4">
                <div class="col-8 mx-0">
                    <input name="todo" type="text" required style="margin-left: -33px;" placeholder="type a todo" class="form-control "> 
                </div>
                <div class="col-4 mx-0">
                    <button class="btn btn-primary btn1 " type="submit"><i class="fa fa-plus" aria-hidden="true"></i> </button>
               <script>
                 let submit = document.getElementsByClassName('btn1');
                 submit.addEventListener("click",function(e){
                   e.preventDefault();
                 });
               </script>
                  </div>
            </div>
        </form>
        <table class="table table-hover table-dark	 table-responsive-sm mt-5 m-4 w-75	 table-striped">
            <thead>
              <tr>
                <th>completed</th>
                <th>task</th>
                <th>time</th>
                <th>delete</th>

              </tr>
            </thead>
            <tbody>
            <?php foreach($new as $one): ?>
              <tr>
                <td>
                <?php if($one['complete'] == 1){?>
                    <button class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i> completed</button> 
                     <?php }else  { ?>
                      <a href="?complete1=<?php echo $one['id'];?>">
                      <button class="btn btn-secondary"><i class="fas fa-window-close"></i></button>
                     <?php } ?>
                </td>
                <td><?php echo $one['task'] ?></td>
                <td><?php echo $one['time']?></td>
                <td>
                  <a href="?delete=<?php echo $one['id']; ?> ">
                <button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
              </td>
              
              </tr>
              <?php endforeach ?>
            </tbody>
          </table>
   
</div>


    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></scrip> -->
</body>
</html>