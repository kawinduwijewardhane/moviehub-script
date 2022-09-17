<?php

  error_reporting(0);
  $root = realpath(__DIR__ . '/../');

  if (file_exists($root . '/includes/atchecker.txt')) {
      header('Location: ../');
      exit;
  }

$errors = array();
  $pages = array('agreement', 'install', 'success');
  $page = 'agreement';
  if (isset($_POST['page'])) {
      $runPage = filter_input(INPUT_POST, 'page', FILTER_SANITIZE_STRING);
      if (in_array($runPage, $pages)) {
          $page = $runPage;
      }
  }

  $version = @file_get_contents(realpath(__DIR__ . '/../version'));

  function atInput($val) {
      if (isset($_POST[$val]))
          return $_POST[$val];
      return;
  }


  function dataFn($url, $data = array()) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_TIMEOUT, 3000);
    $data = curl_exec($curl);
    curl_close($curl);
    return json_decode($data, true);
}


if (isset($_POST['installer'])) {
    $page = 'install';
    $domain = atInput('domain');
    $license_key = atInput('license_key');
    $dbhost = atInput('dbhost');
    $dbport = atInput('dbport');
    $dbuser = atInput('dbuser');
    $dbpass = atInput('dbpass');
    $dbname = atInput('dbname');
    $email = atInput('email');
    $password = atInput('password');

    if (empty($domain)) {
        array_push($errors, 'Web URL cannot be empty');
    }
    if (empty($license_key)) {
        array_push($errors, 'Licence Key can not be empty');
    }
    if (empty($dbhost)) {
        array_push($errors, 'Database host cannot be empty');
    }
    if (empty($dbport)) {
        array_push($errors, 'Database port cannot be empty');
    }
    if (empty($dbuser)) {
        array_push($errors, 'Database user cannot be empty');
    }
    if (empty($dbname)) {
        array_push($errors, 'Database name cannot be empty');
    }    
    if (empty($email)) {
        array_push($errors, 'Admin email cannot be empty');
    }    
    if (empty($password)) {
        array_push($errors, 'Admin password cannot be empty');
    }
    if (!version_compare(PHP_VERSION, '7.3', '>=')) {
        array_push($errors, 'Required PHP version 7.3 or more');
    }
    if (!function_exists('curl_init')) {
        array_push($errors, 'Required cURL PHP extension');
    }
    if (!ini_get('allow_url_fopen')) {
        array_push($errors, 'Enable allow_url_fopen in your php.ini');
    }
    if (count($errors) == 0) {
        $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname, $dbport);
        if ($mysqli->connect_error) {
            array_push($errors, 'Connnection Failed: ' . $mysqli->connect_error);
        }
        if (count($errors) == 0) {
            $data = dataFn(base64_decode('aHR0cHM6Ly9waXhlbHNvZnQuZGlnaXRhbC9saWNlbnNlL3ZlcmlmaWNhdGlvbi5waHA='), ['domain' => $domain, 'license' => $license_key]);
              
            if (!$data) {
                array_push($errors, 'something went wrong! Please try again.');
            } else {
                if ($data['status'] == 99) {
                } elseif ($data['status'] == 0) {
                  array_push($errors, $data['message']);
                } else {
                  array_push($errors, 'Server error. Please contact support.');
                }
            }
             if (count($errors) == 0) {
                $dbConnection = '<?php
$dbhost = "' . $dbhost . '"; 
$dbport = "' . $dbport . '"; 
$dbuser = "' . $dbuser . '"; 
$dbpass = "' . $dbpass . '"; 
$dbname = "' . $dbname . '"; 
$dbprefix = ""; 
$dbcharset = "utf8";
  $mysqli   = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
  if (mysqli_connect_errno($mysqli)) {
     
     echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>';

                 $dotHtaccess = '
# Author    : Kawindu Nirmal
# FaceBook  : https://www.facebook.com/kawindu12
# Company   : PixelSoftDigital
# Contact   : hello@pixelsoft.digital
# Website   : https://www.pixelsoft.digital
# Version: 1.0.0


Options All -Indexes

addtype audio/x-mpegurl m3u
addtype audio/mpegurl m3u
addType audio/3gpp 3gp
addType video/3gpp 3gp
addType audio/x-wav wav
addType audio/amr amr
addType audio/amr-wb awb
addType audio/force-download mp3
addType audio/x-midi mid
addType audio/midi mid
addType audio/midi midi
addType image/jpeg jpg
addType image/jpeg jpeg
addType image/png png
addType image/gif gif
addType image/gif GIF
addType image/jpeg JPG
addType image/jpeg JPEG
addType image/png PNG

<IfModule mod_security.c>
    SecFilterEngine Off
    SecFilterScanPOST Off
</IfModule>

<IfModule mod_rewrite.c>
    RewriteEngine On

    RewriteRule ^search?([a-z-0-9]+)$ /views/search.php?keyword=$1 [L,QSA,NC]
    RewriteRule ^download/([a-z0-9-]+)$ /views/download.php?name=$1 [L]
    RewriteRule ^ajax/api$ /views/ajax_download.php?$1 [L]
    RewriteRule ^generate/([a-z-0-9]+)/([0-9]+)$ /set-file.php?server=$1&id=$2 [L]
    RewriteRule ^downloading/complete$ /views/complete.php?$1 [L]
    RewriteRule ^songs$ /views/songs.php?$1 [L]
    RewriteRule ^songs/page=([0-9]+)$ /views/songs.php?page=$1&sort=$2 [L]
    RewriteRule ^artist$ /views/artists.php?$1 [L]
    RewriteRule ^artists/page=([0-9]+)$ /views/artists.php?page=$1&sort=$2 [L]
    RewriteRule ^artist/([a-z-0-9]+)$ /views/artist-profile.php?name=$1 [L]
    RewriteRule ^categories$ /views/categories.php?$1 [L]
    RewriteRule ^categories/page=([0-9]+)$ /views/categories.php?page=$1&sort=$2 [L]
    RewriteRule ^category/([a-z-0-9]+)$ /views/category.php?name=$1 [L]
    RewriteRule ^categories/page=([0-9]+)$ /views/categories.php?page=$1&sort=$2 [L]
    RewriteRule ^user/register$ /views/register.php?$1 [L]
    RewriteRule ^user/login$ /views/login.php?$1 [L]
    RewriteRule ^user/profile$ /views/profile.php?$1 [L]
    RewriteRule ^user/upload$ /views/uploadSong.php?$1 [L]
    RewriteRule ^user/settings$ /views/settings.php?$1 [L]
    RewriteRule ^user/logout$ /views/logout.php?$1 [L]
    RewriteRule ^legal/terms$ /views/terms.php?$1 [L]
    RewriteRule ^legal/privacy$ /views/privacy.php?$1 [L]
    RewriteRule ^legal/about$ /views/about.php?$1 [L]
    RewriteRule ^legal/contact$ /views/contact.php?$1 [L]
    RewriteRule ^welcome$ /views/welcome/index.php?$1 [L]
    RewriteRule ^sitemap\.xml$ /sitemap.php [L]



</IfModule>

<IfModule mod_deflate.c>
    AddOutputFilterByType DEFLATE application/javascript text/css text/html text/xml
</IfModule>

<IfModule mod_deflate.c>
    <FilesMatch "\.(js|css|ico)$">
        SetOutputFilter DEFLATE
    </FilesMatch>
</IfModule>

#<filesMatch "\\.(ico|jpg|jpeg|pn­g|gif)$">
    # Header set Cache-Control "max-age=604800, public"
    #</filesMatch>
#
#<filesMatch "\\.(css|css?|js)$">
    # Header set Cache-Control "max-age=604800, public"
    #</filesMatch>

# BEGIN cPanel-generated php ini directives, do not edit
# Manual editing of this file may result in unexpected behavior.
# To make changes to this file, use the cPanel MultiPHP INI Editor (Home >> Software >> MultiPHP INI Editor)
# For more information, read our documentation (https://go.cpanel.net/EA4ModifyINI)
<IfModule php7_module>
    php_flag display_errors Off
    php_value max_execution_time 30
    php_value max_input_time 60
    php_value max_input_vars 1000
    php_value memory_limit 128M
    php_value post_max_size 2048M
    php_value session.gc_maxlifetime 1440
    php_value session.save_path "/var/cpanel/php/sessions/ea-php56"
    php_value upload_max_filesize 128M
    php_flag zlib.output_compression On
</IfModule>
<IfModule lsapi_module>
    php_flag display_errors Off
    php_value max_execution_time 30
    php_value max_input_time 60
    php_value max_input_vars 1000
    php_value memory_limit 128M
    php_value post_max_size 2048M
    php_value session.gc_maxlifetime 1440
    php_value session.save_path "/var/cpanel/php/sessions/ea-php56"
    php_value upload_max_filesize 128M
    php_flag zlib.output_compression On
</IfModule>
# END cPanel-generated php ini directives, do not edit

# php -- BEGIN cPanel-generated handler, do not edit
# Set the “ea-php74” package as the default “PHP” programming language.
<IfModule mime_module>
  AddHandler application/x-httpd-ea-php74___lsphp .php .php7 .phtml
</IfModule>
# php -- END cPanel-generated handler, do not edit


';


                      $query = '';
                      $sqlScript = file('database.sql');
                      foreach ($sqlScript as $line) {
                        
                        $startWith = substr(trim($line), 0 ,2);
                        $endWith = substr(trim($line), -1 ,1);
                        
                        if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
                          continue;
                        }
                        $query = $query . $line;
                        if ($endWith == ';') {
                          mysqli_query($mysqli,$query) or die($query);
                          $query= '';
                        }
                        if (!@$mysqli->query("UPDATE `at_web_settings` SET `at_site_url` = '".$Domain."' WHERE `at_web_settings`.`id` = 1")) {
                            $Domain = $domain;
                        }  
                         if (!@$mysqli->query("UPDATE `at_admin_user` SET `email` = '$Email' WHERE `at_admin_user`.`id` = 1")) {
                              $Email = $email;
                          }

                          if (!@$mysqli->query("UPDATE `at_admin_user` SET `password` = '$sha1Password' WHERE `at_admin_user`.`id` = 1")) {
                              $sha1Password = sha1($password);
                          }                   
                      }

                      $htaccessFile =  __DIR__ .'/../.htaccess';

                      $file = fopen($htaccessFile, "w");
                      fwrite($file, $dotHtaccess);
                      fclose($file);


                      $file = fopen(__DIR__ . '/../includes/connection.php', "w");
                      fwrite($file, $dbConnection);
                      fclose($file);

                      $file = fopen(__DIR__ . '/../includes/atchecker.txt', "w");
                      fwrite($file, 'Installed on - ' . date("F j, Y, g:i a"));
                      fclose($file);

                      $adminLink = $domain . '/admin';
                      $page = 'success';
                  }
           }
     }
}
?>

<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>LICENSE AGREEMENT</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" ></script>

<script>
  toastr.options = {
  "closeButton": true,
  "newestOnTop": false,
  "progressBar": true,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
</script>

<style>
	@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;1,300;1,400&display=swap');

	:root{
      --main-bg: #1e9ee9;
	}

	body {
		font-family: 'Poppins', sans-serif;
	}

	h1,h2,h3,h4,h5,h6,p {
		color: #4a4a4a;
	}

	strong {
		font-style: italic;
		font-weight: 300;
	}

	.main-bg {
	  background: var(--main-bg) !important;
	}

	input:focus, button:focus {
	  border: 1px solid var(--main-bg) !important;
	  box-shadow: none !important;
	}

	.form-check-input:checked {
	  background-color: var(--main-bg) !important;
	  border-color: var(--main-bg) !important;
	}

	.card, .btn, input{
	  border-radius:0 !important;
	}

</style>
</head>
<body class="main-bg">

	 <?php if ($page == 'agreement') : ?>

	 <div class="container">
    <div class="row justify-content-center mt-3 mb-3">
      <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="card shadow">
          <div class="card-title text-center border-bottom">
            <h2 class="p-3">LICENSE AGREEMENT</h2>
            <h5>AudioTape PHP music downloading script</h5>
            <p><strong>Version: v<?php echo $version; ?></strong></p>
          </div>
          <div class="card-body">

          	<div class="alert alert-info text-center">You can use on one domain name only, additional license purchase required for each additional domain name.</div>

          	<ul>
          		<li>You are free to modify this script as you wish.</li>
          		<li>You are also allowed to remove any part you don't need.</li>
          	</ul>

          	<hr>

          		<div class="alert alert-danger text-center">You cannot distribute, resell, give away or trade by any means to any third party or individual without permission.</div>
            
            <ul>
          		<li>If you want to install on multiple sites, it is mandatory to purchase an Extended License.</li>
          	</ul>

          	 <form action="index.php" method="post">
          	 	 <input type="hidden" name="page" value="install">
          		 <div class="form-group form-check">
				    <input type="checkbox" name="agreeCheck" class="form-check-input" id="agree" required="">
				    <label class="form-check-label" for="agree">I agree with the above.</label>
				  </div>
				  <div class="d-grid gap-2 d-md-flex justify-content-md-end">
		        	  <button type="submit" name="agree" class="btn btn-primary">Accept</button>
		          </div>

          	</form>
          </div>
        </div>
      </div>
    </div>
  </div>

   <?php elseif ($page == 'install') : ?>

   <div class="container">
    <div class="row justify-content-center mt-5">
      <div class="col-lg-8 col-md-12 col-sm-12">
        <div class="card shadow">
          <div class="card-title text-center border-bottom">
            <h2 class="p-3">INSTALLER</h2>
          </div>
          <div class="card-body">
          <?php if (count($errors) > 0) {
              foreach ($errors as $error) { ?>
                  <script type="text/javascript">
                  toastr.error('<?php echo $error; ?>')
                  </script>
             <?php }
          }; ?>
            <form action="index.php" method="post">


              <div class="row">
                <div class="col-md-6">
                    <div class="mb-4">
                      <label for="domain" class="form-label">Your Domain</label>
                      <input type="text" name="domain" value="<?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . '://'.$_SERVER['HTTP_HOST'];?>" class="form-control" id="domain" />
                    </div>
                  </div>
                   <div class="col-md-6">
                     <div class="mb-4">
                      <label for="license_key" class="form-label">Licence Key:  <small>(<a href="https://pixelsoft.digital/license/" target="_blank">Click Here to Generate</a>)</small></label>
                      <input type="text" name="license_key" class="form-control" id="license_key" value="<?php echo isset($license_key) ? $license_key : ''; ?>" placeholder="xxxxx-xxxxx-xxxxx-xxxxx-xxxxx-xxxxx" />
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-4">
                      <label for="dbHost" class="form-label">Database Host</label>
                      <input type="text" value="<?php echo isset($dbhost) ? $dbhost : 'localhost'; ?>" name="dbhost" class="form-control" id="dbHost" />
                    </div>                 
                  </div>
                  <div class="col-md-6">
                    <div class="mb-4">
                      <label for="dbPort" class="form-label">Database Port</label>
                      <input type="text" value="3306" name="dbport" class="form-control" id="dbPort" />
                    </div>     
                  </div>

                  <div class="col-md-4">
                    <div class="mb-4">
                      <label for="dbName" class="form-label">Database Name</label>
                      <input type="text" name="dbname" class="form-control" id="dbName" value="<?php echo isset($dbname) ? $dbname : ''; ?>"/>
                    </div>
                  </div>

                  <div class="col-md-4">
                      <div class="mb-4">
                      <label for="dbUser" class="form-label">Database User</label>
                      <input type="text" name="dbuser" class="form-control" id="dbUser" value="<?php echo isset($dbuser) ? $dbuser : ''; ?>"/>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="mb-4">
                      <label for="dbPass" class="form-label">Database Password</label>
                      <input type="text" name="dbpass" class="form-control" id="dbPass" value="<?php echo isset($dbpass) ? $dbpass : ''; ?>" />
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-4">
                      <label for="email" class="form-label">Admin Email</label>
                      <input type="text" name="email" class="form-control" id="email" />
                    </div>                 
                  </div>
                  <div class="col-md-6">
                    <div class="mb-4">
                      <label for="password" class="form-label">Admin Password</label>
                      <input type="text" name="password" class="form-control" id="password" />
                    </div>     
                  </div>

               </div>
              <div class="d-grid">
                <button type="submit" name="installer" class="btn text-light main-bg">Install</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

    <?php else : ?>
	<div class="container">
    <div class="row justify-content-center mt-3 mb-3">
      <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="card shadow">
          <div class="card-title text-center border-bottom">
            <h2 class="p-3">Congratulations</h2>
            <h5>AudioTape PHP music downloading script</h5>
            <p><strong>Version: v<?php echo $version; ?></strong></p>
          </div>
          <div class="card-body">
             <div class="text-center mb-3">
                 <i class="fa fa-check-circle text-success" style="font-size: 80px"></i>
             </div>
          	<div class="alert alert-info text-center"><b>AudioTape PHP music downloading script</b> has been successfully installed on your server.</div>

             <div class="row">
                <div class="form-group">
                    <label>Admin Email:</label>
                    <input type="text" class="form-control" value="<?php echo @$email; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Admin Password:</label>
                    <input type="text" class="form-control" value="<?php echo @$password; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Admin URL:</label>
                    <input type="text" class="form-control" value="<?php echo @$adminLink; ?>" readonly>
                </div>
                <div class="text-center mb-4 mt-3">
                    <a class="btn btn-sm btn-info text-white" href="<?php echo @$adminLink; ?>" target="_blank">Login Admin Panel</a>
                </div>
                <div class="alert alert-warning text-center">
                  First, log in to the admin panel and update the settings
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

    <?php endif; ?>


</body>

</html>