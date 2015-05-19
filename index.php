<?php


$blogs = array(
	parseFeed('http://subaddiction.net/?feed=rss2'),
	parseFeed('http://electroswingitalia.com/?feed=rss2'),
);


function parseFeed($url, $max_items=8, $tagname='item'){
                $doc = new DOMDocument();
                $doc->load($url);
                $feed = array();
                $items = $doc->getElementsByTagName($tagname);
                $nodeNUM = 0;
                foreach ($items as $item) {
                    //echo $item->nodeValue . "<br />";
                    $feed[$nodeNUM] = array();
                    foreach($item->childNodes as $node){
                        $feed[$nodeNUM][$node->nodeName] = $node->nodeValue;
                    }
                    $nodeNUM++;
                    if($nodeNUM >= $max_items){ break; }
                }
                return $feed;
}



function mixArrays($arrays=array(), $orderField, $order='desc',
$strtotime=false){
	
	$result = array();
	foreach($arrays as $ka => $va){
	
		foreach($va as $k => $v){
			if($strtotime){
			$result[strtotime($v[$orderField])] = $v;
			} else {
			$result[$v[$orderField]] = $v;
			}
			
			//print_r($v);
		
		}
	
	}
	
	switch($order){
		case 'desc':
			krsort($result);
		break;
		
		default:
			ksort($result);
		
	}
	
	return $result;

}

function arrayRemap($inputArray=array(), $fieldsMap=array()){
	
	foreach($inputArray as $ka=>$va){
		foreach($fieldsMap as $k=>$v){
			
			$inputArray[$ka][$v] = $inputArray[$ka][$k];
		
		}
	}
	
	return $inputArray;

}


if(file_exists('index.json')){
	$update = (time() - filemtime('index.json') >= (60*60*24))?true:false; // index.json modificato da > di 24h
}

if(!file_exists('index.json') || $update){
	
	global $blogs;
	$datamix = mixArrays($blogs, 'pubDate', 'desc', true);

	$mix = array();
	$i = 0;
	foreach($datamix as $kk=>$vv){
		$i++;
		if($i > 8){
			break;
		} else {
			//echo $kk." --- ".$vv['pubDate']." --- ".$vv['title']."\n";
			$mix[] = $vv;
		}
	
	}
	
	$mix = json_encode($mix);
	@file_put_contents('index.json', $mix);

}


$debug = ($_GET['json'])?true:false;
$fullposts = false;


if($debug){ 
	header('content-type:application/json');
	include('index.json');
	die();
} else {
	$contents = json_decode(@file_get_contents('index.json'),true);
	include('tmpl.php');
	die();
}





?>


