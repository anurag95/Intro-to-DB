<!DOCTYPE html>
<html lang="en">
<head>
    <title>Mill Order</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="css/starter-template.css" rel="stylesheet" />
    <script src="css/ie-emulation-modes-warning.js"></script>
</head>

  <body>
     <?php
      session_start();
      if(!isset($_SESSION['views'])){
        echo "<script>alert('You must be logged in'); location.href = 'signin.php'</script>";
      }
      else if($_SESSION['type'] == 'employee'){
        echo "<script>alert('You have to be logged in as admin'); location.href = 'index.php'</script>";
      }
    ?>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Cloth Lining Shop</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
            <li><a href="Retailorder.php">Retail Order</a></li>
            <li class='active'><a href="millorder.php">Mill Order</a></li>
            <li><a href="millsheet.php">Mill Balance Sheet</a></li>
            <li><a href="retailsheet.php">Retail Balance Sheet</a></li>
            <li><a href="auditsheet.php">Audit Sheet</a></li>
            <li><a href="employee.php">Employees</a></li>
            <li><a href='scripts/logout.php'>Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">
      <div class="starter-template">
        <h3>New Mill? Add it <a href="add_mill.php">here</a></h3>
        <br />
        <br />
        <div class='col-md-3'></div>
        <div class='col-md-6'>
          <form role='form' action = "scripts/Millorder.php" method='post'>

            <input type='hidden' value='1' id='number' name ='number'>
            <input type='hidden' value='1' id='retailid' name ='retailid'>
            <div class="form-group">
              <label>Select Mill</label>
              <select class="form-control" id = 'retailer' name="retailer" required>
              <?php
                require_once("scripts/config_sql.php");
                $id = $_GET['id'];
                $name = "";
                $sql = $mysqli->query("SELECT * FROM Mills");
                while($row = $sql->fetch_assoc()){
                  if($row['Id'] == $id){
                    echo "<option onclick=\"chooseretailer(".$row['Id'].", '".$row['Quality']."')\" id='". $row['Id'] ."' selected=\"selected\">".$row['Name']."</option>";
                    $name = $row['Name'];
                  }
                  else {
                    echo "<option onclick=\"chooseretailer(".$row['Id'].", '".$row['Quality']."')\" id='". $row['Id'] ."'>".$row['Name']."</option>";  
                  }
                }
                //echo "<script>document.getElementById('retailer').value = '".$name."'; </script>";
              ?>
              </select>
              <br />
            </div>
            
            <h3>Place Order</h3><br />
            <div id = "items">

              <div class="form-group">
                <div class="col-md-6 form-group">
                  <select class="form-control" id='id1' name='id1' required>
                    <?php
                      require_once("scripts/config_sql.php" );
                        $type = $_GET['type'];
                        $sql = $mysqli->query("SELECT * FROM Stocks WHERE Quality = '$type'");

                      while($row = $sql->fetch_assoc())
                        echo "<option value = '".$row['Id']."' id = '" .$row['Id']. "'>".$row['Id'].': '.$row['Quality'].' ('.$row['Colour'].')</option>';
                    ?>
                  </select>
                </div>
                <div class="col-md-6 form-group">
                  <input class='form-control' type="text" placeholder="Quantity" id='quantity1' name="quantity1" required>
                </div>
              </div>
            </div>
            <div class='col-md-2'></div>
            <div class='col-md-4'>
            <button id='add' class="btn btn-lg btn-primary btn-block" onclick='addrow()'>Add Item</button>
            </div>
            <div class='col-md-4'>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
            </div>
            <div class='col-md-2'></div>
            </form>
          </div>
          <div class='col-md-3'></div>

      </div>
    </div><!-- /.container -->

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  
<script type="text/javascript">
  var retailerid = 1;
  var counter = 1;

  window.onload = function(){
    if(window.location.href == 'http://localhost/dbproject/millorder.php'){
      window.location.href = 'http://localhost/dbproject/millorder.php?id=1&type=Cotton';
    }
    var str = window.location.href.toString().split('&');
    str = str[0].split("=");
    document.getElementById('retailid').value = str[1];
    retailerid = str[1];
  }

  function chooseretailer(id, type) {
    retailerid = id;
    document.getElementById('retailid').value = id;
    window.location.href = 'http://localhost/dbproject/millorder.php?id=' + id + '&type=' + type;
  }

  function addrow() {
    var ids = new Array(counter);
    var quantities  = new Array(counter);
    for(var i=1; i<=counter;i++) {
      var id = 'id' + i;
      var quantity = 'quantity' + i;
      ids[i] = document.getElementById(id).value;
      quantities[i] = document.getElementById(quantity).value;
    };
    counter += 1;
    document.getElementById('number').value = counter;
    var items = document.getElementById('items');

    var str = "<div class='form-group'><div class='col-md-6 form-group'><select class='form-control' id='id"+counter+"' name='id"+counter+"' required><?php require_once('scripts/config_sql.php'); $type = $_GET['type']; $sql = $mysqli->query('SELECT * FROM Stocks'); while($row = $sql->fetch_assoc()) {    if($row['Quality'] == $type) {  echo '<option value = \''.$row['Id'].'\' id = \'' .$row['Id']. '\'>'.$row['Id'].': '.$row['Quality'].' ('.$row['Colour'].')</option>';  }    } ?></select></div><div class='col-md-6 form-group'><input class='form-control' type='text' placeholder='Quantity' id='quantity"+counter+"' name='quantity"+counter+"' required></div></div>";
      
    items.innerHTML += str;
    for(var i=1;i<=counter-1;i++) {
      var id = 'id' + i;
      var quantity = 'quantity' + i;

      document.getElementById(id).value = ids[i];
      document.getElementById(quantity).value = quantities[i];
    };
  }
</script>

</body>
</html>