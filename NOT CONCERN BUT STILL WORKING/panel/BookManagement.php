<?php
session_start();

if(!$_SESSION['loggedin']) header("Location: ../index.php");
?>

<?php include "theme/header.php"; ?>

<main>
	<h1>Your Private Page</h1>
	<div style="display: flex;">
		<div style="flex:1">
			<?php include "theme/sidebar.php" ?>
		</div>
		<div style="flex:2;">
			Use Sidebar to Navigate Administrator Panel
		</div>
	</div>
</main>

<?php include "../theme/footer.php"; ?>