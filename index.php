<!DOCTYPE html>
<html lang="en">
<head>

    <title>Home Page</title>

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
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="Retailorder.php">Retail Order</a></li>
            <li><a href="millorder.php">Mill Order</a></li>
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
        <h1>Welcome to the Cloth Lining Shop</h1><br /><br />
        <div class='row'>
          <div class='col-md-6'>
            <h3>Place <a href="millorder.php">Mill Order</a></h3>
            <h3>Place <a href="Retailorder.php">Retail Order</a></h3>
            <h3>View <a href="millsheet.php">Mill Balance Sheet</a></h3>
            <h3>View <a href="retailsheet.php">Retail Balance Sheet</a></h3>
            <h3>View <a href="auditsheet.php">Audit Sheet</a></h3>
            <h3>View <a href="employee.php">Employee Information</a></h3>
          </div>
          <div class='col-md-6'>
          <br />
          <br />
          <div class='row'>
            <div class='col-md-3'></div>
            <div class='col-md-6'>
              <form role='form' method='get' action='millbill.php'>
                <input class="form-control" name='Ordernumber' placeholder='Enter Mill Order Number' autofocus="" type='text'>
                <button class="btn btn-lg btn-primary btn-block" type="submit">View Bill</button>
              </form>
            </div>
            <div class='col-md-3'></div>
          </div>
          <br />
          <br />
          <div class='row'>
            <div class='col-md-3'></div>
              <div class='col-md-6'>
                <form role='form' method='get' action='retailbill.php'>
                  <input class="form-control" name='Ordernumber' placeholder='Enter Retail Order Number' autofocus="" type='text'>
                  <button class="btn btn-lg btn-primary btn-block" type="submit">View Bill</button>
                </form>
              </div>
              <div class='col-md-3'></div>
            </div>
          </div>
        </div>
      </div>

    </div><!-- /.container -->

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  

</body>
</html>