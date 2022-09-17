<?php 
	$base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . '://'.$_SERVER['HTTP_HOST'] . "/moviehub";
	$full_url = $_SERVER['REQUEST_URI']; $qurey_url = '?'.$_SERVER['QUERY_STRING']; $full_url1 = str_replace($qurey_url,'', $full_url);

	 if (isset($_GET['page'])) { 
	 	$pagea = $_GET["page"]; 
	 	$page1 = $pagea; 
	 } else { 
	 	$page1 = 1; 
	 }     
    
    if (isset($_GET['quality'])) { 
    	$quality = $_GET["quality"];	     	
    } else { 
    	$quality = ""; 	 
    }     
    
    if (isset($_GET['genre'])) { 
    	$genre = $_GET["genre"];			
    } else {	
    	$genre = "";     
    }
   
    if (isset($_GET['rating'])) { 
    	$rating = $_GET["rating"];	 	
    } else {	
    	$rating = "";   
    }
    
    if (isset($_GET['sort_by'])) {	
    	$sort_by = $_GET["sort_by"];  		
    } else {	
    	$sort_by = "";   
    }

	if (isset($_GET['query_term'])) {  
		$query_term = $_GET["query_term"]; 
		$query_term = mb_strtolower($query_term);
	    $query_term = urlencode($query_term); 
	}   else { 
		$query_term = "";	
	}
        
    $yts = new YTS();
	$movies = $yts->listMovies($quality, 42, $page1, $query_term, $rating, $genre, $sort_by); 
        
        class YTS {
             const BASE_URL = 'https://yts.ag';
	         public function listMovies(
                $quality = 'All', 
                $limit = 42,                                
                $page = 0,
			    $query_term = 0,
                $minimum_rating = 0,
	            $genre = '',
                $sort_by = 'date-added',
	            $order_by = 'desc',
                $with_rt_ratings = false
	        )
		    {
		    $baseUrl = self::BASE_URL . '/api/v2/list_movies.json';
		    $parameters = '?limit=' . $limit . '&page=' . $page . '&quality=' . $quality . '&minimum_rating=' . $minimum_rating . '&query_term=' . $query_term . '&genre=' . $genre . '&sort_by=' . $sort_by . '&order_by=' . $order_by . '&with_rt_ratings=' . $with_rt_ratings;
		    $data = $this->getFromApi($baseUrl . $parameters);
		        if ($data->movie_count == 0) {
			              return false;
			    }
                return isset($data->movies) ? $data->movies : [];
		        }

	     public function movieDetail($movie_id, $with_images = false, $with_cast = false) {
		        $baseUrl = self::BASE_URL . '/api/v2/movie_details.json';
		        $parameters = '?movie_id=' . $movie_id . '&with_images' . $with_images . '&with_cast=' . $with_cast;
                $movieObj = $this->getFromApi($baseUrl . $parameters);
		          if (property_exists($movieObj, 'movie')) return $movieObj->movie;
		              return false;
		}

		// future
        public function movieSuggestions($movie_id) {
		        $baseUrl = self::BASE_URL . '/api/v2/movie_suggestions.json?movie_id=' . $movie_id;
		        $data = $this->getFromApi($baseUrl);
		           if ($data->movie_suggestions_count == 0){ return false; }
                         return isset($data->movie_suggestions) ? $data->movie_suggestions : [];
		}

		// future
	    public function movieComments($movie_id) {
		        $baseUrl = self::BASE_URL . '/api/v2/movie_comments.json?movie_id=' . $movie_id;
        	    $data = $this->getFromApi($baseUrl);
        	        if ($data->comment_count == 0)	{ return false; }
        	        	return isset($data->comments) ? $data->comments : [];
        }

		// future
        public function movieReviews($movie_id) {
        	    $baseUrl = self::BASE_URL . '/api/v2/movie_reviews.json?movie_id=' . $movie_id;
		        $data = $this->getFromApi($baseUrl);
		        	if ($data->review_count == 0)	{ return false;	}
        	        	return isset($data->reviews) ? $data->reviews : [];
		}

		// future
        public function movieParentalGuides($movie_id) {
        	    $baseUrl = self::BASE_URL . '/api/v2/movie_parental_guides.json?movie_id=' . $movie_id;
        	    $data = $this->getFromApi($baseUrl);
        	        if ($data->parental_guide_count == 0)	{ 	return false; 		}
		        	    return isset($data->parental_guides) ? $data->parental_guides : [];
		}

		// future
	    public function listUpcoming() {
        	    $baseUrl = self::BASE_URL . '/api/v2/list_upcoming.json';
        	    $data = $this->getFromApi($baseUrl);
        	        if ($data->upcoming_movies_count == 0)	{ 	return false; 	}
        	        	return isset($data->upcoming_movies) ? $data->upcoming_movies : [];
        }

	    private function getFromApi($url) {
				if (!$data = file_get_contents($url)){
					$error = error_get_last();
					throw new Exception("HTTP request failed. Error was: " . $error['message']);
				 } else {
					$data = json_decode($data);
					if ($data->status != 'ok') {  throw new Exception("API request failed. Error was: " . $data->status_message); 	}
		  			 return $data->data;
				}
	    }
	 }

	if ($movies) {
	foreach($movies as $movie) {
		
		$title1[] = $movie->title;
		$title_long[] = $movie->title_long;            
        $rating1[] = $movie->rating;
        $check_geners_existance = @count($movie->genres);   

        if ( $check_geners_existance !== 0 ) { 
        	$genres1[] = implode(",",$movie->genres); 
        } else { 
        	$genres1[] = "Empty"; 
        }

                $id[] = $movie->id;
                $slug[] = $movie->slug;
                $image_url[] = $movie->medium_cover_image;
                $orignal_link_url[] = $movie->url;
                $synopsis1[] = $movie->synopsis;
                $imdb_code[] = $movie->imdb_code;
                $imdb_rating[] = $movie->rating;
                $year[] = $movie->year;
                $language1[] = $movie->language;
                $yt_trailer_code1[] = $movie->yt_trailer_code;
                $small_des[] = $movie->description_full;
                $torrents_counts = count($movie->torrents);

	        	$torrent[] = $movie->torrents[0];
                $torrenta = $movie->torrents[0];
                $torrents_counts11 = $torrents_counts - 1;
                for ($x = 0; $x <= $torrents_counts11; $x++) {
	        	    $torrent1111[$x] = 'magnet:?xt=urn:btih:'.$movie->torrents[$x]->hash;
	        	    $torrentUrl[$x] = $movie->torrents[$x]->url;
	        	    $quality1111[$x] = $movie->torrents[$x]->quality;
	        	    $type1111[$x] = $movie->torrents[$x]->type;
	        	    $size1111[$x]    = $movie->torrents[$x]->size;
	        	   
	        	    $complete_torrent_info_test[$x] =' <div class="col-md-4 mt-3"><a class="download-button btn btn-sm btn-danger" href="'.$torrent1111[$x].'"> <i class="fa fa-magnet"></i> 
	        	    	'.$quality1111[$x].' - '.$type1111[$x].' - '.$size1111[$x].'</a></div>';	        	    

	        	    $complete_torrent_url[$x] =' <div class="col-md-4 mt-3"><a class="download-button btn btn-sm btn-success" href="'.$torrentUrl[$x].'"> <i class="fa fa-download"></i> 
	        	    	'.$quality1111[$x].' - '.$type1111[$x].' - '.$size1111[$x].'</a></div>';
	        	}

	        	$complete_torrent_info1[] = implode(" ",$complete_torrent_info_test);
	        	$complete_torrent_info2[] = implode(" ",$complete_torrent_url);
 	        	$magnet_link1[] = 'magnet:?xt=urn:btih:' . $torrenta->hash;
                $size1[] = $torrenta->size;
         }
     }
 ?>