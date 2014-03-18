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

abstract class Diagnostics {
  public static function defineDefault($name, $value) {
    if (!defined($name)) {
      define($name, $value);
    }
  }

  public static function logError($message) {
    error_log(self::formatMessage($message));
  }

  public static function logException($exception) {
    self::logError('Unhandled exception: ' . $exception->__toString());
  }

  public static function getErrorTypeString($severity) {
    switch ($severity) {
    case E_ERROR: return 'E_ERROR';
    case E_WARNING: return 'E_WARNING';
    case E_PARSE: return 'E_PARSE';
    case E_NOTICE: return 'E_NOTICE';
    case E_USER_ERROR: return 'E_USER_ERROR';
    case E_USER_WARNING: return 'E_USER_WARNING';
    case E_USER_NOTICE: return 'E_USER_NOTICE';
    case E_STRICT: return 'E_STRICT';
    case E_DEPRECATED: return 'E_DEPRECATED';
    default: return 'Unknown error type';
    }
  }

  public static function infoHtml() {
    $defines = array(
      'DIAGNOSTICS_TREAT_WARNINGS_AS_ERRORS',
      'DIAGNOSTICS_DEBUG_MODE'
    );
    $result = '<ul>';
    foreach ($defines as $define) {
      $result .= '<li><tt>' . $define . '</tt> = ' . constant($define) . '</li>';
    }
    $result .= '</ul>';
    return $result;
  }

  private static function formatMessage($message) {
    $lines = explode("\n", $message);
    $result = '';
    for ($i = 0; $i < count($lines); ++$i) {
      if ($i == 0) {
        $result .= $lines[$i];
      }
      else {
        $result .= "\n" . '-------------------------> ' . $lines[$i];
      }
    }
    return $result;
  }

  private function __construct() { }
}

