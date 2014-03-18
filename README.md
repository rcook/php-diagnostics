# `php-diagnostics`

# Overview

The problem: [Almost everything is wrong with how PHP handles error
messages](http://me.veekun.com/blog/2012/04/09/php-a-fractal-of-bad-design/)

One proposed solution: [A PHP reset script](http://meyerweb.com/eric/tools/css/reset/)

This is what this aims to be.

# Configuration

* `DIAGNOSTICS_TREAT_WARNINGS_AS_ERRORS` (default: `true`): promote all warnings
to fatal errors
* `DIAGNOSTICS_DEBUG_MODE` (default: `false`): display call stacks in browser

# Sample app

There is a sample PHP app under `sample-app`.

# Licence

`php-diagnostics` is released under the MIT licence.

