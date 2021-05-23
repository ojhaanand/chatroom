<?php
$roomname=$_GET['room'];
//$user=$_GET['username'];

include "_dbconnect.php";

$sql= "SELECT * FROM `chat` WHERE roomname='$roomname'";
$result=mysqli_query($conn,$sql);
$numrows=mysqli_num_rows($result);
if($result){
    if($numrows==0){
        $message ="The room does not exist. Try finding new one";
    echo '<script language="javascript">';
    echo 'alert("' . $message . '");';
    echo 'window.location="http://localhost:8080/chatroom";';  //not showing an alert box.
  echo '</script>';
    }
}
else{
    echo 'Error: '. mysqli_error($conn);
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/product/">



    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="css/product.css" rel="stylesheet">

    <style>
    body {
        margin: 0 auto;
        max-width: 800px;
        padding: 0 20px;
    }

    .container {
        border: 2px solid #dedede;
        background-color: #f1f1f1;
        border-radius: 5px;
        padding: 10px;
        margin: 10px 0;

    }

    #anyclass {
        height: 350px;
        overflow-y: scroll;
    }

    .darker {
        border-color: #ccc;
        background-color: #ddd;
    }

    .container::after {
        content: "";
        clear: both;
        display: table;
    }

    .container img {
        float: left;
        max-width: 60px;
        width: 100%;
        margin-right: 20px;
        border-radius: 50%;
    }

    .container img.right {
        float: right;
        margin-left: 20px;
        margin-right: 0;
    }

    .time-right {
        float: right;
        color: #aaa;
    }

    .time-left {
        float: left;
        color: #999;
    }
    </style>
</head>

<body>
    <header class="site-header sticky-top ">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">MY CHATROOM</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
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
                            <a class="nav-link" href="#">Contact</a>
                        </li>


                    </ul>

                    <button class="btn btn-outline-success" type="submit">Signup</button>

                </div>
            </div>
        </nav>
    </header>

    <h2>Chat Messages -<?php echo "$roomname"?></h2>
    <div class="container">
        <div class="anyclass" id="anyclass">
            <img src="user.jpg" alt="" style="width:100%;">
            <p>Hello. How are you today?</p>
            <span class="time-right">11:00</span>
        </div>
       
    </div>
    


    <input type="text" class="form-control" name="usermsg" id="usermsg" placehoder="Type message">
    <button class="btn btn-primary mt-2" name="submsg" id="submsg" type="submit">Send</button>

   
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
        integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script type="text/javascript">
    setInterval(runFunction, 8000);
    function runFunction(){
        $.post("htcot.php", {room: '<?php echo $roomname?>'},
        function(data, status){
            document.getElementsByClassName('anyclass')[0].innerHTML=data;
        }
        )
    }

    var input = document.getElementById("usermsg");

// Execute a function when the user releases a key on the keyboard
input.addEventListener("keyup", function(event) {
  // Number 13 is the "Enter" key on the keyboard
  event.preventDefault();
  if (event.keyCode ===13 ) {
    // Cancel the default action, if needed
    
    // Trigger the button element with a click
    document.getElementById("submsg").click();
  }
});
    
    $("#submsg").click(function() {
        var clientmsg= $("#usermsg").val();
        $.post("postmsg.php", {text: clientmsg , room: '<?php echo $roomname?>' , ip: '<?php echo $_SERVER['REMOTE_ADDR']?>'},
          function(data, status){
                document.getElementsByClassName('anyclass')[0].innerHTML = data;});
            
             $('#usermsg').val('');
            return false;
    });
    </script>

</body>

</html>