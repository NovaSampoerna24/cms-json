<?php 
$content='<a href="something.com"><img src="blah.jpg"  ></a>';
// output: <a href="something.com"><img src="blah.jpg" alt="Game"></a>

// $content='<a href="something.com"><img src="blah.jpg" alt="Not Empty"></a>'; 
// output: <a href="something.com"><img src="blah.jpg" alt="Not Empty"></a

// $pattern ='~(<img.*? alt=")("[^>]*>)~i';
// $replacement = '$1Game$2';
// $content = preg_replace($pattern, $replacement, $content);
// echo $content;
$html = preg_replace('/alt=".*?"/', '', $content);
$pattern ='~(<img.*?)~';
$replacement = '<img alt="game"';
$content = preg_replace($pattern, $replacement, $html);
echo $content;
?>