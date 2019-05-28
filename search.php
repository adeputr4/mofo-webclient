<?php
	
	if(!isset($_GET['q'])){
		header('location: index.php');
	}
	require_once('layout/header.php');


	$get_data = callAPI('GET', 'http://127.0.0.1:8000/api/film/search?q='.$_GET['q'], false);
	$film = json_decode($get_data,true);


?>
	
	<div class="container">
        <h3 class="judul">Our Collection</h3>
        <div class="row">
        	<?php for ($i=0; $i<count($film['data']); $i++): ?>
        	<div class="col-sm-12 col-md-3"> 
                <a href="film.php?id=<?= $film['data'][$i]['id'];?>">
                <div class="card">
                    <img src="<?=$film['data'][$i]['cover'];?>" class="card-img-top" alt="..."> 
                    <div class="card-body">
                    	<h5 class="card-title"><?= $film['data'][$i]['title'];?></h5>
                    	<p class="card-text">
                    		<?= substr($film['data'][$i]['synopsis'],0,strpos($film['data'][$i]['synopsis'], ' ', 100));?></p>
                    </div>
                </div>
                </a>
            </div>
            <?php endfor ?>             
        </div>
    </div>

<?php
	require_once('layout/footer.php');

?>
