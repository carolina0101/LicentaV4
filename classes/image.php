<?php
class Image
{

	public function generate_filename($length)

	{	$array = array(0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q');
		$text = "";

		for($x = 0; $x < $length; $x++)
		{
			$random = rand(0,61);
			$text .= $array[$random];
		}

		return $text;
	}


	public function crop_image($original_file_name, $cropped_file_name, $max_width, $max_height)
	{
		if(file_exists($original_file_name))
		{
			$original_image = imagecreatefromjpeg($original_file_name);

			$original_width = imagesx($original_image);
			$original_height = imagesy($original_image);

			if($original_height > $original_width)
			{
              //cropare
			  $ratio = $max_width / $original_width;

			  $new_width = $max_width;
			  $new_height = $original_height * $ratio;

			}else
			{
				   //cropare
			  $ratio = $max_height / $original_height;

			  $new_height= $max_height;
			  $new_width= $original_width * $ratio;
			}
		}
		//adjust max & hight dif
		if($max_width != $max_height)
		{
			if($max_height > $max_width)
			{
				if($max_height > $new_height)
				{
					$adjustement = ($max_height / $new_height);
				}else
				{
					$adjustement = ($new_height / $max_height);
				}

				$new_width = $new_width * $adjustement;
				$new_height = $new_height * $adjustement;
			}else
			{
					if($max_width > $new_width)
					{

						$adjustement = ($max_width / $new_width);
					}else
					{
						$adjustement = ($new_width / $max_width);
					}

					$new_width = $new_width * $adjustement;
					$new_height = $new_height * $adjustement;
			}
		}

		$new_image = imagecreatetruecolor($new_width, $new_height);
		imagecopyresampled($new_image, $original_image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);

		imagedestroy($original_image);


		if($max_width != $max_height)
		{
			if($max_width > $max_height)
			{
				$diff = ($new_height - $max_height);
				if($diff < 0){
					$diff = $diff * -1;
				}
				$y = round($diff / 2);
				$x = 0;
			}else
			{
				$diff = ($new_width - $max_height);
				if($diff < 0){
					$diff = $diff * -1;
				}
				$x = round($diff / 2);
				$y = 0;
			}
		}else
		{
			if($new_height > $new_width)
			{
				$diff = ($new_height - $new_width);
				$y = round($diff / 2);
				$x = 0;
			}else
			{
				$diff = ($new_width - $new_height);
				$x = round($diff / 2);
				$y = 0;
			}
		}

		$new_cropped_image = imagecreatetruecolor( $max_width, $max_height);
		imagecopyresampled($new_cropped_image, $new_image, 0, 0, $x, $y, $max_width, $max_height, $max_width, $max_height);

		imagedestroy( $new_image);

		imagejpeg( $new_cropped_image,$cropped_file_name,90);
		imagedestroy( $new_cropped_image);
	}

	//resize

	public function resize_image($original_file_name, $resized_file_name, $max_width, $max_height)
	{
		if(file_exists($original_file_name))
		{
			$original_image = imagecreatefromjpeg($original_file_name);

			$original_width = imagesx($original_image);
			$original_height = imagesy($original_image);

			if($original_height > $original_width)
			{
              //cropare
			  $ratio = $max_width / $original_width;

			  $new_width = $max_width;
			  $new_height = $original_height * $ratio;

			}else
			{
				   //cropare
			  $ratio = $max_height / $original_height;

			  $new_height= $max_height;
			  $new_width= $original_width * $ratio;
			}
		}
		//adjust max & hight dif
		if($max_width != $max_height)
		{
			if($max_height > $max_width)
			{
				if($max_height > $new_height)
				{
					$adjustement = ($max_height / $new_height);
				}else
				{
					$adjustement = ($new_height / $max_height);
				}

				$new_width = $new_width * $adjustement;
				$new_height = $new_height * $adjustement;
			}else
			{

					if($max_width > $new_width)
					{
						$adjustement = ($max_width / $new_width);
					}else
					{
						$adjustement = ($new_width / $max_width);
					}

					$new_width = $new_width * $adjustement;
					$new_height = $new_height * $adjustement;


			}
		}

		$new_image = imagecreatetruecolor($new_width, $new_height);
		imagecopyresampled($new_image, $original_image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);

		imagedestroy($original_image);

		imagejpeg( $new_image,$resized_file_name,90);
		imagedestroy( $new_image);

	}

	//1


	public function get_thumb_cover($filename)
	{
		$thumbnail = $filename . "_cover_thumb.jpeg";

		if(file_exists($thumbnail))
		{
			return $thumbnail;
		}

		$this->crop_image($filename, $thumbnail, 1366, 488);

		if(file_exists($thumbnail))
		{
			return $thumbnail;
		}else
		{
			return $filename;
		}
	}

	//2

	public function get_thumb_profile($filename)
	{
		$thumbnail = $filename . "_profile_thumb.jpeg";

		if(file_exists($thumbnail))
		{
			return $thumbnail;
		}

		$this->crop_image($filename, $thumbnail, 600, 600);

		if(file_exists($thumbnail))
		{
			return $thumbnail;
		}else
		{
			return $filename;
		}
	}

	//3

	public function get_thumb_post($filename)
	{
		$thumbnail = $filename . "_post_thumb.jpeg";

		if(file_exists($thumbnail))
		{
			return $thumbnail;
		}

		$this->crop_image($filename, $thumbnail, 600, 600);

		if(file_exists($thumbnail))
		{
			return $thumbnail;
		}else
		{
			return $filename;
		}
	}



}
