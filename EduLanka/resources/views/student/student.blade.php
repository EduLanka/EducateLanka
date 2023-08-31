@extends('layouts.studentLayout')

@section('content')

<style>
    body {
        background-color: #F5F1E9;
    }
    #calendar {
        margin-left: auto;
        margin-right: auto;
        width: 150px;
        font-family: 'Lato', sans-serif;
    }
    #calendar_weekdays {
        width: 200px;
    }
    #calendar_weekdays div {
        display: inline-block;
        vertical-align: top;
        color: blue; /* Added blue color to weekdays */
    }
    #calendar_content, #calendar_weekdays, #calendar_header {
        position: relative;
        width: 150px;
        overflow: hidden;
        float: left;
        z-index: 10;
    }
    #calendar_weekdays div, #calendar_content div {
        width: 30px;
        height: 40px;
        overflow: hidden;
        text-align: center;
        background-color: #FFFFFF;
        color: #787878;
    }

    
#calendar_weekdays div {
    color: blue; /* Set the font color to blue */
}

    #calendar_content {
        -webkit-border-radius: 0px 0px 12px 12px;
        -moz-border-radius: 0px 0px 12px 12px;
        border-radius: 0px 0px 12px 12px;
    }
    #calendar_content div {
        float: left;
    }
    #calendar_content div:hover {
        background-color: #F8F8F8;
    }
    #calendar_content div.blank {
        background-color: #b0c7c4p;
    }
    #calendar_header, #calendar_content div.today {
        zoom: 1;
        filter: alpha(opacity=70);
        opacity: 0.7;
    }
    #calendar_content div.today {
        color: #FFFFFF;
    }
    #calendar_header {
        width: 100%;
        height: 37px;
        text-align: center;
        background-color: #FF6860;
        padding: 18px 0;
        -webkit-border-radius: 12px 12px 0px 0px;
        -moz-border-radius: 12px 12px 0px 0px;
        border-radius: 12px 12px 0px 0px;
    }
    #calendar_header h1 {
        font-size: 1.5em;
        color: #FFFFFF;
        float: left;
        width: 70%;
    }
    i[class^=icon-chevron] {
        color: blue;
        float: left;
        width: 15%;
        border-radius: 50%;
    }

    #calendar_header{
      background-color:black;
    }

    .go-to-courses-button {
    display: flex;
    justify-content: flex-end; /* Move the button to the right */
    margin-top: 1rem;
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
                <h3>{{$courseCount}}</h3>
                  <p>My Courses</p>
                </span>
              </li>
              <li class="due-count">
                <i class='bx bx-alarm' ></i>
                <span class="text">
                <h3>{{$notSubmittedCount}}</h3>
                  <p>Due</p>
                </span>

              
            </ul>
        </div>
        
        <div class="courses">
          <div class="cards" style="width: 50rem; height: fit-content;">

          @foreach($courses as $course)
              <div class="course">             
                <i class='bx bx-book'  style="background-color: {{ '#' . substr(md5(rand()), 0, 6) }}"></i>
                <span class="text">
                  <p><b>{{$course -> level}}</b></p>
                  <p>{{$course -> subject}}</p>
                </span>
              </div>
          @endforeach
          </div>
          <a href="{{route('student.courses')}}" class="go-to-courses-button">
    <button class="learn-more1">
        <span class="circle" aria-hidden="true">
            <span class="icon arrow"></span>
        </span>
        <span class="button-text">GO TO COURSES</span>
    </button>
</a>


        </div>
      </div>
      
      
      <div id="calendar">
    <div id="calendar_header"><i class="icon-chevron-left"></i>
        <h1></h1><i class="icon-chevron-right"></i>
    </div>
    <div id="calendar_weekdays">
        <div>Sun</div>
        <div>Mon</div>
        <div>Tue</div>
        <div>Wed</div>
        <div>Thu</div>
        <div>Fri</div>
        <div>Sat</div>
    </div>
    <div id="calendar_content">
        <!-- Calendar content will go here -->
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
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
        $(function(){function c(){p();var e=h();var r=0;var u=false;l.empty();while(!u){if(s[r]==e[0].weekday){u=true}else{l.append('<div class="blank"></div>');r++}}for(var c=0;c<42-r;c++){if(c>=e.length){l.append('<div class="blank"></div>')}else{var v=e[c].day;var m=g(new Date(t,n-1,v))?'<div class="today">':"<div>";l.append(m+""+v+"</div>")}}var y=o[n-1];a.css("background-color", "#0000FF").find("h1").text(i[n - 1] + " " + t);f.find("div").css("color",y);l.find(".today").css("background-color","#87CEFA");d()}function h(){var e=[];for(var r=1;r<v(t,n)+1;r++){e.push({day:r,weekday:s[m(t,n,r)]})}return e}function p(){f.empty();for(var e=0;e<7;e++){f.append("<div>"+s[e].substring(0,3)+"</div>")}}function d(){var t;var n=$("#calendar").css("width",e+"px");n.find(t="#calendar_weekdays, #calendar_content").css("width",e+"px").find("div").css({width:e/7+"px",height:e/7+"px","line-height":e/7+"px"});n.find("#calendar_header").css({height:e*(1/7)+"px"}).find('i[class^="icon-chevron"]').css("line-height",e*(1/7)+"px")}function v(e,t){return(new Date(e,t,0)).getDate()}function m(e,t,n){return(new Date(e,t-1,n)).getDay()}function g(e){return y(new Date)==y(e)}function y(e){return e.getFullYear()+"/"+(e.getMonth()+1)+"/"+e.getDate()}function b(){var e=new Date;t=e.getFullYear();n=e.getMonth()+1}var e=480;var t=2013;var n=9;var r=[];var i=["JANUARY","FEBRUARY","MARCH","APRIL","MAY","JUNE","JULY","AUGUST","SEPTEMBER","OCTOBER","NOVEMBER","DECEMBER"];var s=["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];var o=["#0000FF","#0000FF","#0000FF","#0000FF","#0000FF","#0000FF","#0000FF","#0000FF","#0000FF","#0000FF","#0000FF","#0000FF"];var u=$("#calendar");var a=u.find("#calendar_header");var f=u.find("#calendar_weekdays");var l=u.find("#calendar_content");b();c();a.find('i[class^="icon-chevron"]').on("click",function(){var e=$(this);var r=function(e){n=e=="next"?n+1:n-1;if(n<1){n=12;t--}else if(n>12){n=1;t++}c()};if(e.attr("class").indexOf("left")!=-1){r("previous")}else{r("next")}})})
    </script>
@endsection