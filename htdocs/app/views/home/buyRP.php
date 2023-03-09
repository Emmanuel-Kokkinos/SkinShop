<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Purchase RP</title>
  </head>
  <body>
    <div class = 'container'>
      <h1>Purchase RP</h1>
      <?php
        $user = $data['user'];
        echo "<p>$user->username $user->riot_points RP</p>";
      ?>
      <?php
        if(!is_array($data)) {
          echo "<div class = 'alert alert-danger' role = 'alert'>$data</div>";
        }
      ?>
      <a href = '/home/shop' class = "btn btn-secondary">Back to shop</a>
        <form action = "" method = "post">
          <div style = "display: flex; flex-direction: row;">
            <div style = "border: 2px solid black; height: 150px; width: 150px; text-align: center; margin-right: 10px; margin-top: 10px;">
              <b>5 CAD</b></br></br>
              <b>490 RP</b></br></br>
              <input type="submit" name="action" value="490" class="btn btn-success">
            </div>
            <div style = "border: 2px solid black; height: 150px; width: 150px; text-align: center; margin-right: 10px; margin-top: 10px;">
              <b>10 CAD</b></br></br>
              <b>1020 RP</b></br></br>
              <input type="submit" name="action" value="1020" class="btn btn-success">
            </div>
            <div style = "border: 2px solid black; height: 150px; width: 150px; text-align: center; margin-right: 10px; margin-top: 10px;">
              <b>20 CAD</b></br></br>
              <b>2075 RP</b></br></br>
              <input type="submit" name="action" value="2075" class="btn btn-success">
            </div>
            <div style = "border: 2px solid black; height: 150px; width: 150px; text-align: center; margin-right: 10px; margin-top: 10px;">
              <b>35 CAD</b></br></br>
              <b>3700 RP</b></br></br>
              <input type="submit" name="action" value="3700" class="btn btn-success">
            </div>
            <div style = "border: 2px solid black; height: 150px; width: 150px; text-align: center; margin-right: 10px; margin-top: 10px;">
              <b>50 CAD</b></br></br>
              <b>5350 RP</b></br></br>
              <input type="submit" name="action" value="5350" class="btn btn-success">
            </div>
            <div style = "border: 2px solid black; height: 150px; width: 150px; text-align: center; margin-right: 10px; margin-top: 10px;">
              <b>100 CAD</b></br></br>
              <b>11000 RP</b></br></br>
              <input type="submit" name="action" value="11000" class="btn btn-success">
            </div>
          </div>
        </form>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>