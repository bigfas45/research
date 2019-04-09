<?php include 'files/head.php'?>
<?php include 'files/nav.php'?>

<?php
  $find_id = $this->uri->segment(3);  
  $queryHeader = $this->db->query("SELECT * FROM `store_categories` WHERE `id`='$find_id'");
  $rowHeader = $queryHeader->row();

?>

    <div class="courses-grid page-header">
        <div class="page-header-overlay">
            <div class="container w-container">
                <h1 class="page-header-title" data-ix="fade-in-on-load">All</h1>
                <h2 class="page-subtitle" data-ix="fade-in-on-load-2"><?=$rowHeader->cat_tittle?></h2></div>
        </div>
    </div>
    <div class="course-category-fixed-block">
        <div class="fixed-block-title">Categories</div>
        <div class="w-dyn-list">
            <div class="w-dyn-items">
                <div class="w-dyn-item"><a class="category-link-title" href="../category/development.html">Development</a></div>
                <div class="w-dyn-item"><a class="category-link-title" href="../category/general.html">General</a></div>
                <div class="w-dyn-item"><a class="category-link-title" href="../category/it-software.html">IT &amp; Software</a></div>
                <div class="w-dyn-item"><a class="category-link-title" href="../category/online-tutorials.html">Online Tutorials</a></div>
                <div class="w-dyn-item"><a class="category-link-title" href="../category/photography.html">Photography</a></div>
            </div>
        </div>
    </div>
    <?php
if (isset($view_file)) {
	$this->load->view($view_module.'/'.$view_file);
}
?>	
    <?php include 'files/footer.php'; ?>