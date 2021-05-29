<?php session_start();?>
<?php
require_once "includes/Database_Configuration.php";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT Title, CategoryID FROM Category Order By Title";

?>
<div id="nav">
	<nav class="navbar">
		<ul class="navbar__items">
			<div class="theme-switch-wrapper">
				<span id="toggle-icon">
					<label class="theme-switch">
						<input type="checkbox">
						<div class="slider round"></div>
					</label>
				</span>
			</div>
			<li class="navbar__item">
				<a href="index.php" class="navbar__link">خانه</a>
			</li>
			<li class="navbar__item">
				<a href="Books.php" class="navbar__link">کتاب ها</a>
			</li>
			<li class="navbar__item">
				<button class="navbar__link" id="dropdown-button"> موضوعات &nbsp;<i id="icon" class='fas fa-angle-down'></i></button>
				<ul class="dropdown__items" id="dropdown">
					<?php
						if($result = $conn->query($sql)) {
							while ($row = $result->fetch_row()) {
								echo "<li class='animate__animated animate__fadeInDown dropdown__item'><a href='Category.php?id=$row[1]' class='dropdown__link'>
								$row[0]
								</a></li>";
							}
							$result->free_result();
						}
					?>
				</ul>
			</li>
		</ul>
	</nav>
	<div class="brand">
		<a href="index.php" class="brand__link">
			<h1 class="brand__name">Planet Bookshop</h1>
		</a>
	</div>
	<nav class="navbar navbar__user">
		<ul class="navbar__items navbar__user__items">
			<li class="navbar__item navbar__user__item"> 
				<button class="navbar__link" id="dropdown-search">
					<i class='fas fa-search' style='font-size:16px'></i>
				</button>
				<div class="searchbar__container" id="search__container">
					<form class="searchbar" action="SearchFunctionality.php" method="POST">
						<input data-aos="fade-left" type="text" name="Search" id="search" required> 
						<div>
							<input type="submit" value="جستجو" data-aos="fade-left" class="search-button" />
						</div>
					</form>
				</div>
			</li>
			<?php if(isset($_SESSION['loggedin'])): ?>
				<li class="navbar__item navbar__user__item"> 
					<a href="Profile.php"  class="navbar__link">
						<i class='fas fa-user-alt' style='font-size:16px'></i>
					</a> 
				</li>
				<li class="navbar__item navbar__user__item"> 
					<a href="logout.php"  class="navbar__link">
						خروج
					</a> 
				</li>
			<?php else: ?>
				<li class="navbar__item"> 
					<a href="login.php" class="navbar__link">
						ورود 
					</a> 
				</li>
				<li class="navbar__item"> 
					<a href="register.php" class="navbar__link navbar__link--cta">
						ثبت نام 
					</a> 
				</li>
			<?php endif;?>
			
		</ul>
		
	</nav>
	
</div>