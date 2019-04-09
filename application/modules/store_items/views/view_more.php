<div class="section">
        <div class="container w-container">
            <div class="w-dyn-list">
                <div class="w-clearfix w-dyn-items w-row">
                <?php foreach ($query->result() as $row) {
                        # code...
                       
                        $catId = $row->item_id;
                        $sql = $this->db->query("SELECT * FROM store_items WHERE id ='$catId'");
                        $rowBlogPost = $sql->row();
                        $article_preview = word_limiter($rowBlogPost->item_description, 20);
                    ?>   
<div class="blog-list-item w-col w-col-5 w-dyn-item">
    <div class="blog-post-block">
        <a class="blog-post-image-block w-inline-block" style="background-image: url('<?=base_url()?>daks2k3a4ib2z.cloudfront.net/5724c55c9134bc281e3f6a7c/573ceb9bf97dd46d4f9e0392_Photo-9.jpg');" href="blog/we-are-looking-for-a-teacher-in-the-it-development.html">
        <div class="image-overlay-block"> </div>
    </a>
        <div class="blog-post-content-block">
            <div class="blog-overview blog-post-info-block"
            ><div class="course-info-icon">
                </div>
                <div class="blog-info-title">May 1, 2016</div>
                <div class="course-info-icon">
                    </div>
                    <div class="blog-info-title">Eveline Fischer</div>
                </div><a class="blog-page blog-post-title-link" href="blog/we-are-looking-for-a-teacher-in-the-it-development.html"><?=$rowBlogPost->item_title?></a>
                <p class="blog-post-summary"><?=$article_preview?></p>
<a class="blog-read-more button w-button" href="<?=base_url()?>store_items/read_post/<?=$rowBlogPost->item_url?>"0>Read More</a>
</div>
</div>
</div>
               
</div>
<?php } ?>
</div>
</div>
</div>
</div>
</div>
                  


