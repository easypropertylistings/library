****
Fixing the Divi theme missing icons is due to the Divi theme missing the
wp_body_open function in the header.php file introduced in WordPress 5.2.

EPL used to hook the SVG icons into the header as there was no alternative.

Unfortunatly adding SVG's to the header was causing issues with Favicons in 
some themes and other hooks. So we moved the SVG's to load using the 
wp_body_open tag introduced in WordPress 5.2.

https://developer.wordpress.org/reference/functions/wp_body_open/

Seems that not all themes have implemented this hook yet. So this little plugin
will hook the icons into the et_before_main_content Divi hook.

Download the zip and install the plugin or copy the function from the file in
this folder and insert it into your functions.php file.
