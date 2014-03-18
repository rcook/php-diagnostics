<?php

/*
The MIT License (MIT)

Copyright (c) 2014 Richard Cook

Permission is hereby granted, free of charge, to any person obtaining a copy of
this software and associated documentation files (the "Software"), to deal in
the Software without restriction, including without limitation the rights to
use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of
the Software, and to permit persons to whom the Software is furnished to do so,
subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER
IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

date_default_timezone_set('UTC');
define('DIAGNOSTICS_TREAT_WARNINGS_AS_ERRORS', true);
define('DIAGNOSTICS_DEBUG_MODE', true);
require_once dirname(__FILE__) . '/../index.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
  <title>Sample app</title>
</head>
<body>
<h1>Sample app</h1>
<ul>
  <li><a href="?">Show this list</a></li>
  <li><a href="?warning=1">Generate warning</a></li>
  <li><a href="?exception=1">Generate exception</a></li>
</ul>
</body>
</html>
<?php

function isCommand($property) {
  return isset($_REQUEST[$property]) && $_REQUEST[$property] == '1';
}

function generateWarning() {
  strpos();
}

function generateException() {
  throw new Exception('Sample exception');
}

if (isCommand('warning')) {
  generateWarning();
}
elseif (isCommand('exception')) {
  generateException();
}

