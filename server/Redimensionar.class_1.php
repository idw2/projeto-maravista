<?php



class Redimensionar {

	protected $folder;
	protected $path;
	protected $way;
	protected $name;
	protected $image;
	protected $newimage; 
	protected $x;
	protected $y;
	protected $width;
	protected $height;
	protected $mime;
	
	public function destroy () {
	
		imagedestroy( $this->image );
		imagedestroy( $this->newimage );
		
	}
	
	public function createFolder ( $name ) {
	
		if ( !file_exists( "$this->path/$name" ) ) {
			
			mkdir( "$this->path/$name" );
		
		}
	
		$this->setFolder ( "$this->path/$name" );
		
	}
	
	public function setMime ( $mime ) {
	
		$this->mime = $mime;
		
	}
	
	public function getMime () {
	
		return $this->mime;
		
	}
	
	public function imageType () {

		if ( $this->getMime() == "image/gif" ) {
			return true;
		} elseif ( $this->getMime() == "image/jpeg" ) {
			return true;
		} elseif ( $this->getMime() == "image/jpg" ) {
			return true;
		} elseif ( $this->getMime() == "image/pjpeg" ) {
			return true;
		} elseif ( $this->getMime() == "image/bmp" ) {
			return true;
		}  elseif ( $this->getMime() == "image/png" ) {
			return true;
		} else {
			return false;
		}

	}
	
	public function setFolder ( $folder ) {
	
		$this->folder = $folder;
		
	}
	
	public function getFolder () {
	
		return $this->folder;
		
	}
	
	public function setPath ( $path ) {
	
		$this->path = $path;
		
	}
	
	public function getPath () {
	
		return $this->path;
		
	}
	
	protected function setWay ( $way ) {
	
		$this->way = $way;
		
	}
	
	public function getWay () {
	
		return $this->way;
		
	}
	
	public function setName ( $extensao ) {
	
		$this->name = strtoupper ( md5 ( uniqid( rand(), true ) ) ).".$extensao";
		
	}
	
	public function getName () {
	
		return $this->name;
		
	}
	
	public function setImage ( $file ) {
		
		$filetmp = $file["tmp_name"];
		$this->setMime ( $file["type"] );
	
		if ( $this->getMime() == "image/gif" ) {
		
			$this->image = @ imagecreatefromgif ( $filetmp );
			$this->setName ( 'gif' );
			
		} elseif ( $this->getMime() == "image/jpeg" || $this->getMime() == "image/jpg" || $this->getMime() == "image/pjpeg"  ) {
		
			$this->image = @ imagecreatefromjpeg ( $filetmp );
			$this->setName ( 'jpeg' );
			
		} elseif ( $this->getMime() == "image/bmp" ) {
		
			$this->image = @ imagecreatefromwbmp ( $filetmp );
			$this->setName ( 'bmp' );
			
		} elseif ( $this->getMime() == "image/png" ) {
		
			$this->image = @ imagecreatefrompng ( $filetmp );			
			$this->setName ( 'png' );
			
		}
		
	}
	
	public function getImage () {
	
		return $this->image;			
		
	}
	
	protected function setX () {
		
		$this->x = imagesx( $this->getImage() );		
		
	}
	
	protected function getX () {
	
		return $this->x;			
		
	}
	
	protected function setY () {
		
		$this->y = imagesy( $this->getImage() );		
		
	}
	
	protected function getY () {
	
		return $this->y;			
		
	}
	
	public function setWidth ( $width ) {
	
		$this->width = $width;
		
	}
	
	public function getWidth () {
	
		return $this->width;
		
	}
	
	
	protected function setHeight () {
	
		$this->height = ( $this->getWidth() * $this->getY() ) / $this->getX();
		
	}
		
	public function getHeight () {
	
		return $this->height;
		
	}
	
	protected function setNewimage () {

		$this->newimage = imagecreatetruecolor ( $this->width, $this->height );
				
	}
	
	public function getNewimage () {
	
		return $this->newimage;
		
	}
	
	public function copy () {
		
		$this->setX(); 
		$this->setY();	
		$this->setHeight();
		$this->setNewimage();
		imagecopyresampled ( $this->getNewimage(), $this->getImage(), 0, 0, 0, 0, $this->getWidth(), $this->getHeight(), $this->getX(), $this->getY() );
	
	}
		
	public function gif () {
	
		$folder = $this->getFolder();
		$name = $this->getName();
		$this->setWay ( "$folder/$name" );
		
		imagegif ( $this->newimage, $this->getWay() );
	
	}
	
	public function jpg () {
	
		$folder = $this->getFolder();
		$name = $this->getName();
		$this->setWay ( "$folder/$name" );
		
		imagejpeg ( $this->newimage, $this->getWay() );
	
	}
	
	public function png () {
	
		$folder = $this->getFolder();
		$name = $this->getName();
		$this->setWay ( "$folder/$name" );
		
		imagepng ( $this->newimage, $this->getWay() );
	
	}
	
	public function bmp () {
	
		$folder = $this->getFolder();
		$name = $this->getName();
		$this->setWay ( "$folder/$name" );
		
		imagewbmp ( $this->newimage, $this->getWay() );
	
	}
	
	public function set () {
		
		if ( $this->getMime() == "image/gif" ) {
		
			$this->gif();
			
		} elseif ( $this->getMime() == "image/jpeg" || $mime == "image/jpg" || $this->getMime() == "image/pjpeg" ) {
		
			$this->jpg();
			
		} elseif ( $this->getMime() == "image/bmp" ) {
		
			$this->bmp();
			
		} elseif ( $this->getMime() == "image/png" ) {
		
			$this->png();
			
		}
	
	}
	
	public function get () {
	
		
		$pasta = $this->folder;
		
		$imagens = glob( "$pasta/{*png,*PNG,*gif,*GIF,*jpg,*JPG,*jpeg,*JPEG,*bmp,*BMP,*pjpeg,*PJPEG}", GLOB_BRACE );
		
		return $imagens;
		
	}
	
	public function clear( $path ) {
	
		unlink( $path );
	
	}
	
	public function totalClear() {
	
		foreach ( $this->get() as $img ) {
			
			unlink( $img );
		}
	
	}
	
	
}


?>