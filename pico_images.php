<?php
/**
 * Access images of the current pages folder with in Pico CMS.
 *
 * @author  Wilco Verhoeven
 * @license The MIT License <http://opensource.org/licenses/MIT>
 * @version 1.0
 */
final class Pico_Images extends AbstractPicoPlugin{
    
    protected $enabled = true;
    
	private $path;
    private $content_dir;

	/**
	 * Get the images path.
	 */
    public function onRequestUrl(&$url){
        $this->path = $this->format($url);
    }
    
    /**
    * Get content directory.
    **/
    public function onConfigLoaded(array &$config){   
        $this->content_dir = $config['content_dir'];
    }
    
    /**
    * Set page parent-folder url, Twig variable {{ page.parent }} or {{ currentpage.parent }}.
    **/
    public function onSinglePageLoaded(array &$pageData){
        $pico = $this->getPico();
        $base_url = $pico->getBaseUrl();
        $page_id = $pageData['id'];
        
        $url = $base_url . basename($this->content_dir) . '/' . $page_id;
        $url = $this->format($url);
        
        $pageData['parent'] = $url;
    }

	/**
	 * Add the images data Twig variable {{ images }}.
	 */
    public function onPageRendering(Twig_Environment &$twig, array &$twigVariables, &$templateName){
        $twigVariables['images'] = $this->images_list($this->content_dir . $this->path);
    }

	/**
	 * Remove trailing 'index' and add trailing slash if missing.
	 */
	private function format($path){
		$is_index = strripos($path, 'index') === strlen($path)-5;
		if( $is_index ) return substr($path, 0, -5);
		elseif( substr($path, -1) != '/' ) $path .= '/';
		return $path;
	}
    
	/**
	 * Return a list of images with image information
	 */
	private function images_list($images_path){
		$data = array();
		$files = glob($images_path.'*');
		
		$images = array();
		foreach( $files as $file ){
			if(preg_match('/\.(jpe?g|png|gif|bmp)$/i', $file)) {
        		$images[] = $file;
    		}
		}

		foreach( $images as $path )
		{
			list(, $filename, $ext, $name) = array_values(pathinfo($path));
			list($width, $height) = getimagesize($path);

			$data[] = array (
				'filename' => $filename,
				'name' => $name,
				'ext' => $ext,
				'width' => $width,
				'height' => $height
			);
		}
		return $data;
	}
}

?>
