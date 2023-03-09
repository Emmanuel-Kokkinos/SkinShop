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
    <div class = "container">
      <h1>List of Skins</h1>
      <?php
        $user = $data['user'];
        echo "<p>$user->username $user->riot_points RP</p>";
      ?>
      <div>
        <a href = '/home/index' class = "btn btn-secondary">Back to owned</a>
        <a href = '/home/buyRP' class = "btn btn-primary">Purchase RP</a>
      </div>
      <div class="container" style="padding-top: 10px">
        <div class="row">
          <div class="col-sm">
            <form action="/home/shop" method='post'>
              <input type="checkbox" name="sale" id="sale" value="checked" <?php if(isset($_POST['sale'])) echo "checked ='checked'";?> onchange="this.form.submit();">
              <label for="sale">Show Sales Only</label><br>
            </form>
          </div>
          <div class="col-sm">
            <form action='/home/shop' method='post'>
              <input name="search" type="text" placeholder="Search.." >
              <input name="submit" type="submit" value="Search">
            </form>
          </div>
          <div class="col-sm">
            <form action="/home/shop" method='post' style="float:right">
              <input type="checkbox" name="owned" id="owned" value="checked" <?php if(isset($_POST['owned'])) echo "checked ='checked'";?> onchange="this.form.submit();">
              <label for="owned">Show Owned</label><br>
            </form>
          </div>
        </div>
      </div>
      <div class="container" style="padding-top: 10px;">
        <div class="row">
          <div class="col-sm">
            <form action="/home/shop" method='post'>
              <input type="checkbox" name="sortname" id="sortname" value="checked" <?php if(isset($_POST['sortname'])) echo "checked ='checked'";?> onchange="this.form.submit();">
              <label for="sortname">Sort by Name</label><br>
            </form>
          </div>
          <div class="col-sm">
            <form action="/home/shop" method='post' style='float:right'>
              <input type="checkbox" name="sortprice" id="sortprice" value="checked" <?php if(isset($_POST['sortprice'])) echo "checked ='checked'";?> onchange="this.form.submit();">
              <label for="sortprice">Sort by Price</label><br>
            </form>
          </div>
        </div>
      </div>
  		<table class = "table table-striped" style = 'margin-top: 5px;'>
  			<tr><td>Name</td><td>Champion</td><td>Description</td><td>Price</td><td>Image</td><td>Buy</td></tr>
  			<?php
          $user = $_SESSION['user_id'];
          $skins = $data['skins'];
          $skins_owned = $data['skins_owned'];
          $skins_onsale = $data['skins_onsale'];
          $ids = array_map(function($skins_owned) { 
            return $skins_owned->skin_id; }, $skins_owned);
          if (isset($_POST['submit']) && $_POST['search'] != NULL) {
            $str = $_POST['search'];
            foreach($skins as $skin) {
              if (strpos(strtolower($skin->name), strtolower($str)) === false && strpos(strtolower($skin->champion), strtolower($str)) === false)
                  unset($skins[array_search($skin, $skins)]);
            }
          }
          if(isset($_POST['sale'])) {
            foreach($skins_onsale as $skin) {
              if (!in_array($skin->skin_id, $ids))
              {
                $fullprice = $skin->price / (1 - $skin->discount);
                echo "<tr><td>$skin->name</td><td>$skin->champion</td><td>$skin->description</td><td><strike>$fullprice</strike></br>$skin->price</td><td>
                <img src = '/images/$skin->image' style = 'max-width:150px;'/></td><td>
                <a href = '/home/addToCart/$skin->skin_id' class = 'btn btn-primary'>Add to Cart</a>
                </td></tr>";
              }
            }
          }
          elseif (isset($_POST['owned'])) {
    				foreach($skins as $skin) {
    					if (!in_array($skin->skin_id, $ids))
              {
                echo "<tr><td>$skin->name</td><td>$skin->champion</td><td>$skin->description</td><td>$skin->price</td><td>
                <img src = '/images/$skin->image' style = 'max-width:150px;'/></td><td>
                <a href = '/home/addToCart/$skin->skin_id' class = 'btn btn-primary'>Add to Cart</a>
                </td></tr>";
              } else
              {
                echo "<tr><td>$skin->name</td><td>$skin->champion</td><td>$skin->description</td><td>$skin->price</td><td>
                <img src = '/images/$skin->image' style = 'max-width:150px;'/></td><td>
                <button class = 'btn btn-success' disabled>Owned</button>
                </td></tr>";
              }
    				}
          } else {
            if (isset($_POST['sortname'])) {
              usort($skins, array('skin', 'cmp_name'));
            } elseif (isset($_POST['sortprice'])) {
              usort($skins, array('skin', 'cmp_price'));
            }
            foreach($skins as $skin) {
              if (!in_array($skin->skin_id, $ids))
              {
                echo "<tr><td>$skin->name</td><td>$skin->champion</td><td>$skin->description</td><td>$skin->price</td><td>
                <img src = '/images/$skin->image' style = 'max-width:150px;'/></td><td>
                <a href = '/home/addToCart/$skin->skin_id' class = 'btn btn-primary'>Add to Cart</a>
                </td></tr>";
              }
            }
          }
  			?>
  		</table>
      <a href = '/home/cart' style = 'left: 45%; position: absolute;' class = "btn btn-success">Checkout</a>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>