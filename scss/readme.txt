To use this plugin:

1) Navigate to site wp-content folder ([sitename]/app/public/wp-content/).
2) If necessary, create directory [mu-plugins].
3) Copy mermaidwig directory to mu-plugins.
4) Move mermaidwig.php outside of mermaidwig directory so that mermaidwig.php is a direct descendent of mu-plugins.
5) Update the variables in styles.scss, and update any additional variables or styling in _admin or _login and compile with SASS using the following:
     a) Navigate to plugin directory in terminal
     b) Run sass --watch scss:css
     c) Zip entirety of folder, and upload plugin to site
     **Don't forget to update google fonts link in mermaidwig.php if custom fonts are needed
6) Add logo image to /assets and update background image URL in _login stylesheet.
7) Refresh page to see changes.