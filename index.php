<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>

<?php
const STATUS_PAID = "paid";

echo var_dump(STATUS_PAID);

$name = "<p>Gio</p>";

$name = "<p>Joe</p>";

$isComplite = true;

echo "</br></br>" . gettype($isComplite);
if ($isComplite) {
  echo "<p> YES </p>";
} else {
  echo "<p> NO </p>";
}
?>

<p>first paragraph.</p>

</body>
</html>
