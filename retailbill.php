<html>
<head>
    <title>Retail Bill</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/starter-template.css" rel="stylesheet">
    <script src="css/ie-emulation-modes-warning.js"></script>
  </head>

  <body>
    <?php
      session_start();
      if(!isset($_SESSION['views'])){
        echo "<script>alert('You must be logged in'); location.href = 'signin.php'</script>";
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
            <li><a href="millorder.php">Order From Mill</a></li>
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
        
        <div>
          <table class = 'table'>
          <thead>
            <tr>
              <td><b>Item Id</b></td>
              <td><b>Colour</b></td>
              <td><b>Quality</b></td>
              <td><b>Quantity</b></td>
              <td><b>Amount</b></td>
            </tr>
          </thead>
          <?php
            require 'scripts/config_sql.php';
            $order = $_GET['Ordernumber'];
            $sql = $mysqli->query("SELECT * FROM Retail_Bill_Items WHERE Order_Number = '$order'");
            if($sql->num_rows==0)
              echo "<script>alert('Invalid Order Number'); location.href = 'index.php'</script>";
            else {
              while($row = $sql->fetch_assoc()){
                echo "<tr>";
                echo "<td>".$row['Item_Id']."</td>";
                echo "<td>".$row['Colour']."</td>";
                echo "<td>".$row['Quality']."</td>";
                echo "<td>".$row['Quantity']."</td>";
                echo "<td>".$row['Amount']."</td>";
                echo "</tr>";
              }
            } 
          ?>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><b>Total: </b> <?php
            require 'scripts/config_sql.php';
            $order = $_GET['Ordernumber'];
            $sql = $mysqli->query("SELECT * FROM Retail_Bill_Items WHERE Order_Number = '$order'");
            if($sql == false)
              echo "failed";
            else {
              $sum = 0;
              while($row = $sql->fetch_assoc()){
                $sum += $row['Amount'];
              }
            } 
            echo $sum;  ?></td>
          </tr>
          </table>
          <div class='col-md-5'></div>
          <div class='col-md-2'><a href="index.php"><button class="btn btn-lg btn-primary btn-block">Home</button></a></div>
          <div class='col-md-5'></div>
        </div>
      </div>
    </div>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  
</body>
</html>