<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Remove Skin</title>
  </head>
  <body>
    <div class = 'container'>
      <h1>Remove this skin from being sold</h1>
      <d1>
       <dt>Name</dt>
       <dd><?=$data->name ?></dd>
      </d1>
      <d1>
       <dt>Champion</dt>
       <dd><?=$data->champion ?></dd>
      </d1>
      <d1>
       <dt>Description</dt>
       <dd><?=$data->description ?></dd>
      </d1>
      <d1>
       <dt>Price</dt>
       <dd><?=$data->price ?></dd>
      </d1>
      <d1>
       <dt>Discount</dt>
       <dd><?=$data->discount ?></dd>
      </d1>
      <d1>
       <dt>Sold</dt>
       <dd><?=$data->sold ?></dd>
      </d1>
      <div>
        <form action = '' method = 'post'>
        <?php
          $skin = $data->image;
          echo "<img src = '/images/$skin' style = 'max-width:400px; padding-bottom:10px;'/>";
          echo "<div><input type='submit' name='action' value = 'Remove Skin' style = 'margin-right:5px;' class = 'btn btn-danger'>";
          echo "<a href = '/skin/index' class = 'btn btn-secondary'>Back to list</a></div>";
        ?>
        </form>
      </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>