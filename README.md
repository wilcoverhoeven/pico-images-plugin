# Pico images plugin for Pico 1.x
***THIS PLUGIN IS NO LONGER MAINTAINT***
This plugin allows you to work with images within a Pico theme.

## Install
Move pico_images.php file into the plugins directory.  
The plugin will not function correctly due to Pico's default htaccess file.  

To make it work change the following line in your htaccess file:  
`RewriteRule ^(\.git|config|content|lib|vendor)(/.*)?$.`  
To:  
`RewriteRule ^(\.git|config|content|lib|vendor)(/.*.md)?$`  

Or add the following line at the beginning of your htaccess file, just after `RewriteEngine On`:  
`RewriteRule ^.*\.(gif|jpe?g|png|webp)$ - [NC,L]`

## Directory structure
The plugin works best if you structure all your pages in subdirectories within the content directory.

```
content
  |___page1
  |     |___index.md
  |     |___image1.jpg
  |     |___image2.png
  |
  |___page2
        |___index.md
        |___image1.gif
        |___image2.bmp
```

## Usage

### Page parent URL
The URL of directory in which the page (markdown file) resides is accessible using the twig variable `{{ page.parent }}`.

#### Example usage
This example lists all pages and shows a thumbnail image for each page.

Requirements:
 - Every page must exist in its own subdirectory of the content directory.
 - Every subdirectory must contain an image called "thumb.jpg".

```
<ul>
	{% for page in pages %}
		<li>
			<img src="{{ page.parent }}thumb.jpg">
			{{ page.title }}
		</li>
	{% endfor %}
</ul>
``` 

### Images array
The plugin will allso add all images in the same directory as the page (markdown file) to the array `{{ images }}`.

Only images with the following extensions will be added to the images array:
jpg, jpeg, png, gif and bmp

While extensions with uppercase letters will be picked up by the plugin, please note that depending on your server or browser they might not be displayed.

An image has the following properties:
 - filename, the name of the file with extension
 - name, the name of the file without the extension
 - ext, the file extension
 - width, the width of the image
 - height, the height of the image

#### Example
The following example displays all images in the same subdirectory as the page and excludes any image with the name "thumb".

Requirements:
 - Every page must exist in its own subdirectory of the content directory.
 - Images must be placed in the same directory as the page on which they are to be displayed.

```
{% for image in images %}
	{% if (image.name != 'thumb') %}
		<img src="{{ current_page.parent }}{{ image.filename }}">
	{% endif %}
{% endfor %}
```
