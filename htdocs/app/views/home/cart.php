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
      <?php
        $user = $data['user'];
        echo "<p>$user->username $user->riot_points RP</p>";
      ?>
      <a href = '/home/shop' class = "btn btn-secondary">Back to shop</a></br>
      <a href = '/home/buyRP' class = "btn btn-primary" style="margin-top: 5px;">Purchase RP</a>
  		<table class = "table table-striped" style = 'margin-top: 5px;'>
  			<tr><td>Name</td><td>Champion</td><td>Description</td><td>Price</td><td>Image</td><td>Actions</td></tr>
  			<?php
          $user = $_SESSION['user_id'];
  				foreach($data['skins'] as $skin) {
  					echo "<tr><td>$skin->name</td><td>$skin->champion</td><td>$skin->description</td><td>$skin->price</td><td>
            <img src = '/images/$skin->image' style = 'max-width:150px;'/></td><td>
            <a href = '/home/removeFromCart/$skin->skin_id' class = 'btn btn-danger'>Remove from Cart</a></td></tr>";
  				}
  			?>
  		</table>
      <?php
        $total = 0;
        foreach ($data['skins'] as $skin) {
          if($skin->discount > 0) {
            $skin->price *= (1 - $skin->discount);
          }
          $total += $skin->price;
        }
        if($data['user']->riot_points >= $total) {
          echo "<a href = '/home/buySkin' style = 'left: 45%; position: absolute;' class = 'btn btn-success'>Buy</a>";
        }
        else {
          echo "<center><p>Not enough RP</p></center>";
        }
      ?>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>