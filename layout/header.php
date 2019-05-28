
<?php
    
    require('helper/api.php');

    //get genre from api
    $genre_url = callAPI('GET', 'http://127.0.0.1:8000/api/film/genre', false);
    $genre = json_decode($genre_url,true);

    //get country from api
    $contry_url = callAPI('GET', 'http://127.0.0.1:8000/api/film/country', false);
    $country = json_decode($contry_url,true);

    //get type from api
    $type_url = callAPI('GET', 'http://127.0.0.1:8000/api/film/type', false);
    $type = json_decode($type_url,true);

?>

<html>
    <head>
        <title>
            Mofo
        </title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
            <link rel="stylesheet" href="assets/css/style5.css">
            <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    </head>

    <body>
        <div class="wrapper">
                    <!-- Sidebar Holder -->
            <nav id="sidebar">
                <div class="sidebar-header">
                    <a href="index.php"><h3 class="logo">Mofo ;)</h3></a>
                </div>
                        
            
                <ul class="list-unstyled components">
                    <li><a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" style="color:white;">Type</a>
                        <ul class="list-unstyled" id="pageSubmenu">
                        <?php for ($i=0; $i<count($type['data']); $i++): ?>
                            <li><a href="search.php?q=<?= $type['data'][$i]['type'];?>"><?= $type["data"][$i]["type"];?></a></li>
                        <?php endfor ?>      
                        </ul>
                    </li>

                    <li><a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" style="color:white;">Genre</a>
                        <ul class="list-unstyled" id="pageSubmenu2">
                        <?php for ($i=0; $i<count($genre['data']); $i++): ?>
                            <li><a href="search.php?q=<?= $genre['data'][$i]['genre'];?>"><?= $genre["data"][$i]["genre"];?></a></li>
                        <?php endfor ?>      
                        </ul>
                    </li>

                    <li><a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" style="color:white;">Country</a>
                        <ul class="list-unstyled" id="pageSubmenu3">
                        <?php for ($i=0; $i<count($country['data']); $i++): ?>
                            <li><a href="search.php?q=<?= $country['data'][$i]['country'];?>"><?= $country["data"][$i]["country"];?></a></li>
                        <?php endfor ?>      
                        </ul>
                    </li>
                    
                </ul>   
            </nav>
            
                    
            <!-- Page Content Holder -->
            <div id="content">
            
                <nav class="navbar navbar-expand-lg">
                    <div class="container-fluid">
            
                        <button type="button" id="sidebarCollapse" class="navbar-btn">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>

                        <form action="search.php" method="GET" class="my-2 my-lg-0" style="padding-left:250px">
                            <input name="q" class="form-control mr-sm-2" type="search" placeholder="Search your mufi"> 
                        </form>

                        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                    <i class="fas fa-align-justify"></i>
                        </button>
            
                    </div>
                </nav>
          

