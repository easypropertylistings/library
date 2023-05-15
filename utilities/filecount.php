<?php

$f = new FileCounter('/home/{some_path}/public_html/wp-content/uploads/2021');

p2h($f);

class FileCounter
{   
    public $root;
    private $rootlevel = 0;
    public $files = [];
    
    function __construct($dir) {
        $this->root = $dir;
        $kp = explode('/', $dir);
        $this->rootlevel = count($kp);
        $this->getFiles($dir);
        
        $tsv = '<table>';
        foreach($this->files as $key => $data) {
            $tsv .= '<tr><td>'.$key."</td><td>".$data['d']."</td><td>".$data['f'].'</td></tr>'.PHP_EOL;
        }
        echo $tsv . '</table>';
    }    
    
    function getFiles($dir) 
    {
        $items = scandir($dir);
        $path = $dir.'/';
        
        foreach($items as $item) 
        {
            if($item == '.' || $item == '..') {
//                echo $dir . $item.' - ERR<br>';
            }
            else {
                // if first pass, item is the key. otherwise, extract from path
                
                $isdir = is_dir( $path . $item );
                
                $key = null;
                if($this->root === $dir) {
                    if( $isdir ) {
                        // create the key, ignore files at root level folder
                        $key = $item;
                        $this->files[$key] = ['d'=>0,'f'=>0];
                    }
                }
                else {
                    $kp = explode('/', $path);
//                    p2h($kp);
                    $key = $kp[$this->rootlevel];
//                    p2h($key);
                }
                
//                echo $key . ' - '. $path . $item . '<br>';
                if( isset($this->files[$key]) ) 
                {
                    if( $isdir ) {
                        $this->files[$key]['d'] += 1;
                        $this->getFiles( $path . $item );
                    }
                    else {
                        $this->files[$key]['f'] += 1;
                    }
                }
            }
        }
    }
}

function p2h($array) {
    echo '<pre>'.print_r($array, true).'</pre>';
}

?>
