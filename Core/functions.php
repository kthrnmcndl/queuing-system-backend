<?php

function base_path($path): string
{
    return BASE_PATH . $path;
}

function abort($code = 404): string
{
  http_response_code($code);

  return "Data not found";
}
function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}
