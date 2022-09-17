<nav class="navbar navbar-dark bg-dark p-0">
  <div class="container">
    <a href="<?php echo $base_url; ?>" class="navbar-brand">
      <img src="<?php echo $base_url; ?>/assets/img/logo.png" alt="">
    </a>
    <form method="get" role="form"  action="" class="d-flex input-group w-auto">
      <input
        type="search"
        name="query_term"
        class="form-control dark-border rounded"
        placeholder="IMDb ID or Movie Name.."
        aria-label="Search"
        aria-describedby="search-addon"
      />
      <button class="input-group-text border-0" id="search-addon">
        <i class="fas fa-search"></i>
      </button>
    </form>
  </div>
</nav>