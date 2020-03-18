<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "vendor/autoload.php";
use PHPHtmlParser\Dom;
$dom = new Dom;
include ('data/koneksi.php');
include ('model/Artikel.php');

    $today = date('Y-m-d');
    $status = 'aktif';
    // $today = '2020-10-10';
  
    $crontimelama = file_get_contents('data/crontime.json');
    $value = json_decode($crontimelama);
  
    $tanggallama = $value->tanggal;
    $statuslama = $value->status;
    
    $crontimebaru = file_get_contents('data/crontime.json');
    $response = json_decode($crontimebaru);
  // print_r($response);
    if($statuslama == 'nonaktif' and $tanggallama != $today){
        // update data dengan curl 
        // jika udpate data sukses jalankan function matikan
        // echo "nnon aktif";
        aktifkan($today);
        header("Refresh:0");
    }else if($statuslama == 'aktif' and $tanggallama == $today){
        echo "aktif";
        $getdata = getdata();
        if($getdata == "berhasil"){
            matikan($today);
            header("Refresh:0");
        }
    }else if($statuslama == "aktif" and $tanggallama != $today){
      // echo "status aktif";
        matikan($today);
        header("Refresh:0");
    }else if($statuslama == 'nonaktif' and $tanggallama == $today){
      // echo $tanggallama;
      // echo "status nonaktif";
    $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    $slug = (@$uriSegments[3]!=""?$uriSegments[3]:$uriSegments[2]); //returns bar
    $data = getDetailSlug($slug);
    $data = json_decode($data)->data;
    // $tag =  $data->tag;
    // $dataTag = explode(",",$tag);
    // print_r($data->content);
    
 
    $dom->load($data->content);
    $image = [];
    foreach($dom->find('img') as $img){
      $image[] = $img->src;
    }
    // print_r($image);
    // $a = $dom->find('div');
    $content = "";
    foreach ($dom->find('div') as $key => $value) {
      $content .= $value->text;
    }
    
    // print_r($a->text);
    // $content =$a->text; // "click here"
    
    $linkbacajuga = "Baca Juga : <br/>
    <ul>";
    $dd = getRandom();
    foreach ($dd as $key => $vv) {
        $linkbacajuga .= "<li><a href='".$vv['slug']."'>".$vv['title']."</a>";
    }
    $linkbacajuga .= "</ul>";
    

  $conten = preg_split('/\|\?|!/',$content);
  if(sizeof($conten) > 1){
    foreach($conten as $ct){
      // print_r($key);
       $nilai = sizeof($conten);
      $lipat = 6;
      if($bagi = $key % $lipat == 0){
        $ct = "<br><br>".$ct;
      }
      if($key == 4){
      
        //  $conten .= "hahaha".$ct;
           $content .= $ct."<span> Source :  <a href='https://www.wikipedia.org/'>Wikipedia</a> <span><br><br>".$linkbacajuga;
        //  print_r($conten);
        }else if($key == 12){
          $content .= $ct." <br><br>".$linkbacajuga;
        }
        else{
          $content .= $ct;
        }
      
    }
   
  }else{
  $conten =preg_split('/(<\s*p\s*\/?>)|(<\s*br\s*\/?>)|(\s\s+)|(<\s*\/p\s*\/?>)/', $data->content, -1, PREG_SPLIT_NO_EMPTY);
     
  foreach ($conten as $key => $ct) {
       $nilai = sizeof($conten);
      $lipat = 1;
      if($bagi = $key % $lipat == 0){
        $ct = "<br><br>".$ct;
      }
      // print_r($key);
      if($key == 2){

      //  $conten .= "hahaha".$ct;
          $content .= $ct." Source :  <a href='https://www.wikipedia.org'>Wikipedia</a> <br><br>".$linkbacajuga;
      //  print_r($conten);
      }else if($key == 12){
        $content .= $ct." <br><br>".$linkbacajuga;
      }else{
        $content .= $ct;
      }
    
      
    }
  }
  $content = ampify($content,$data->title,$data->sumber);



 
?>
<!---
preview: default
teaserImage: '/samples/img/teaser/news_article.jpg'
author: aghassemi

--->

  <!-- ## Introduction -->

  <!-- This is a sample template for a news article in AMP. It demonstrates the usage of AMP components which works well in news articles. Examples include social sharing, image galleries, personalized content, ads, and more.  -->
  <!-- -->
  <!doctype html>
  <html ⚡>
    <head>
      <meta charset="utf-8">
      <title><?=$data->title?></title>
      <script async src="https://cdn.ampproject.org/v0.js"></script>
      <!-- ## Setup -->
      <!--
        All additionally used AMP components must be imported in the header. Import `amp-social-share` for adding share buttons-->
      <script async custom-element="amp-social-share" src="https://cdn.ampproject.org/v0/amp-social-share-0.1.js"></script>
      <!-- Import `amp-iframe` to embed an interactive chart -->
      <script async custom-element="amp-iframe" src="https://cdn.ampproject.org/v0/amp-iframe-0.1.js"></script>
      <!-- Import `amp-carousel` to implement an image gallery -->
      <script async custom-element="amp-carousel" src="https://cdn.ampproject.org/v0/amp-carousel-0.1.js"></script>
      <!-- Import `amp-user-notification` to display a cookie notification -->
      <script async custom-element="amp-user-notification" src="https://cdn.ampproject.org/v0/amp-user-notification-0.1.js"></script>
      <!-- Import `amp-list` to get a fresh a list of related articles -->
      <script async custom-element="amp-list" src="https://cdn.ampproject.org/v0/amp-list-0.1.js"></script>
      <!-- Import `amp-mustache` as a format template for `amp-list` -->
      <script async custom-template="amp-mustache" src="https://cdn.ampproject.org/v0/amp-mustache-0.2.js"></script>
      <!-- Import `amp-analytics` for tracking usage -->
      <script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
      <!-- Import `amp-ad` to display ads -->
      <script async custom-element="amp-ad" src="https://cdn.ampproject.org/v0/amp-ad-0.1.js"></script>

      <link rel="canonical" href="<% canonical %>">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">

      <!-- ## Metadata -->
      <!-- The Top Stories carousel requires schema.org markup for one of the following types: Article, NewsArticle, BlogPosting, or VideoObject. [Learn more](https://developers.google.com/structured-data/carousels/top-stories#markup_specification).  -->
      <script type="application/ld+json">
{
      "@context": "http://schema.org",
      "@type": "NewsArticle",
      "mainEntityOfPage": "<% hosts.platform %>/samples_templates/news_article/",
      "headline": "Lorem Ipsum",
      "datePublished": "2016-04-21T11:55:02Z",
      "dateModified": "2016-04-21T11:55:02Z",
      "description": "A sample news article build with AMP.",
      "author": {
        "@type": "Person",
        "name": "Sebastian Benz"
      },
      "publisher": {
        "@type": "Organization",
        "name": "Google",
        "logo": {
          "@type": "ImageObject",
          "url": "http://cdn.ampproject.org/logo.jpg",
          "width": 600,
          "height": 60
        }
      },
      "image": {
        "@type": "ImageObject",
        "url": "/static/samples/img/landscape_lake_1280x857.jpg",
        "height": 1280,
        "width": 857
      }
    }
      </script>
      <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
      <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
      <style amp-custom>
        body {
          padding:16px;
          font-family: sans-serif;
          
        }

        :root {
          --color-primary: #005AF0;
          --color-text-light: #fff;
          --color-text-dark: #000;
          --color-bg-light: #FAFAFC;

          --space-1: .5rem;  /* 8px */
          --space-2: 1rem;   /* 16px */

          --box-shadow-1: 0 1px 1px 0 rgba(0,0,0,.14), 0 1px 1px -1px rgba(0,0,0,.14), 0 1px 5px 0 rgba(0,0,0,.12);
          }
          .figure {
            margin: var(--space-2) 0;
            padding: 0;
          }
          .figure>figcaption{
            padding: var(--space-1) var(--space-2);
          }
          .amp-ad-container {
            display: flex;
            margin: 0 auto;
          }
          .carousel .slide > amp-img > img {
            object-fit: contain;
          }
          .heading {
            padding-bottom: var(--space-1);
          }
          .heading h1 {
            font-size: 3rem;
            line-height: 3.5rem;
            margin-bottom: var(--space-2);
          }
          .heading > #summary {
            font-weight: 500;
          }
          .heading > small {
            color: var(--color-primary);
          }
          .related {
            background-color: var(--color-bg-light);
            margin: var(--space-2);
            display: flex;
            color: var(--color-text-dark);
            padding: 0;
            box-shadow: var(--box-shadow-1);
            text-decoration: none;
          }
          .related > span {
            font-weight: 400;
            margin: var(--space-1);
          }
          .related:hover {
            background-color: var(--color-bg-light);
          }
          .cookie-disclaimer {
            padding: var(--space-1);
            background: var(--color-bg-light);
            text-align: center;
            color: var(--color-text-dark);
            border-top: 1px solid var(--color-text-dark);
          }
        </style>

    </head>
    <body>

      <!-- -->
      <main>
      <div class="heading">
        <h1><?=$data->title?></h1>
        <p><small>by Anonymous</small></p>
      </div>

      <!-- ## Social sharing  -->

      <!-- The Social Share extension provides a common interface for share buttons.  Learn more about `amp-social-share` [here](/documentation/components/amp-social-share).  -->
      <p class="heading">
      <amp-social-share type="twitter" width="45" height="33"></amp-social-share>
      <amp-social-share type="facebook" width="45" height="33" data-attribution="254325784911610"></amp-social-share>
      <amp-social-share type="gplus" width="45" height="33"></amp-social-share>
      <amp-social-share type="email" width="45" height="33"></amp-social-share>
      <amp-social-share type="pinterest" width="45" height="33"></amp-social-share>
      </p>

      <?php
      // str_replace('<img', '<amp-img', $result);
      //  $replaceThis['<img'] = "<amp-img";
      //  $replaceThis['img>'] = "amp-img>";

       $replaceThis['border="0"'] = "";
       $replaceThis['imageanchor="1"']="";
       $thecontent = str_replace(array_keys($replaceThis), $replaceThis,$content);
       echo "<b>".$data->title." - </b>".$thecontent;

    

      ?>

 
      <!-- ## Ad support -->
      <!-- There are no limitations regarding the number or placement of ads in an AMP. Learn more about `amp-ad` [here](/documentation/components/amp-ad).  -->
      <!-- <div class="amp-ad-container">
        <amp-ad width="300" height="250"
                            type="a9"
                            data-aax_size="300x250"
                            data-aax_pubname="test123"
                            data-aax_src="302">
        </amp-ad>
      </div> -->

      <!-- ## Image galleries  -->
      <!-- Use `amp-carousel` for image galleries. Learn more about creating image galleries in AMP [here](/documentation/examples/multimedia-animations/image_galleries_with_amp-carousel/).  -->
      <!-- <amp-carousel width="1280" height="1000" layout="responsive" type="slides">
        <figure class="figure">
          <amp-img src="assets/images/news-item-1.jpg" width="1280" height="857" layout="responsive"></amp-img>
          <figcaption>Each image has a different caption.</figcaption>
        </figure>
        <figure class="figure">
          <amp-img src="assets/images/news-item-1.jpg" width="1280" height="853" layout="responsive"></amp-img>
          <figcaption>This caption is different.</figcaption>
        </figure>
        <figure class="figure">
          <amp-img src="assets/images/news-item-1.jpg" width="1280" height="853" layout="responsive"></amp-img>
          <figcaption>The third image has its caption.</figcaption>
        </figure>
      </amp-carousel> -->


      <!-- ## Interactive content -->
      <!-- To achieve its performance, AMP HTML doesn't allow custom Javascript. This doesn't mean that you can't created visually rich and interactive websites with AMP. Embed interactive content via `amp-iframe`. Learn more about `amp-iframe` [here](/content/amp-dev/documentation/components/reference/amp-iframe-v0.1.md).  -->
  

      <!-- ## Embedding related content -->
      <!-- -->

      </main>

      <!-- ## Cookie consent -->
      <!-- Use `amp-user-notification` to implement a cookie consent form (if needed). By default, the AMP runtime doesn't use cookies. Some analytics vendors might use require cookies though. Learn more about `amp-user-notification` [here](/documentation/components/reference/amp-user-notification.html) -->
      <amp-user-notification class="cookie-disclaimer" layout="nodisplay" id="amp-user-notification1">
        This page might use cookies if your analytics vendor requires them.
        <button on="tap:amp-user-notification1.dismiss">Accept</button>
      </amp-user-notification>

      <!-- ## User analytics -->
      <!-- Analytics must be configured in the body. Here we use Google Analytics to track pageviews.  -->
      <amp-analytics type="googleanalytics">
        <script type="application/json">
{
          "vars": {
            "account": "UA-160651157-4"
          },
          "triggers": {
            "default pageview": {
              "on": "visible",
              "request": "pageview",
              "vars": {
                "title": "<?=$data->title?>"
              }
            }
          }
        }
        </script>
      </amp-analytics>

    </body>
  </html>
      <?php } ?>