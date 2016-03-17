#Pico images plugin
This plugin allows you to work with images within a Pico CMS theme.

The plugin works best if structure all your pages in subfolders within the content folder.

```
content
  |___page1
  |     |___index.md
  |     |___image1.jpg
  |     |___image2.jpg
  |
  |___page2
        |___index.md
        |___image1.jpg
        |___image2.jpg
```

##Page parent URL
The plugin will add the parent URL of the page (markdown file) to the twig variable `{{ page.parent }}`.

This can for example be used to display thumbnails when listing all your pages.

###Example
This example lists all pages and shows a thumbnail image for each page.

Requirements:
 - Every page must exist in its own subfolder of the content folder.
 - Every subfolder must contain an image called "thumb.jpg".

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

##Images array
The plugin will allso add all images in the same folder as the page (markdown file) as an array in de twig variable `{{ images }}`.

This can be used to display all images in de same folder as the page (markdown file).

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

An image has the following properties:
 - filename, the name of the file with extension
 - name, the name of the file without the extension
 - ext, the file extension
 - width, the width of the image
 - height, the height of the image

###Example
The following example displays all images in the same subfolder as the page and excludes any image with the name "thumb".

Requirements:
 - Every page must exist in its own subfolder of the content folder.

```
{% for image in images %}
	{% if (image.name != 'thumb') %}
		<img src="{{ current_page.parent }}{{ image.filename }}">
	{% endif %}
{% endfor %}
```
