<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Documentation</title>

      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
    
        <link href="{{ asset('css/documentation.css') }}" rel="stylesheet">
      </head>
<body>
  <!-- Main Page Wrapper-->
  <div class="container col-lg-12 col-md-12 col-sm-12 col-xs-12" id="mainWrapper" >
    <!-- Main Page Heading-->
    <div id="documentationHeading" class="mainHeading">
      <h1>Documentation</h1>
    </div>

    <!-- Introduction Section-->
    <div id="introduction" class="section">
      <!-- Introduction Heading-->
    <div id="introductionHeading" class="sectionHeading">
      <h3>Introduction</h3>
    </div>
    <!-- Introduction About Me and Project-->
    <div id="introductionContentMe">
      <p>Hello, My name is <span id="myName">Anum Amir</span>. I am a student of BSSE (7th Semester). 
        I built this project as an attempt to further improve my web development skills, logic building, CRUD concepts and also learn how to host and manage a website.
        The scope of the project was to provide the managment of a housing society the facility to upload details about their society, upcoming events n provide circulars online rather than distributing them manually.
      </p>
    </div>
    <div id="introductionContentProject">
      this project has been built using the following languages, framework and tools
      <ul>
        <li><span id="laravel">Laravel Framework</span></li>
        <li>PHP</li>
        <li>HTML 5</li>
        <li>CSS</li>
        <li>Bootstrap</li>
        <li>Javascript</li>
        <li>Jquery</li>
        <li>VS Code text Editor</li>
        <li>GitHub</li>
      </ul>
    </div>
    </div>
    <!-- Functionality CRUD Section-->
    <div id="functionality" class="section">
      <div id="siteOverView">
        <!-- Home Page --> <!-- -->
        <div class="itemVideo"></div>
        <!-- Admin Page -->
        <div class="itemVideo"></div>
      </div>
      <h3 id="functionalityHeading" class="sectionHeading">The Project has the following <span class="CRUD">CRUD</span> operations present</h3>
        
      <!-- Create Read -->
      <div id="create">
      <h4 class="functionItem"><span class="CRUD">CREATE READ</span></h4>

      <!-- News -->
      <div class="item">
      <b class="itemHeading">News</b>
      <p>Add news to home page to let people know about upcoming events. Can attatch image and/or file</p>
      <div class="itemVideo"></div>
      </div>

      <!-- Images -->
      <div class="item">
      <b class="itemHeading">Images</b>
      <p>Add images to different sliders to let people know more about the society</p>
      <div class="itemVideo"></div>
      </div>

      <!-- Circulars -->
      <div class="item">
      <b class="itemHeading">Circulars</b>
      <p>Upload circulars so people can download important society related circulars</p>
      <div class="itemVideo"></div>
      </div>

      <!-- Members -->
      <div class="item">
      <b class="itemHeading">Members</b>
      <p>Add details about members to let people know more about the people responsible for managing the housing society.</p>
      <div class="itemVideo"></div>
      </div>

      <!-- Messages -->
      <div class="item">
      <b class="itemHeading">Messages</b>
      <p>Site visitors can contact site admin for query or complaint and the site admin can respond to them using built-in message system. The visitor would receive the reply through email</p>
      <div class="itemVideo"></div>
      </div>

    </div>

    <!-- Update -->
        <div id="update">
      <h4 class="functionItem"><span class="CRUD">UPDATE</span></h4>

      <!-- News -->
      <div class="item">
      <b class="itemHeading">News i.e change title or change uploaded file</b>
      <p>News title, content, image, file can be edited</p>
      <div class="itemVideo"></div>
      </div>

      <!-- Images -->
      <div class="item">
      <b class="itemHeading">Images</b>
      <p>image titles can be changed and images can be moved to different image sliders(achievements, onGoing projects, gallery or main home slider)</p>
      <div class="itemVideo"></div>
      </div>

      <!-- Circulars -->
      <div class="item">
      <b class="itemHeading">Circulars</b>
      <p>Same functionality as News i.e change title or change uploaded file</p>
      <div class="itemVideo"></div>
      </div>

      <!-- Members -->
      <div class="item">
      <b class="itemHeading">Members</b>
      <p>Members details can be edited, they can be moved to different member types (Committe, Focal)</p>
      <div class="itemVideo"></div>
    </div>
  </div>

  <!-- Delete -->
    <div id="delete">
      <h4 class="functionItem"><span class="CRUD">DELETE</span></h4>
      <div class="item">
              <b class="itemHeading">News, Images, Circulars, Soceity Members</b>
              <p>All the created/uploaded data can be deleted to remove them permanently from the database or it can be removed from the website by disabling that data while keeping the data in the database</p>
              <div class="itemVideo"></div>
            </div>
    </div>

    <!-- Future Update Section-->
        <div id="futureUpdate" class="section">
          <!-- Future Update Heading-->
          <div id="futureUpdateHeading" class="sectionHeading">
            <h3>Future Updates</h3>
            <ul>
              <li>Registered people can download society electricity bill</li>
              <li>Registered people can receive admin message on their dashboard</li>
              <li>Make gui changes
                <ul>
                  <li>Show date of when news was made</li>
                  <li>Add emergency contact number block in hex grid</li>
                  <li>Reduce email send wait by fowarding the email reply function to laravel job queue</li>
                  <li>Fix issues(if any) regarding site responsive design</li>
                  <li>Add success and error messages flash in admin panel for different actions performed</li>
                </ul>
              </li>
            </ul>
          </div>
  </div>

  </div>
</body>
</html>