<hr>
<div class="col">
	<div class="row text-center p-2">
		<span id="countPage" class="d-none"><?php echo $arg['countPage']; ?></span>

		<nav aria-label="Page navigation example" class="navbar">
			<ul class="pagination">

				<li class="page-item">
				  <a class="page-link" href="#" aria-label="Previous" data-href="previosPage">
					<span aria-hidden="true">&laquo;</span>
				  </a>
				</li>

			  <?php for($i=1; $i<=$arg['countPage']; $i++) {?>
				<li class="page-item"><a class="page-link <?php echo ($i==$_SESSION['page']? 'activePage': ''); ?>" href="#" data-href="goPage"><?php echo $i;?></a></li>
			  <?php }?>

				<li class="page-item">
				  <a class="page-link" href="#" aria-label="Next" data-href="nextPage">
					<span aria-hidden="true">&raquo;</span>
				  </a>
				</li>


			</ul>
		</nav>

	</div>
</div>
  
 <script>
 $('nav a').on('click',function(){aClick(this)} );
</script> 