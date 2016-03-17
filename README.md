#Pico images plugin
This plugin allows you to work with images within a Pico theme.

##Parent folder URL
It will add the parent folder URL of the page (markdown file) to the twig variable `{{ page.parent }}`.

This can be used to display thumbnails when listing all your pages.

###Example
```
{% for page in pages %}
	<img src="{{ page.parent }}thumb.jpg">
	{{ page.title }}
{% endfor %}
``` 

##Images array
The plugin will allso add all images in the same folder as the page (markdown file) as an array in de twig variable `{{ images }}`.

This can be used to display all images in de same folder as the markdown file.

An image has the folowing properties:
 - filename, the name of the file with extension
 - name, the name of the file without the extension
 - ext, the file extension
 - width, the width of the image
 - height, the height of the image

Only images with the following extensions will be added to the images array:
 - jpg
 - JPG
 - jpeg
 - JPEG
 - png
 - PNG
 - gif
 - GIF
 - bmp
 - BMP

###Example
```
{% for image in images %}
	{% if (image.name != 'thumb') %}
		<img src="{{ current_page.parent }}{{ image.filename }}">
	{% endif %}
{% endfor %}
```
