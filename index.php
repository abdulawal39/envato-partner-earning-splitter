<?php
/**
* Envato Partner Earning Splitter - For Authors
* Use this script to get the earning amount for each of the partners based on product id and percentage.
* Article Url: https://themencode.com/envato-partner-earning-splitter
* Author @Abdul Awal
* Author url: www.abdulawal.com
*/ 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <title>Envato Partner Earning Splitter - For Authors by ThemeNcode</title>
      <link rel="stylesheet" href="css/bootstrap.min.css" />
      <link rel="stylesheet" href="css/style.css" />
      <script type="text/javascript" src="js/jquery-3.5.0.min.js"></script>
      <script type="text/javascript" src="js/bootstrap.min.js"></script>
      
  </head>
  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
          <div class="navbar-header">
              <a class="navbar-brand" href="#">Envato Partner Earning Splitter</a>
          </div>
      </div>
    </nav>
    <div class="container">
      <div class="main-container">
          <h1>Envato Partner Earning Splitter <small>uses envato API v3</small></h1>
          <p class="lead">Provide necessary info below to get earnings report.</p>
          <div class="row">
            <div class="col-md-8 col-md-offset-2">
              <form action="calculate-earnings.php" method="POST" id="envato-partner-earning-splitter">
                <div class="row">
                  <div class="col-md-3">
                      <input type="text" name="item_id" value="" class="form-control" id="input-item-id" placeholder="Enter Product ID" />
                  </div>
                  <div class="col-md-3">
                    <input type="month" name="month" value="" class="form-control" id="input-month" placeholder="Enter Month" />
                  </div>
                  <div class="col-md-3">
                    <input type="number" name="percentage" value="" max="100" min="1" class="form-control" id="input-percentage" placeholder="Enter Partner Percentage" />
                  </div>
                  <div class="col-md-3">
                    <select name="site" id="site" class="form-control" required>
                      <option value="">Select Site</option>
                      <option value="codecanyon.net">CodeCanyon</option>
                      <option value="themeforest.net">ThemeForest</option>
                      <option value="graphicriver.net">GraphicRiver</option>
                      <option value="videohive.net">VideoHive</option>
                      <option value="audiojungle.net">AudioJungle</option>
                      <option value="photodune.net">PhotoDune</option>
                      <option value="3docean.net">3DOcean</option>
                    </select>
                  </div>
                </div>
                <br>
                <input type="submit" value="Get Earned Amount" class="btn btn-success">
              </form>
              <div id="show-result"></div>
            </div>
          </div>
      </div>
      <div class="row"><center>
        <em><strong>Caution:</strong> Please use with caution, every request you make here may generate lots of requests to envato API depending on your number of sales. Trying multiple times may result in API rate limiting. </em> <br><br />
        Copyright &copy; <?php echo date("Y") ?> ThemeNcode. <br> Powered by <a href="http://themencode.com/" target="_blank">ThemeNcode</a>, Author of best selling <a href="https://codecanyon.net/item/pdf-viewer-for-wordpress/8182815/" target="_blank">PDF Viewer for WordPress plugin</a>. </center></div>
    </div><!-- /.container -->
    <script type="text/javascript">
      $(document).ready( function() {
        var form = $('#envato-partner-earning-splitter');

        $('#envato-partner-earning-splitter').submit(function(e){
          e.preventDefault();
          $('#show-result').html("Please wait, Your earnings is being calculated...");

          $.ajax( {
            type: "POST",
            url: form.attr( 'action' ),
            data: form.serialize(),
            success: function( response ) {
              $('#show-result').html(response);
            }
          } );
        } );
      } );
    </script>
  </body>
</html>