<?php
	
	require_once('layout/header.php');
    

    if(!isset($_GET['id'])){

        header('location: index.php');

    }

	$get_data = callAPI('GET', 'http://127.0.0.1:8000/api/film/id/'.$_GET['id'], false);
	$film = json_decode($get_data,true);

	


?>
	
	<div class="container">
        <h3 class="judul"><?=$film['data'][0]['title'];?></h3>
        <div class="row">
        	<div class="col-sm-12 col-md-3"> 
                <div class="card">
                    <img src="<?=$film['data'][0]['cover'];?>" class="card-img-top" alt="..."> 
                    <div class="card-body">
                    	<h5 class="card-title"></h5>
                    	<p class="card-text">
                    </div>
                </div>
            </div> 

            <div class="col-sm-12 col-md-9" > 
                <table class="table table-dark" style="margin-top:25px">
                  <tbody>
                    <tr>
                      <td>Type</td>
                      <td>: <?=$film['data'][0]['type'];?></td>
                    </tr>
                    <tr>
                      <td>Episodes</td>
                      <td>: <?=$film['data'][0]['episodes'];?></td>
                    </tr>
                    <tr>
                      <td>Year</td>
                      <td>: <?=$film['data'][0]['year'];?></td>
                    </tr>
                    <tr>
                      <td>Country</td>
                      <td>: <?=$film['data'][0]['country'];?></td>
                    </tr>
                    <tr>
                      <td>Trailer</td>
                      <td>: <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#trailer">Watch Trailer</button>
                      </td>
                    </tr>
                    <tr>
                      <td>Synopsis</td>
                      <td>: <?=$film['data'][0]['synopsis'];?></td>
                    </tr>
                   
                  </tbody>
                </table>
            </div>         
        </div>
    </div>


    <div class="modal fade " id="trailer" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Trailer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <iframe width="100%" height="450" src="<?=$film['data'][0]['trailer'];?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
    </div>
  </div>
</div>

<?php
	require_once('layout/footer.php');

?>
