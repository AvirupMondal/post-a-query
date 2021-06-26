<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Post A Query</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="final_style.css">
    <script src="https://kit.fontawesome.com/4c872ebd2d.js" crossorigin="anonymous"></script>
</head>
<body style="overflow-y:hidden">
  <div class="container-fluid">
    <div class="row welcome_body">
    <img src="images/logo.png" class="col-6 paq" style="width:15rem; height:15rem " alt="">
      <h3 class="text-center">POST A QUERY</h3>
      <h5 class="text-center">Solution to All Your Queries</h5>
      <div id="secondsdisplay">
      
      </div> <img src="images/bg3-01.png" style="height:600px" class="col-12" alt="">
      </div>
  </div>
  
      
    
  <script>
    var seconds=5;
    function displayseconds(){
      seconds -=1;
      document.getElementById("secondsdisplay").innerText="This Page Will Be Redirected in "+seconds+" Seconds ...";
    }
    setInterval(displayseconds,1000);
    function pageredirect(){
      window.location="login.php"
    }
    setTimeout('pageredirect()',4000);
  </script>
</body>
</html>