# Eviratec Order Theme
For WordPress, built by [Callan Milne](mailto:callan.milne@eviratec.com.au), based on [BlankSlate](https://wordpress.org/themes/blankslate/).

## Compile CSS

Ensure SASS is installed and running the latest stable version.

**To build CSS source:**

From the theme directory run:

```
$ sass style.scss > style.css
```

## Compile JS

JS components relating to the overall step navigation and form submission are concatenated and minified using Grunt.

Ensure the latest stable version of Node.js is installed and install the required libraries for the project by first running an `$ npm install` from the theme directory.

**To build JS source:**

From the theme directory run:

```
$ ./node_modules/grunt/bin/grunt dev
```

## License
Copyright (c) 2018 Callan Peter Milne

Permission to use, copy, modify, and/or distribute this software for any
purpose with or without fee is hereby granted, provided that the above
copyright notice and this permission notice appear in all copies.

THE SOFTWARE IS PROVIDED "AS IS" AND THE AUTHOR DISCLAIMS ALL WARRANTIES WITH
REGARD TO THIS SOFTWARE INCLUDING ALL IMPLIED WARRANTIES OF MERCHANTABILITY
AND FITNESS. IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY SPECIAL, DIRECT,
INDIRECT, OR CONSEQUENTIAL DAMAGES OR ANY DAMAGES WHATSOEVER RESULTING FROM
LOSS OF USE, DATA OR PROFITS, WHETHER IN AN ACTION OF CONTRACT, NEGLIGENCE OR
OTHER TORTIOUS ACTION, ARISING OUT OF OR IN CONNECTION WITH THE USE OR
PERFORMANCE OF THIS SOFTWARE.
