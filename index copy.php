<!DOCTYPE html>
<html>
  <head>
    
    <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>title</title>
    <link rel="canonical" href="./regular-html-version.html" />
    <meta
      name="viewport"
      content="width=device-width,minimum-scale=1,initial-scale=1"
    />
    <script type="application/ld+json">
      {
        "@context": "http://schema.org",
        "@type": "NewsArticle",
        "headline": "Article headline",
        "image": ["thumbnail1.jpg"],
        "datePublished": "2015-02-05T08:00:00+08:00"
      }
    </script>
    <script
      async
      custom-element="amp-carousel"
      src="https://cdn.ampproject.org/v0/amp-carousel-0.1.js"
    ></script>
    <script 
        async
        custom-element="amp-carousel"
        src="https://kit.fontawesome.com/2c7fc28a2f.js"></script>
    <script
      async
      custom-element="amp-ad"
      src="https://cdn.ampproject.org/v0/amp-ad-0.1.js"
    ></script>
    <style amp-boilerplate>
      body {
        -webkit-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
        -moz-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
        -ms-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
        animation: -amp-start 8s steps(1, end) 0s 1 normal both;
      }
      @-webkit-keyframes -amp-start {
        from {
          visibility: hidden;
        }
        to {
          visibility: visible;
        }
      }
      @-moz-keyframes -amp-start {
        from {
          visibility: hidden;
        }
        to {
          visibility: visible;
        }
      }
      @-ms-keyframes -amp-start {
        from {
          visibility: hidden;
        }
        to {
          visibility: visible;
        }
      }
      @-o-keyframes -amp-start {
        from {
          visibility: hidden;
        }
        to {
          visibility: visible;
        }
      }
      @keyframes -amp-start {
        from {
          visibility: hidden;
        }
        to {
          visibility: visible;
        }
      }
        html {
        background: rgb(87,117,244);
        background: linear-gradient(329deg, rgba(87,117,244,0.9252743333661589) 0%, rgba(66,83,186,1)   52%, rgba(105,189,255,1) 100%);
        height: 100vh;
        width: 100vw;
        display: flex;
        justify-content: center;
        align-items: center;
        }

        h1 {
        font-family: 'Cabin', sans-serif;
        font-size: 14px;
        padding-right: 40px;
        }

        h2, p {
        margin: 0;
        
        font-family: 'Cabin', sans-serif;
        }

        h2 {
        font-size: 14px;
        font-weight: bolder;
        
        padding-top: 5px;
        
        }

        #newsApp {
        width: 600px;
        height: 630px;
        background-color: gray;
        
        border-radius: 10px;
        box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.38);
        }

        #refresh {
        width: 80px;
        height: 80px;
        background-color: transparent;
        border: none;
        font-size: 30px;
        cursor: pointer;
        }

        #searchArticles {
        width: 80px;
        height: 80px;
        background-color: transparent;
        border: none;
        font-size: 30px;
        cursor: pointer;
        }

        #headArea {
        width: 100%;
        height: 48px;
        background-color: orange;
        
        display: flex;
        justify-content: flex-end;
        align-items: center;
        border-top-right-radius: 10px;
        border-top-left-radius: 10px;
        background: rgb(201,121,8);
        background: linear-gradient(161deg, rgba(201,121,8,1) 0%, rgba(222,137,32,1) 52%, rgba(241,173,95,1) 100%);
        
        }

        #bodyArea {
        width: 100%;
        height: 570px;
        background-color: #F7E7D4; 
        display: flex;
        flex-direction: column;
        align-items: center;
        padding-top: 10px;
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
        }



        .newsStory {
        width: 95%;
        height: 100px;
        
        display: flex;
        margin-top: 10px;
        justify-content: space-between;
        padding-left: 5px;
        border-radius: 10px;
        background: rgb(201,121,8);
        background: linear-gradient(161deg, rgba(201,121,8,1) 0%, rgba(222,137,32,1) 52%, rgba(241,173,95,1) 100%);

        }

        .newsImg {
        border-bottom-right-radius: 10px;
        border-top-right-radius: 10px;
        height: 100px;
        
        }
        .newsText {
        width: 400px;
        height: 100%;
        line-height: 1.25;
        padding-right: 5px;
        text-align: justify;
        
        }

        .readMore {
        color: black;
        font-weight: bolder;
        text-decoration: none;
        font-family: 'Cabin', sans-serif;
        
        
        }

        #textInput {
        border-radius: 5px;
        width: 300px;
        height: 25px;
        background-color: #F7E7D4;
        }

        #searchLab {
        margin-right: 5px;
        font-size: 18px;
        font-family: 'Cabin', sans-serif;
        }

        p {
        font-size: 12px;
        }
    </style>
    <noscript
      ><style amp-boilerplate>
        body {
          -webkit-animation: none;
          -moz-animation: none;
          -ms-animation: none;
          animation: none;
        }
      </style></noscript
    >
    <script async src="https://cdn.ampproject.org/v0.js"></script>

  <script src="style/script.js"></script>
  </head>
  <body>
    <div id="newsApp">
      <div id="headArea">
        <label id="searchLab">Search:</label>
        <input type="text" id="textInput" autocomplete="off">
        <button id="searchArticles"><i class="fas fa-search"></i></button>
        <button id="refresh"><i class="fas fa-sync"></i></button>
      </div>
      <div id="bodyArea">
        <div class="newsStory">
         
            <h2 class="newsTitle">News Title</h2>
            <p class="newsDesc">News Description</p>
         <!-- <img class="newsImg">  </div> -->
          <div class="newsStory">
         
         <h2 class="newsTitle">News Title</h2>
         <p class="newsDesc">News Description</p>
       <!-- <img class="newsImg"></div> -->
       <div class="newsStory">
         
         <h2 class="newsTitle">News Title</h2>
         <p class="newsDesc">News Description</p>
       <!-- <img class="newsImg"> </div> -->
          
        </div>
      </div>
     
    </div>
  </body>
</html>