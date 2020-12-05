<?php 
	
	/**
	 * 
	 */
class Format 
{
		
    public function formatDate($date){
	return date('F j, Y, g:i a', strtotime($date));
	}

	public function textShorten($text, $limit = 400){
		$text = $text . " ";
		$text = substr($text, 0, $limit);
		$text = substr($text, 0, strrpos($text,''));
		$text = $text.".....";
		return $text;
	}

	public function validation($data){
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	public function title(){
	$path = $_SERVER['SCRIPT_FILENAME'];
	$title = basename($path,'.php');
	//$title = str_replace('_','',$title);
	if ($title == 'index') {
	$title = 'home';
	}elseif ($title == 'contact') {
	$title = 'contact';
	}
	return $title = ucfirst($title);
	}


	// Start function
 public function shorter($text, $chars_limit)
	{
	    // Check if length is larger than the character limit
	    if (strlen($text) > $chars_limit)
	    {
	        // If so, cut the string at the character limit
	        $new_text = substr($text, 0, $chars_limit);
	        // Trim off white space
	        $new_text = trim($new_text);
	        // Add at end of text ...
	        return $new_text . "...";
	    }
	    // If not just return the text as is
	    else
	    {
	    return $text;
	    }
	}




}


 ?>