<style>
.header-basic-light{
	padding: 20px 40px;
	box-sizing:border-box;
	box-shadow: 0 0 7px 0 rgba(0, 0, 0, 0.15);
	height: 80px;
	background-color: #fff;
}

.header-basic-light .header-limiter {
	max-width: 1200px;
	text-align: center;
	margin: 0 auto;
}

/* Logo */

.header-basic-light .header-limiter h1{
	float: left;
	font: normal 28px Cookie, Arial, Helvetica, sans-serif;
	line-height: 40px;
	margin: 0;
}

.header-basic-light .header-limiter h1 span {
	color: FireBrick;
}

/* The header links */

.header-basic-light .header-limiter a {
	color: #5c616a;
	text-decoration: none;
}

.header-basic-light .header-limiter nav{
	font:15px Arial, Helvetica, sans-serif;
	line-height: 40px;
	float: right;
}

.header-basic-light .header-limiter nav a{
	display: inline-block;
	padding: 0 5px;
	opacity: 0.9;
	text-decoration:none;
	color: #5c616a;
	line-height:1;
}

.header-basic-light .header-limiter nav a.selected {
	background-color: #86a3d5;
	color: #ffffff;
	border-radius: 3px;
	padding:6px 10px;
}

/* Making the header responsive. */

@media all and (max-width: 600px) {

	.header-basic-light {
		padding: 20px 0;
		height: 85px;
	}

	.header-basic-light .header-limiter h1 {
		float: none;
		margin: -8px 0 10px;
		text-align: center;
		font-size: 24px;
		line-height: 1;
	}

	.header-basic-light .header-limiter nav {
		line-height: 1;
		float:none;
	}

	.header-basic-light .header-limiter nav a {
		font-size: 13px;
	}

}

/* For the headers to look good, be sure to reset the margin and padding of the body */

body {
	margin:0;
	padding:0;
}
</style>
<header class="header-basic-light">

	<div class="header-limiter">

		<h1><a href="#"><span>NJIT</span> Test Services</a></h1>

		<nav>
			<a href="teacher.php">Teacher Home</a>
		  <a href="makeexam.php">Add Questions</a>
			<a href="makeexam2.php">Make Exam</a>
			<a href="https://web.njit.edu/~kon2/professor_release_exam.html">Release Exam</a>
			<a href="https://web.njit.edu/~kon2/">Log Out</a>

		</nav>
	</div>

</header>
<!-- <div class="header">
  <a href="teacher.php" class="logo">Teacher Dashboard</a>
  <div class="header-right">
    <a class="active" href="makeexam.php">Make Exam</a>
    <a href="makequestion.php">Add Question</a>
    <a class="active" href="releaseexam.php">Release Exam</a>
  </div>
</div> -->
