import 'fuse.js';

/* Search function */
!function(e){"use strict";var t=document.body,n=document.querySelector(".search-open"),s=document.querySelector(".search-close"),a=document.querySelector(".search-input"),r=document.querySelector(".search-info-wrap"),c=document.querySelector(".search-counter-wrap"),i=document.querySelector(".counter-results"),o=document.querySelector(".search-results");function u(){t.classList.remove("search-opened"),a.value="",o.innerHTML="",c.classList.add("hide"),r.classList.remove("hide")}t.addEventListener("keyup",function(e){27==e.keyCode&&u()}),n.addEventListener("click",function(){t.classList.add("search-opened"),a.focus()}),s.addEventListener("click",u),n.addEventListener("click",function e(){if(!1===d){var t=ghost.url.api("posts",{absolute_urls: true,limit:"all",formats:["plaintext"],fields:"id,url,title,plaintext,featured,published_at"}),s=new XMLHttpRequest;s.open("GET",t,!0),s.onload=function(){var e,t;s.status>=200&&s.status<400&&(s.response,e=JSON.parse(s.responseText),t=new Fuse(e.posts,options),a.onkeyup=function(e){if(i.innerHTML="",o.innerHTML="",this.value.length>2&&(r.classList.add("hide"),c.classList.remove("hide")),this.value.length<3&&(r.classList.remove("hide"),c.classList.add("hide")),!(this.value.length<=2)){var n=t.search(e.target.value);i.innerHTML=n.length,n.map(function(e){var t=new Date(e.published_at).toLocaleDateString(document.documentElement.lang,{year:"numeric",month:"long",day:"numeric"}),n=document.createElement("h4");n.textContent=e.title,n.innerHTML+='<span class="search-date">'+searchPublished+" — "+t+"</span>",e.featured&&(n.innerHTML+='<span class="search-featured">'+searchFeaturedIcon+"</span>");var s=document.createElement("a");s.setAttribute("href",e.url),s.appendChild(n),o.appendChild(s)})}})},s.send(),n.removeEventListener("click",e)}d=!0});var d=!1}(window);

/* Custom settings for Fuse */
var options = {
    shouldSort: true,
    tokenize: true,
    matchAllTokens: true,
    threshold: 0,
    location: 0,
    distance: 100,
    maxPatternLength: 32,
    minMatchCharLength: 1,
    keys: [{name: 'title'},{name: 'plaintext'}]
};