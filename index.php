<?php include "theme/header.php"; ?>
<header class="homepage__herobox__container">
		<div class="herobox__navbar__container">
			<ul class="herobox__navbar__items">
				<li data-aos="fade-left" class="herobox__navbar__item">
					<a href="index.php" class="herobox__navbar__link">خانه</a>
				</li>
				<li data-aos="fade-left" class="herobox__navbar__item">
					<a href="Books.php" class="herobox__navbar__link">کتاب ها</a>
				</li>
				
				<?php if(isset($_SESSION['loggedin'])): ?>
					<!-- <li> <a href="panel/"> Panel </a> </li> -->
					<li data-aos="fade-left" class="herobox__navbar__item"> 
						<a href="Profile.php" class="herobox__navbar__link">
							پروفایل
						</a> 
					</li>
					<li data-aos="fade-left" class="herobox__navbar__item"> 
						<a href="logout.php" class="herobox__navbar__link">
							خروج
						</a> 
					</li>
				<?php else: ?>
					<li data-aos="fade-left" class="herobox__navbar__item"> 
						<a href="login.php" class="herobox__navbar__link">
							ورود 
						</a> 
					</li>
					<li data-aos="fade-left" class="herobox__navbar__item"> 
						<a href="register.php" class="herobox__navbar__link herobox__navbar__link--cta">
							ثبت نام 
						</a> 
					</li>
				<?php endif;?>
			</ul>
		</div>
        <div class="homepage__herobox__illustration">
            <img id="image" src="./theme/images/undraw_book_lover_light.svg">
        </div>
    </header>

<?php include "theme/footer.php"; ?>