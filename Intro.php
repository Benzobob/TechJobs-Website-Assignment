<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title> Intro Page </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/NavBarStyle1.css">
  <link rel="stylesheet" href="css/IntroStyle.css">
  </head>

<body>
<form action="/action_page.php">

<div class="icon-bar">
  <a class="active" href="Intro.php"><i><image src="images/icon.PNG" style="width:100px;height:100px;"></i></a>
</div>
<hr>
<div class="container">
  <div class="row">
    <div class="col-4">
      <h1><strong>About Us</strong></h1>
	  <br>
	  <p>Our site aims to benefit the entire population of the tech industry.<br>
	  We have created a platform to help our users find jobs, as well as allowing <br>
	  companies to sign up and search for employees. We act as a middle ground <br>
	  between employers and potential employees by allowing our users to express <br>
	  their skills, work experience and academic degrees on their personal profile <br>
	  page.
	  </p>
    </div>
    <div class="col-3" style="text-align:center;">
      <h3> User </h3>
		<a href="LogIn.php"> <button type="button" class="btn btn-outline-success">Log In</button></a>
		<a href="CreateUser.php"><button type="button" class="btn btn-outline-success">Sign Up</button></a>
	</div>
	<div class="col-3" style="text-align:center;">
      <h3> Company </h3>
		<a href="CompanyLogIn.php"> <button type="button" class="btn btn-outline-success">Log In</button></a>
		<a href="CreateCompany.php"><button type="button" class="btn btn-outline-success">Sign Up</button></a>
	</div>
  </div>
</div>
</body>
</html>
  