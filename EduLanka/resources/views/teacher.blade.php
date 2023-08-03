@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="main-container">

      <div class="container1">
        <div>
            <ul class="box-info">
              <li>
                <i class='bx bx-book-open' ></i>
                <span class="text">
                  <h3>1</h3>
                  <p>My Courses</p>
                </span>
              </li>
              <li>
                <i class='bx bxs-user' ></i>
                <span class="text">
                  <h3>2</h3>
                  <p>My Students</p>
                </span>
              </li>         
              <li>
                <i class='bx bx-alarm' ></i>
                <span class="text">
                  <h3>3</h3>
                  <p>Due</p>
                </span>
              </li>
              
            </ul>
        </div>
        <div class="courses">
          <div class="cards" style="width: 50rem; height: 30rem;">
            <div class="card-body">
              <!--card body-->
            </div>
          </div>
        </div>
      </div>
      
      <div class="container2">
        <div class="cards" style="height: 38.5rem">
          <div class="card-body">
            <h5 class="card-title">Quick links</h5>            
          </div>
        </div>
      </div>
      
    </div> 
  </div>  
  <br>
  <div class="row">
    <div class="performance">
      <div class="sperf">
      <div class="cards" style="height: 39rem; width: 100%;">
          <div class="card-body">
            <h5 class="card-title">Student Peformance</h5>            
          </div>
        </div>

      </div>
      <div class="cperf">
      <div class="cards" style="height: 39rem; width: 100%;">
          <div class="card-body">
            <h5 class="card-title">Course Performance</h5>            
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection
