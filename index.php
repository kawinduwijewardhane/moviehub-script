<?php include("./inc/config.php") ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/assets/css/mdb.dark.min.css">
  <link rel="stylesheet" href="/assets/css/style.css">
  <link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  rel="stylesheet"
/>
  <title>MovieHub</title>
</head>
<body>
<?php include("./inc/navbar.php") ?>

<div class="container mt-5">
  <div class="row">   
    <?php  
     if (!empty($title1)) {
          $countresults = sizeof($movies); 
          $countresults = $countresults-1; 
         for ($y = 0; $y <= $countresults; $y++) { ?>
        <div class="col-sm-4 col-md-3 col-lg-2 col-6 mb-3 movie-image cursor" data-mdb-toggle="modal" data-mdb-target="#model_<?php echo $id[$y]; ?>">
           <div class="cards position-relative">
            <span class="rating"> <i class="fas fa-star"></i> <?php echo $imdb_rating[$y]; ?></span>
              <img src="<?php echo $image_url[$y] ?>" alt="<?php echo $title_long[$y]; ?>" class="" />
              <div class="card-body">
                <p class="card-text card-texts limitation text-muted d-block"><?php echo $title_long[$y]; ?></p>
                <span class="text-muted card-texts d-block"><?php echo $year[$y]; ?></span>
              </div>
            </div>
        </div>
        <div
            class="modal fade"
            id="model_<?php echo $id[$y]; ?>"
            data-mdb-backdrop="static"
            data-mdb-keyboard="false"
            tabindex="-1"
            aria-labelledby="staticBackdropLabel"
            aria-hidden="true"
          >
            <div class="modal-dialog mw-100 w-60 modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel"><?php echo $title_long[$y]; ?></h5>
                  <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                  <?php if(!empty($yt_trailer_code1[$y])){  ?>
                    <a target="_blank" class="youtube-btn-bg youtube-btn" href="https://www.youtube.com/watch?v=<?php echo $yt_trailer_code1[$y]; ?>"> <i class="fab fa-youtube"></i> Youtube Trailer</a>  
                  <?php } ?>

                  <h3 class="mt-3 mb-2 text-muted">Select movie quality</h3>
                  <hr>

                  <div class="row justify-content-center">
                      <?php echo $complete_torrent_info1[$y] ?>
                  </div>       

                  <div class="row justify-content-center">
                      <?php echo $complete_torrent_info2[$y] ?>
                  </div>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
       <?php }} else { ?>
          <div class="jumbotron text-center">
            <h1 class="display-4">No matching result found!</h1>
          </div>
          <?php } ?>
  </div>

      <nav aria-label="...">
      <ul class="pagination justify-content-center">
        <li class="page-item <?php if($page1 == 1) {echo "disabled";} ?> ">
          <a class="page-link" href='<?php $page3 = $page1 - 1; $prev_page = $full_url1.'?page='.$page3."&quality=".$quality."&genre=".$genre."&rating=".$rating."&sort_by=".$sort_by."&query_term=".$query_term; echo $prev_page ?>' tabindex="-1">Previous</a>
        </li>
  
        <li class="page-item">
          <a class="page-link" href='<?php $page2 = $page1 + 1; $next_page = $full_url1.'?page='.$page2."&quality=".$quality."&genre=".$genre."&rating=".$rating."&sort_by=".$sort_by."&query_term=".$query_term;  echo $next_page ?>'>Next</a>
        </li>
      </ul>
    </nav>

</div>


<div class="my-5 mb-0">
  <footer class="bg-dark text-center text-white">
  <div class="text-center p-3">
    © <?php echo date("Y"); ?> Copyright:
    <a class="text-white" href="<?php echo $base_url; ?>">MovieHub</a>
  </div>
</footer>
</div>
<script src="/assets/js/mdb.min.js"></script>
</body>
</html>
