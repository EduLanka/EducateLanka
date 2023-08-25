@extends('layouts.studentLayout')

@section('content')
<style>
        body{
  background-color: #F5F1E9;
}
#calendar{
  margin-left: auto;
  margin-right: auto;
  width: 150px;
  font-family: 'Lato', sans-serif;
}

#calendar_weekdays{
  width:200px;
}
#calendar_weekdays div{
  display:inline-block;
  vertical-align:top;
}
#calendar_content, #calendar_weekdays, #calendar_header{
  position: relative;
  width: 150px;
  overflow: hidden;
  float: left;
  z-index: 10;
}
#calendar_weekdays div, #calendar_content div{
  width:30px;
  height: 40px;
  overflow: hidden;
  text-align: center;
  background-color: #FFFFFF;
  color: #787878;
}
#calendar_content{
  -webkit-border-radius: 0px 0px 12px 12px;
  -moz-border-radius: 0px 0px 12px 12px; 
  border-radius: 0px 0px 12px 12px;
}
#calendar_content div{
  float: left;
  
}
#calendar_content div:hover{
  background-color: #F8F8F8;
}
#calendar_content div.blank{
  background-color: #E8E8E8;
}
#calendar_header, #calendar_content div.today{
  zoom: 1;
  filter: alpha(opacity=70);
  opacity: 0.7;
}
#calendar_content div.today{
  color: #FFFFFF;
}
#calendar_header{
  width: 85%;
  height: 37px;
  text-align: center;
  background-color: #063970;
  padding: 18px 0;
  -webkit-border-radius: 12px 12px 0px 0px;
  -moz-border-radius: 12px 12px 0px 0px; 
  border-radius: 12px 12px 0px 0px;
}
#calendar_header h1{
  font-size: 1.5em;
  color: #FFFFFF;
  float:left;
  width:70%;
}
i[class^=icon-chevron]{
  color: #FFFFFF;
  float: left;
  width:15%;
  border-radius: 50%;
}
    </style>
<div class="container">
  <div class="row">
    <div class="main-container">

      <div class="container1">
        <div>
            <ul class="box-info">
              <li class="course-count">
                <i class='bx bx-book-open' ></i>
                <span class="text">
                  <h3></h3>
                  <p>My Courses</p>
                </span>
              </li>
              <!-- <li>
                <i class='bx bxs-user' ></i>
                <span class="text">
                  <h3></h3>
                  <p>My Students</p>
                </span>
              </li>          -->
              <li>
                <i class='bx bx-alarm' ></i>
                <span class="text">
                  <h3></h3>
                  <p>Due</p>
                </span>
              </li>
              
            </ul>
        </div>
        <div class="courses">
          <div class="cards" style="width: 50rem; height: fit-content;">

              <div class="course">             
                <i class='bx bx-book'  style="background-color: {{ '#' . substr(md5(rand()), 0, 6) }}"></i>
                <span class="text">
                  <p><b></b></p>
                  <p></p>
                </span>
              </div>
        
          </div>
          <a href="">
          <button class="learn-more">
            <span class="circle" aria-hidden="true">
            <span class="icon arrow"></span>
            </span>
            <span class="button-text">GO TO COURSES</span>
          </button>
        </a>
        </div>
      </div>
      
      <div class="container2">
        <div class="cards" style="height: 38.5rem">
          <div class="card-body">
            <h5 class="card-title"><b></b></h5>
            <br>
            
            <div id="calendar">
            <div id="calendar_header"><i class="icon-chevron-left"></i>          
            <h1></h1><i class="icon-chevron-right"></i>         
            </div>
            <div id="calendar_weekdays"></div>
            <div id="calendar_content"></div>
          </div>
              
              
              </div>             
            </div>            
          </div>
        </div>
      </div>
      
    </div> 
  </div>  
  <br>
  <div class="row">
    <div class="performance">

    
  <!--End of modal-->


 

<!-- <div class="container">
<div class="search-container">
  <input class="input" type="text">
  <svg viewBox="0 0 24 24" class="search__icon">
    <g>
      <path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z">
      </path>
    </g>
  </svg>
</div>
</div>

<style>
    
.container {
  position: left;
  background: linear-gradient(135deg, rgb(179, 208, 253) 0%, rgb(164, 202, 248) 100%);
  border-radius: 1000px;
  padding: 10px;
  display: grid;
  place-content: center;
  z-index: 0;
  max-width: 300px;
  margin: 0 10px;
}

.search-container {
  position: relative;
  width: 100%;
  border-radius: 50px;
  background: linear-gradient(135deg, rgb(218, 232, 247) 0%, rgb(214, 229, 247) 100%);
  padding: 5px;
  display: flex;
  align-items: center;
}

.search-container::after, .search-container::before {
  content: "";
  width: 100%;
  height: 100%;
  border-radius: inherit;
  position: absolute;
}

.search-container::before {
  top: -1px;
  left: -1px;
  background: linear-gradient(0deg, rgb(218, 232, 247) 0%, rgb(255, 255, 255) 100%);
  z-index: -1;
}

.search-container::after {
  bottom: -1px;
  right: -1px;
  background: linear-gradient(0deg, rgb(163, 206, 255) 0%, rgb(211, 232, 255) 100%);
  box-shadow: rgba(79, 156, 232, 0.7019607843) 3px 3px 5px 0px, rgba(79, 156, 232, 0.7019607843) 5px 5px 20px 0px;
  z-index: -2;
}

.input {
  padding: 10px;
  width: 100%;
  background: linear-gradient(135deg, rgb(218, 232, 247) 0%, rgb(214, 229, 247) 100%);
  border: none;
  color: #9EBCD9;
  font-size: 20px;
  border-radius: 50px;
}

.input:focus {
  outline: none;
  background: linear-gradient(135deg, rgb(239, 247, 255) 0%, rgb(214, 229, 247) 100%);
}

.search__icon {
  width: 50px;
  aspect-ratio: 1;
  border-left: 2px solid white;
  border-top: 3px solid transparent;
  border-bottom: 3px solid transparent;
  border-radius: 50%;
  padding-left: 12px;
  margin-right: 10px;
}

.search__icon:hover {
  border-left: 3px solid white;
}

.search__icon path {
  fill: white;
}
</style> --> <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
        $(function(){function c(){p();var e=h();var r=0;var u=false;l.empty();while(!u){if(s[r]==e[0].weekday){u=true}else{l.append('<div class="blank"></div>');r++}}for(var c=0;c<42-r;c++){if(c>=e.length){l.append('<div class="blank"></div>')}else{var v=e[c].day;var m=g(new Date(t,n-1,v))?'<div class="today">':"<div>";l.append(m+""+v+"</div>")}}var y=o[n-1];a.css("background-color",y).find("h1").text(i[n-1]+" "+t);f.find("div").css("color",y);l.find(".today").css("background-color",y);d()}function h(){var e=[];for(var r=1;r<v(t,n)+1;r++){e.push({day:r,weekday:s[m(t,n,r)]})}return e}function p(){f.empty();for(var e=0;e<7;e++){f.append("<div>"+s[e].substring(0,3)+"</div>")}}function d(){var t;var n=$("#calendar").css("width",e+"px");n.find(t="#calendar_weekdays, #calendar_content").css("width",e+"px").find("div").css({width:e/7+"px",height:e/7+"px","line-height":e/7+"px"});n.find("#calendar_header").css({height:e*(1/7)+"px"}).find('i[class^="icon-chevron"]').css("line-height",e*(1/7)+"px")}function v(e,t){return(new Date(e,t,0)).getDate()}function m(e,t,n){return(new Date(e,t-1,n)).getDay()}function g(e){return y(new Date)==y(e)}function y(e){return e.getFullYear()+"/"+(e.getMonth()+1)+"/"+e.getDate()}function b(){var e=new Date;t=e.getFullYear();n=e.getMonth()+1}var e=480;var t=2013;var n=9;var r=[];var i=["JANUARY","FEBRUARY","MARCH","APRIL","MAY","JUNE","JULY","AUGUST","SEPTEMBER","OCTOBER","NOVEMBER","DECEMBER"];var s=["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];var o=["#16a085","#1abc9c","#c0392b","#27ae60","#FF6860","#f39c12","#f1c40f","#e67e22","#2ecc71","#e74c3c","#d35400","#2c3e50"];var u=$("#calendar");var a=u.find("#calendar_header");var f=u.find("#calendar_weekdays");var l=u.find("#calendar_content");b();c();a.find('i[class^="icon-chevron"]').on("click",function(){var e=$(this);var r=function(e){n=e=="next"?n+1:n-1;if(n<1){n=12;t--}else if(n>12){n=1;t++}c()};if(e.attr("class").indexOf("left")!=-1){r("previous")}else{r("next")}})})
    </script>
@endsection