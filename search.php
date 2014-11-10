 <?php
 require_once 'libs/db.class.php';
require_once 'libs/global.inc.php';
 ?>
 <html>
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 <link rel="stylesheet" href="style.css"/>
 <script src='jquery.js' type="text/javascript"></script>
 </head>
 <body>
 <div class="search-background1">
			<label><img src="load.gif" alt="" /></label>
	</div>
	<?php $q = isset($_GET['q']) ? $_GET['q'] : ""; ?>
 <div id="news" class="tabcon">
 <?php if(isset($_GET['q'])): ?>
	<h2 class="c2title">Resultados para : "<?php echo$_GET['q'] ?> "  <form style="float:right;" action="search.php" method="get">Search:<input type="text" id="a-j-search-term" value="<?php echo $q; ?>" name="q"/></form></h2><br/>
	
	<div id="ress"></div>
	
	<?php
	//$sql1="select * from article where btitle LIKE '%$_GET[q]%' LIMIT 3";
	//$result1=$db->select($sql1);
	?>
	
	<div id="pages-search">
		<?php
		 $query="select count(*) as tot from 2dc_marcasvino where Nombre LIKE '%$_GET[q]%' and Puntuacion >= 80";
		// echo $sql1;
		  $countset=$db->runquery($query);
		  $count=$db->get_row($countset);
		  $tot=$count['tot'];
		  $page=1;
		  $ipp=3;//items per page
		  $totalpages=ceil($tot/$ipp);
		  echo"<ul class='pages'>";		  
		  for($i=1;$i<=$totalpages; $i++)
		  {
			  echo"<li class='$i'>$i</li>";
		  }
		  echo"</ul>";
		?>
	</div>
<?php endif; ?>
</div>

<script type="text/javascript" src="ajax1.js"></script>

</body>
</html>