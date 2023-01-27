<?php
namespace AFInfinite\Views;
?>
<h1>Index Page </h1>
<?php

foreach ($_SERVER as $parm => $value)  echo "<p>$parm = '$value'</p>";
