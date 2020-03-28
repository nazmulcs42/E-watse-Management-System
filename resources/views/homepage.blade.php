
@extends('layouts.userlayouts')
<style>
{
    box-sizing: border-box;
}

body {
  
    padding: 0px;
    background: #f1f1f1;
}

/* Header/Blog Title */



/* Style the top navigation bar */
.topnav {
    overflow: hidden;
    background-color: #333;
}

/* Style the topnav links */
.topnav a {
    float: left;
    display: block;
    color: #f2f2f2;
    text-align: center;
    padding: 0px 0px;
    text-decoration: none;
}

/* Change color on hover */
.topnav a:hover {
    background-color: #ddd;
    color: black;
}

/* Create two unequal columns that floats next to each other */
/* Left column */
.leftcolumn {   
    float: left;
    width: 80%;
}

/* Right column */
.rightcolumn {
    float: left;
    width: 20%;
    background-color: #f1f1f1;
    padding-left: 20px;
}

/* Fake image */
.fakeimg {
    background-color: #aaa;
    width: 100%;
    padding: 3px;
}

/* Add a card effect for articles */
.card {
    background-color: white;
    padding: 20px;
    margin-top: 20px;
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}

/* Footer */
.footer {
    padding: 10px;
    text-align: center;
    background: #ddd;
    margin-top: 20px;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 800px) {
    .leftcolumn, .rightcolumn {   
        width: 100%;
        padding: 0;
    }
}

/* Responsive layout - when the screen is less than 400px wide, make the navigation links stack on top of each other instead of next to each other */
@media screen and (max-width: 400px) {
    .topnav a {
        float: none;
        width: 100%;
    }
}

.carousel-inner img {
    width: 100%;
    height: 100%;
    padding: 0;
  }

</style>

@section('content')

<div class="row">
  <div class="leftcolumn">
    <div class="card">
      <div class="fakeimg" style="height:400px;">
          <div id="demo" class="carousel slide" data-ride="carousel">
          <ul class="carousel-indicators">
            <li data-target="#demo" data-slide-to="0" class="active"></li>
            <li data-target="#demo" data-slide-to="1"></li>
            <li data-target="#demo" data-slide-to="2"></li>
          </ul>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="images/slide-images/1.jpg" alt="Los Angeles" width="1100" height="500">
              <div class="carousel-caption">
                <h3>Residential(Male)</h3>
                <p>Pabna University of Science & Technology</p>
              </div>   
            </div>
            <div class="carousel-item">
              <img src="images/slide-images/2.jpg" alt="Chicago" width="1100" height="500">
              <div class="carousel-caption">
                <h3>Flowers' Garden</h3>
                <p>Kuthi Bari, Kustia</p>
              </div>   
            </div>
            <div class="carousel-item">
              <img src="images/slide-images/3.jpg" alt="New York" width="1100" height="500">
              <div class="carousel-caption">
                <h3>Flower's Garden</h3>
                <p>Kuthi Bari, Kustia</p>
              </div>   
            </div>
          </div>
          <a class="carousel-control-prev" href="#demo" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
          </a>
          <a class="carousel-control-next" href="#demo" data-slide="next">
            <span class="carousel-control-next-icon"></span>
          </a>
        </div>

      </div>
      
    </div>
    <div class="card">
      <h2>TITLE HEADING(Mapping)</h2>
      <h5>Title description, Sep 2, 2017</h5>
      <div class="fakeimg" style="height:200px;">Image</div>
      <p>Some text..</p>
      <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
    </div>
  </div>
  <div class="rightcolumn">
    <div class="card">
      <h3>User Image</h3>
      <div class="fakeimg" style="height:240px;">
          <table class="table table-hover table-bordered">
           <tbody>
              <script type="text/javascript">console.log('results');console.log(results);</script>>
          </tbody>
          </table>

      </div>
    </div>
    <div class="card">
      <h3>moving public notifications</h3>
      <div class="fakeimg" style="height:290px;">
        Notify Users
      </div>
    </div>
    <div class="card">
      <h3>Admin Info</h3>
      <div class="fakeimg" style="height:90px;">
        Admin contact
      </div>
    </div>
  </div>
</div>
@endsection