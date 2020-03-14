function searchString() {
  
  let searchQuery = document.getElementById("textInput");
  
  fetch('https://newsapi.org/v2/everything?q=' + searchQuery.value + '&sources=bbc-news&pageSize=5&apiKey=2b1622ae162c41b28bd69ebbef790934')
  .then((searchResponse) => searchResponse.json())
  .then((searchResponseJson) =>{
    console.log(searchResponseJson);
    populateFeed(searchResponseJson);
})  
}

function refreshFeed() {
 
 fetch('https://newsapi.org/v2/top-headlines?sources=bbc-news&pageSize=5&apiKey=2b1622ae162c41b28bd69ebbef790934')
  .then((response) => response.json())
  .then((responseJson) =>{
   
    populateFeed(responseJson);
})  
};

function populateFeed(responseData){
  
  let bodyArea = document.getElementById("bodyArea");
  while (bodyArea.hasChildNodes()) {
    bodyArea.removeChild(bodyArea.lastChild);
  }
  
  for(let i = 0; i < responseData.articles.length; i++) {
  let newStory = document.createElement("div")
  let storyTitle = document.createElement("h2");
  let storyDesc = document.createElement("p");
  let storyImg = document.createElement("img");
  let storyUrl = document.createElement("a");
  let newsText = document.createElement("div");
  
   
  newStory.setAttribute("id", "story" + i)  
  newStory.setAttribute("class", "newsStory");
  newsText.setAttribute("class", "newsText");
  storyTitle.setAttribute("class", "newsTitle");
  storyDesc.setAttribute("class", "newsDesc");
  storyImg.setAttribute("class", "newsImg" );
  storyUrl.setAttribute("href",  responseData.articles[i].url);
  storyUrl.setAttribute("target", "_blank");
  storyUrl.setAttribute("class", "readMore");
  
  
  newsText.appendChild(storyTitle);
  newsText.appendChild(storyDesc);
  newsText.appendChild(storyUrl);
  newStory.appendChild(newsText);
  newStory.appendChild(storyImg);
  bodyArea.appendChild(newStory);
  
  
 
  storyUrl.appendChild(document.createTextNode("Read More"))
  storyDesc.appendChild(document.createTextNode(responseData.articles[i].description))
  storyTitle.appendChild(document.createTextNode(responseData.articles[i].title))
  storyImg.src = responseData.articles[i].urlToImage;
};
}

document.getElementById("refresh").addEventListener("click", refreshFeed);
document.getElementById("searchArticles").addEventListener("click", searchString);
refreshFeed();