<?php
	

	require_once('header.php');

	

	$get_data = callAPI('GET', 'http://127.0.0.1:8000/api/film/all', false);
	$film = json_decode($get_data,true);
	

	//add film
	if(isset($_POST['add'])){
		$data_array =  array(
					'title' 	=> $_POST['title'],
                    'type' 		=> $_POST['type'],
                    'synopsis' 	=> $_POST['synopsis'],
                    'episodes' 	=> $_POST['episodes'],
                    'cover' 	=> $_POST['cover'],
                    'trailer' 	=> $_POST['trailer'],
                    'genre' 	=> $_POST['genre'],
                    'year'		=> $_POST['year'],
                    'country' 	=> $_POST['country']
	 				);
  		

		
		$header = 'Authorization: Bearer '.$_SESSION['token'];
	  	$call_api = callAPI('POST', 'http://127.0.0.1:8000/api/film/add', json_encode($data_array),$header);
	  		
	  	$response = json_decode($call_api, true);

	
	  	return header('Location: index.php?action=added');
	
	 
	 }

	  //delete film
	 if(isset($_POST['edit'])){

	 	$id = $_POST['id'];


	 	$data_array =  array(
					'title' 	=> $_POST['title'],
                    'type' 		=> $_POST['type'],
                    'synopsis' 	=> $_POST['synopsis'],
                    'episodes' 	=> $_POST['episodes'],
                    'cover' 	=> $_POST['cover'],
                    'trailer' 	=> $_POST['trailer'],
                    'genre' 	=> $_POST['genre'],
                    'year'		=> $_POST['year'],
                    'country' 	=> $_POST['country']
	 				);

	 	$header = 'Authorization: Bearer '.$_SESSION['token'];

	  	$call_api = callAPI('PUT', 'http://127.0.0.1:8000/api/film/edit/'.$id, json_encode($data_array),$header);

	  	return header('Location: index.php?action=edited');
	
	 }

	 //delete film
	 if(isset($_POST['delete'])){

	 	$id = $_POST['id'];

	 	$header = 'Authorization: Bearer '.$_SESSION['token'];

	  	$call_api = callAPI('delete', 'http://127.0.0.1:8000/api/film/delete/' . $id, false,$header);

	  	$response = json_decode($call_api, true);

	  return header('Location: index.php?action=deleted');
	
	 }

?>

	<div class="container">
		<button type="button" class="btn btn-primary" style="margin-bottom: 10px;"data-toggle="modal" data-target="#addFilm">Add Film</button>
		<?php
			if(isset($_GET['action'])){

				if($_GET['action'] == 'deleted'){
					echo "<div class='error'>film sucess deleted</div>";
				}elseif($_GET['action'] == 'updated'){
					echo "<div class='success'>film sucess updated</div>";
				}elseif($_GET['action'] == 'added'){
					echo "<div class='success'>film sucess added</div>";
				}
			}

		?>
		<table class="table">
		  <thead>
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">Title</th>
		      <th scope="col">Type</th>
		      <th scope="col">Episodes</th>
		      <th scope="col">Year</th>
		      <th scope="col">Action</th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php $no=1; for ($i=0; $i<count($film['data']); $i++): ?>
		    <tr>
		      <th scope="row"><?= $no++?></th>
		      <td><?= $film['data'][$i]['title']?></td>
		      <td><?= $film['data'][$i]['type']?></td>
		      <td><?= $film['data'][$i]['year']?></td>
		      <td><?= $film['data'][$i]['episodes']?> Episodes</td>
		      <td>
		      	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editFilm<?= $film['data'][$i]['id']?>">Edit</button>
		      	<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteFilm<?= $film['data'][$i]['id']?>">Delete</button>
		      	
		      	
		      </td>
		    </tr>

			<?php endfor?>
		  
		  </tbody>
		</table>
	</div>

	<!-- Modal -->
<div class="modal fade" id="addFilm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Film</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form method="POST">
		  <div class="form-group">
		    <label for="title">Title</label>
		    <input type="text" class="form-control" name="title" placeholder="Enter title">   
		  </div>
		  <div class="form-group">
		    <label for="type">Type</label>
		    <select class="form-control" name="type">
		      <option value="movies">Movies</option>
		      <option value="tv series">Tv Series</option>
		    </select>
		  </div>
		  <div class="form-group">
		    <label for="episodes">episodes</label>
		    <input type="number" class="form-control" name="episodes" placeholder="Enter episodes">   
		  </div>
		  <div class="form-group">
		    <label for="synopsis">Synopsis</label>
		    <textarea class="form-control" name="synopsis" placeholder="synipsis" rows="3"></textarea>
		  </div>

		  <div class="form-group">
		    <label for="cover">Cover</label>
		    <input type="text" class="form-control" name="cover" placeholder="Enter cover">   
		  </div>
		  <div class="form-group">
		    <label for="trailer">Trailer</label>
		    <input type="text" class="form-control" name="trailer" placeholder="Enter trailer">   
		  </div>
		  <div class="form-group">
		    <label for="genre">Genre</label>
		    <input type="text" class="form-control" name="genre" placeholder="Enter genre">   
		  </div>
		  <div class="form-group">
		    <label for="year">Year</label>
		    <input type="text" class="form-control" name="year" placeholder="Enter year">   
		  </div>
		  <div class="form-group">
		    <label for="country">Country</label>
		    <input type="text" class="form-control" name="country" placeholder="Enter country">   
		  </div>
		 	<br />
		  <button type="submit" class="btn btn-primary" name="add">Submit</button>
		</form>
      </div>
     
    </div>
  </div>
</div>


<?php $no=1; for ($i=0; $i<count($film['data']); $i++): ?>
<div class="modal fade" id="editFilm<?= $film['data'][$i]['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Film </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form method="POST">
		  <div class="form-group">
		    <label for="title">Title</label>
		    <input type="text" value="<?= $film['data'][$i]['title']?>" class="form-control" name="title" placeholder="Enter title">   
		  </div>
		  <div class="form-group">
		    <label for="type">Type</label>
		    <select class="form-control" name="type">
		      <option value="movies">Movies</option>
		      <option value="tv series">Tv Series</option>
		    </select>
		  </div>
		  <div class="form-group">
		    <label for="episodes">episodes</label>
		    <input type="number" value="<?= $film['data'][$i]['episodes']?>" class="form-control" name="episodes" placeholder="Enter episodes">   
		  </div>
		  <div class="form-group">
		    <label for="synopsis">Synopsis</label>
		    <textarea class="form-control"name="synopsis" placeholder="synipsis" rows="3"><?= $film['data'][$i]['synopsis']?></textarea>
		  </div>

		  <div class="form-group">
		    <label for="cover">Cover</label>
		    <input type="text" class="form-control" value="<?= $film['data'][$i]['cover']?>" name="cover" placeholder="Enter cover">   
		  </div>
		  <div class="form-group">
		    <label for="trailer">Trailer</label>
		    <input type="text" class="form-control" value="<?= $film['data'][$i]['trailer']?>" name="trailer" placeholder="Enter trailer">   
		  </div>
		  <div class="form-group">
		    <label for="genre">Genre</label>
		    <input type="text" class="form-control" value="<?= $film['data'][$i]['genre']?>" name="genre" placeholder="Enter genre">   
		  </div>
		  <div class="form-group">
		    <label for="year">Year</label>
		    <input type="number" class="form-control" value="<?= $film['data'][$i]['year']?>" name="year" placeholder="Enter year">   
		  </div>
		  <div class="form-group">
		    <label for="country">Country</label>
		    <input type="text" class="form-control" value="<?= $film['data'][$i]['country']?>" name="country" placeholder="Enter country">   
		  </div>
		 	<br />

		 	<input type="hidden" name="id" value="<?= $film['data'][$i]['id']?>">
		  <button type="submit" class="btn btn-primary" name="edit" >Edit</button>
		</form>
      </div>
     
    </div>
  </div>
</div>
<?php endfor?>

<?php $no=1; for ($i=0; $i<count($film['data']); $i++): ?>
<div class="modal fade" id="deleteFilm<?= $film['data'][$i]['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Delete Film </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	Are you sure want to delete <strong><?= $film['data'][$i]['title']?></strong> film?
      </div>
      <div class="modal-footer">
      	<form method="post" style="display: inline">
		      <input type="hidden" name="_method" value="DELETE">
		      <input type="hidden" name="id" value="<?= $film['data'][$i]['id']?> ">
		    <button class="btn btn-danger" name="delete">delete</button>
		</form>
      </div>
     
    </div>
  </div>
</div>
<?php endfor?>
<?php require_once('footer.php');

