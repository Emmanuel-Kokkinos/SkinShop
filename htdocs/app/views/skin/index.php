<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>List of Skins</title>
  </head>
  <body>
    <div class = 'container'>
      <h1>List of Skins</h1>
      <a href='/login/logout' class = 'btn btn-danger' style = 'margin-bottom: 5px;'>Log out</a></br>
  		<a href='/skin/create' class = "btn btn-success">Add a Skin</a>
      <div style = "float: right">
        <?php
          $user = $data['user'];
          echo "<a href='/employee/changePassword/$user' class = 'btn btn-info'>Change password</a></br>";
        ?>
      </div>
      <?php
        if($_SESSION['is_admin'] == '1') {
          echo "<div style = 'float: right'><a href = '/employee/index' class = 'btn btn-primary' style ='margin-right:5px'>Employees</a></div>";
        }
        echo "<div style = 'float: right'><a href = '/employee/user' class = 'btn btn-primary' style ='margin-right:5px'>Users</a></div>";
      ?>
      <div class="container" style="padding-top: 10px">
        <div class="row">
          <div class="col-sm">
            <form action="/skin/index" method='post'>
              <input type="checkbox" name="sortprice" id="sortprice" value="checked" <?php if(isset($_POST['sortprice'])) echo "checked ='checked'";?> onchange="this.form.submit();">
              <label for="sortprice">Sort by Price</label><br>
            </form>
          </div>
          <div class="col-sm">
            <form action='/skin/index' method='post'>
              <input name="search" type="text" placeholder="Search.." >
              <input name="submit" type="submit" value="Search">
            </form>
          </div>
          <div class="col-sm">
            <form action="/skin/index" method='post' style="float:right">
              <input type="checkbox" name="sale" id="sale" value="checked" <?php if(isset($_POST['sale'])) echo "checked ='checked'";?> onchange="this.form.submit();">
              <label for="sale">Show Sales Only</label><br>
            </form>
          </div>
        </div>
      </div>
  		<table class = "table table-striped" style = 'margin-top: 5px;'>
  			<tr><td>Name</td><td>Champion</td><td>Price</td><td>Description</td><td>Actions</td></tr>
  			<?php
        $skins = $data['skins'];
        $skins_onsale = $data['skins_onsale'];
        if (isset($_POST['submit']) && $_POST['search'] != NULL) {
            $str = $_POST['search'];
            foreach($skins as $skin) {
              if (strpos(strtolower($skin->name), strtolower($str)) === false && strpos(strtolower($skin->champion), strtolower($str)) === false)
                  unset($skins[array_search($skin, $skins)]);
            }
          }
        if (isset($_POST['sale'])) {
          foreach($skins_onsale as $skin) {
            $fullprice = $skin->price / (1 - $skin->discount);
  					echo "<tr><td>$skin->name</td><td>$skin->champion</td><td><strike>$fullprice</strike></br>$skin->price</td><td>$skin->description</td><td>
  					<a href = '/skin/detail/$skin->skin_id' class = 'btn btn-primary'>Details</a>
  					<a href = '/skin/edit/$skin->skin_id' class = 'btn btn-success'>Edit</a>
  					<a href = '/skin/delete/$skin->skin_id' class = 'btn btn-danger'>Delete</a>";
            if($skin->image == NULL) {
              echo "<a href = '/skin/addPicture/$skin->skin_id' style = 'margin-left:4px;' class = 'btn btn-primary'>Add a picture</a>";
            }
  					"</td></tr>";
          }
        } else {
          if (isset($_POST['sortprice'])) {
            usort($skins, array('skin', 'cmp_price'));
          }
          foreach($skins as $skin) {
            echo "<tr><td>$skin->name</td><td>$skin->champion</td><td>$skin->price</td><td>$skin->description</td><td>
            <a href = '/skin/detail/$skin->skin_id' class = 'btn btn-primary'>Details</a>
            <a href = '/skin/edit/$skin->skin_id' class = 'btn btn-success'>Edit</a>
            <a href = '/skin/delete/$skin->skin_id' class = 'btn btn-danger'>Delete</a>";
            if($skin->image == NULL) {
              echo "<a href = '/skin/addPicture/$skin->skin_id' style = 'margin-left:4px;' class = 'btn btn-primary'>Add a picture</a>";
            }
            "</td></tr>";
          }
        }
  			?>
  		</table>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>