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

require_once dirname(__FILE__) . '/class.Diagnostics.php';

Diagnostics::defineDefault('DIAGNOSTICS_TREAT_WARNINGS_AS_ERRORS', true);
Diagnostics::defineDefault('DIAGNOSTICS_DEBUG_MODE', false);

error_reporting(E_ALL & E_STRICT);

set_error_handler(function ($severity, $message, $fileName, $lineNumber) {
  if ($severity == E_WARNING && !DIAGNOSTICS_TREAT_WARNINGS_AS_ERRORS) {
    $errorTypeString = Diagnostics::getErrorTypeString($severity);
    Diagnostics::logError("$errorTypeString [{$severity}]: \"{$message}\" at {$fileName}:{$lineNumber}");
  }
  else {
    throw new ErrorException($message, 0, $severity, $fileName, $lineNumber);
  }
});

if (DIAGNOSTICS_DEBUG_MODE) {
  register_shutdown_function(function () {
    $errorInfo = error_get_last();
    if (!is_null($errorInfo)) {
      echo '<h1>Fatal error</h1><code><pre>';
      print_r($errorInfo);
      echo '</pre></code></body></html>';
    }
  });

  set_exception_handler(function ($exception) {
    Diagnostics::logException($exception);
    echo '<h1>Unhandled exception</h1><code><pre>';
    print_r($exception);
    echo '</pre></code>';
    echo '<h1>Diagnostics settings</h1>';
    echo Diagnostics::infoHtml();
  });
}
else {
  set_exception_handler(function ($exception) {
    Diagnostics::logException($exception);
  });
}

if (ini_get('magic_quotes_gpc') != 0) {
  throw new Exception('Must set magic_quotes_gpc to 0');
}

