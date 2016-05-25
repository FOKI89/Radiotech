<?php

	class AudioStream
	{
    private $path = "";
    private $stream = "";
    private $buffer = 102400 * 8;
    private $start  = -1;
    private $end    = -1;
    private $size   = 0;
 
    function __construct($fileName) 
    {
        $this->path = "ftp://192.168.4.92/".$fileName;
    }
     
    /**
     * Open stream
     */
    private function open()
    {
        if (!($this->stream = fopen($this->path, 'rb'))) {
            die('Could not open stream for reading'.$this->path);
        }
         
    }
     
    /**
     * Set proper header to serve the audio content
     */
    private function setHeader()
    {
        ob_get_clean();
        header("Content-Type: audio/mpeg");
        header("Cache-Control: max-age=2592000, public");
        header("Expires: ".gmdate('D, d M Y H:i:s', time()+2592000) . ' GMT');
        header("Last-Modified: ".gmdate('D, d M Y H:i:s', @filemtime($this->path)) . ' GMT' );
        $this->start = 0;
        $this->size  = filesize($this->path);
        $this->end   = $this->size - 1;
        header("Accept-Ranges: bytes"); 
        if (isset($_SERVER['HTTP_RANGE'])) {
  
            $c_start = $this->start;
            $c_end = $this->end;
 
            list(, $range) = explode('=', $_SERVER['HTTP_RANGE'], 2);
            if (strpos($range, ',') !== false) {
                header('HTTP/1.1 416 Requested Range Not Satisfiable');
                header("Content-Range: bytes 27$this->start-$this->end/$this->size");
                exit;
            }
            if ($range == '-') {
                $c_start = $this->size - substr($range, 1);
            }else{
                $range = explode('-', $range);
                $c_start = $range[0];
                 
                $c_end = (isset($range[1]) && is_numeric($range[1])) ? $range[1] : $c_end;
            }
            $c_end = ($c_end > $this->end) ? $this->end : $c_end;
            if ($c_start > $c_end || $c_start > $this->size - 1 || $c_end >= $this->size) {
                header('HTTP/1.1 416 Requested Range Not Satisfiable');
                header("Content-Range: bytes 27$this->start-$this->end/$this->size");
                exit;
            }
            $this->start = $c_start;
            $this->end = $c_end;
            $length = $this->end - $this->start + 1;
            fseek($this->stream, $this->start);
            header('HTTP/1.1 206 Partial Content');
            header("Content-Length: ".$length);
            header("Content-Range: bytes $this->start-$this->end/".$this->size);
        }
        else
        {
            header("Content-Range: bytes $this->start-$this->end/$this->size");
            header("Content-Length: ".$this->size);
        }  
         
    }
    
    /**
     * close currently opened stream
     */
    private function end()
    {
        fclose($this->stream);
        exit;
    }
     
    /**
     * perform the streaming of calculated range
     */

    private function stream()
    {   
        while(!feof($this->stream) && ($p = ftell($this->stream)) <= $this->end) {
            if ($p + $this->buffer > $this->end) {
                $this->buffer = $this->end - $p + 1;
            }
            set_time_limit(0);
            echo fread($this->stream, $this->buffer);
            flush();
    }
            /*$i = $this->start;
        set_time_limit(0);
        while(!feof($this->stream) && $i <= $this->end) {
            $bytesToRead = $this->buffer;
            if(($i+$bytesToRead) > $this->end) {
                $bytesToRead = $this->end - $i + 1;
            }
            $data = fread($this->stream, $bytesToRead);
            echo $data;
            flush();
            $i += $bytesToRead;
        }*/
    }
     
    /**
     * Start streaming audio content
     */
    function start()
    {
        $this->open();
        $this->setHeader();
        $this->stream();
        $this->end();
    }
}
	$stream = new AudioStream($_GET["filename"]);
	$stream->start();
	exit;
?>