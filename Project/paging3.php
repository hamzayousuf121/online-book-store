<?php 
 require 'db.php';
 include 'header-scripts.php';
 include "header.php"; 
	$limit = isset($_POST["limit-records"]) ? $_POST["limit-records"] : 500;
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	$start = ($page - 1) * $limit;
	$result = $con->query("SELECT * FROM bookrecord LIMIT $start, $limit");
	$book_row = $result->fetch_all(MYSQLI_ASSOC);

	$result1 = $con->query("SELECT count(id) AS id FROM bookrecord");
	$custCount = $result1->fetch_all(MYSQLI_ASSOC);
	$total = $custCount[0]['id'];
	$pages = ceil( $total / $limit );

	$Previous = $page - 1;
	$Next = $page + 1;

 ?>
 <body class="bg-success">
				<?php foreach($book_row as $result) {  ?>
					<div class="main">
								<img class="child" src="images/java.jpg" alt="<?php echo $result['title'];?>">
								<h3><?php echo $result['title'];?></h3>
								<p><?php echo $result['description'];?></p>
								<p>Rs:<?php echo $result['price'];?></p>
								<a href="<?php echo $result['url'];?>"><button class="btn btn-success">Download</button></a>
					</div>
	        	<?php }; ?>
		</div>
	
		</div>
		<div class="container well">
		<div class="row">
			<div class="col-md-10">
				<nav aria-label="Page navigation">
					<ul class="pagination">
				    <li>
				      <a href="index.php?page=<?= $Previous; ?>" aria-label="Previous">
				        <span aria-hidden="true">&laquo; Previous</span>
				      </a>
				    </li>
				    <?php for($i = 1; $i<= $pages; $i++) { ?>
				    	<li><a href="paging3.php?page=<?= $i; ?>"><?= $i; ?></a></li>
				    <?php }; ?>
				    <li>
				      <a href="index.php?page=<?= $Next; ?>" aria-label="Next">
				        <span aria-hidden="true">Next &raquo;</span>
				      </a>
				    </li>
				  </ul>
				</nav>
			</div>	
		</div>
</body>
</html>
