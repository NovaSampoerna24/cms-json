<?php 

$content = "Hello Welcome to PHPcodebypavan <img src='https://1.bp.blogspot.com/-QhryrIWC7fk/XmOLOapUpMI/AAAAAAAABAE/W5AOGGTGwaAoee33aK0SCf95X7lRPMsTQCLcBGAsYHQ/s320/Token%2BFFIM%2BSilver%2Bdan%2BRed%2BMedal%2BFree%2BFire%2BFF%252C%2B' 
alt='AMP Example' height='200'width='400' >. Learn more";
$result = preg_replace('/(<img[^>]+>(?:<\/img>)?)/i', '$1</amp-img>',
 $content);
echo str_replace('<img', '<amp-img', $result);
// echo $result;
?>
