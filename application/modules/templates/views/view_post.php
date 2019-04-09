<?php include 'files/head.php'?>
<?php include 'files/nav.php';
$findUrl = $this->uri->segment(3);
			 $query = $this->db->query("SELECT * FROM store_items WHERE item_url ='$findUrl' AND `status` = '1'");
             $row = $query->row();
             $rowId = $row->id;
             $sql = $this->db->query("SELECT * FROM store_cat_assign WHERE item_id ='$rowId'");
             $resultCat = $sql->row();
             $categoryId = $resultCat->cat_id;
             $sqlCat = $this->db->query("SELECT * FROM store_categories WHERE id = '$categoryId' ");
             $resultCategory = $sqlCat->row();
             ?>

    <div class="course page-header" style="background-image: url('<?=base_url()?>/daks2k3a4ib2z.cloudfront.net/5724c55c9134bc281e3f6a7c/573ceb0e663360c6485bfa87_Photo-6.jpg');">
        <div class="course page-header-overlay">
            <div class="container course-header w-container">
                <h1 class="course-title page-header-title" data-ix="fade-in-on-load"><?=$row->item_title?></h1>
                <div class="course-category-title" data-ix="fade-in-on-load-2">Category:</div><a class="course-category-link" data-ix="fade-in-on-load-2" href="<?=base_url()?>store_items/view_more_post/<?=$categoryId?>"><?=$resultCategory->cat_tittle?></a></div>
        </div>
    </div>
    <div class="event section tint">
        <div class="container w-container">
            <div class="course-block-left">
                <div class="course-image-block w-clearfix" style="background-image: url('<?=base_url()?>/daks2k3a4ib2z.cloudfront.net/5724c55c9134bc281e3f6a7c/573ceb0e663360c6485bfa87_Photo-6.jpg');">
                    <div class="featured-label">Featured</div>
                </div>
                <div class="course-info-block">
                    <h4 class="section-title sidebar">Main Information</h4>
                    <div class="course-main-info-wrapper">
                        <div class="main-course-info-title">Group Size</div>
                        <div class="info main-course-info-title">25</div>
                    </div>
                    <div class="course-main-info-wrapper">
                        <div class="main-course-info-title">Duration</div>
                        <div class="info main-course-info-title">2 hours</div>
                    </div>
                    <div class="course-main-info-wrapper">
                        <div class="main-course-info-title">Certificate?</div>
                        <div class="info main-course-info-title">Yes</div>
                    </div>
                    <div class="course-main-info-wrapper">
                        <div class="main-course-info-title">Skill Level</div>
                        <div dyn-transform-option-innerhtml="option" class="info main-course-info-title">Advanced</div>
                    </div>
                </div>
                <div class="course-info-block">
                    <h4 class="section-title sidebar">Downloads</h4>
                    <div class="course-main-info-wrapper">
                        <div class="main-course-info-title">Course Brochure</div><a href="#">Download here</a></div>
                    <div class="course-main-info-wrapper">
                        <div class="main-course-info-title">Apply Form</div><a href="#">Download here</a></div>
                </div>
                <div class="course-info-block with-button"><a class="button take-course w-button" href="../contact-us.html">Take this course</a></div>
            </div>
            



            <?php
if (isset($view_file)) {
	$this->load->view($view_module.'/'.$view_file);
}
?>
<?php
$sqlPostAll = $this->db->query("SELECT * FROM store_items ORDER BY RAND() LIMIT 4")

?>


    </div>
    <div class="section">
        <div class="container w-container">
            <div class="section-title-wrapper">
                <h2 class="section-title">Did you see these?</h2>
                <h2 class="section-title subtitle">You might be interested in these courses as well:</h2>
                <div class="section-title-divider"></div>
            </div>
            <div class="featured-courses-list-wrapper w-dyn-list">
                <div class="featured-courses-list w-clearfix w-dyn-items w-row">
                    <?php foreach($sqlPostAll->result() as $rowRand) { 
                        $small_pic_path = base_url()."small_pic/".$rowRand->small_pic;
                        ?>
                    <div class="featured-course-item w-col w-col-3 w-dyn-item">
                        <div class="auto-height course-block-wrapper">
                            <a class="course-image-link-block large w-inline-block" href="how-to-successfully-become-a-freelancer.html" style="background-image: url('<?php echo $small_pic_path; ?>');">
                                <div class="image-overlay-block w-clearfix">
                                    <div class="featured-label w-condition-invisible">Featured</div>
                                </div>
                                <div class="teacher-overlay-block w-clearfix"><img class="teacher-overlay-photo" src="<?=base_url()?>small_pic/<?=$rowRand->small_pic?>">
                                    <div class="teacher-overlay-title"><?=$rowRand->author?></div>
                                </div>
                            </a>
                            <div class="course-content-block"><a class="course-title-link" href="how-to-successfully-become-a-freelancer.html"><?=$rowRand->item_title?></a></div>
                            <div class="_2 course-content-block">
                                <div class="course-info-icon"></div>
                                <div class="course-info-title">25</div>
                                <div class="course-info-icon"></div>
                                <div class="course-info-title">2 hours</div>
                            </div>
                        </div>
                   
                    </div>
                    <?php } ?>
                   
                   
                   
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="container w-container">
            <div class="footer-row w-row">
                <div class="footer-column w-col w-col-3">
                    <div class="footer-title">Contact us</div>
                    <a class="footer-contact-block w-inline-block" href="#">
                        <div class="footer-contact-title icon"></div>
                        <div class="footer-contact-title">+1 303 4020 43</div>
                    </a>
                    <a class="footer-contact-block w-inline-block" href="#">
                        <div class="footer-contact-title icon"></div>
                        <div class="footer-contact-title">+1 303 4020 42</div>
                    </a>
                    <a class="footer-contact-block w-inline-block" href="#">
                        <div class="footer-contact-title icon"></div>
                        <div class="footer-contact-title">info@university.com</div>
                    </a>
                    <a class="footer-social-button w-inline-block" href="http://www.facebook.com/" target="_blank"><img class="footer-social-icon" src="<?=base_url()?>/uploads.webflow.com/571cab5c86c1049c4c0e7047/5725bf52138ce8c852415122_Icon-facebook_2.png"></a>
                    <a class="footer-social-button w-inline-block" href="http://www.twitter.com/" target="_blank"><img class="footer-social-icon" src="<?=base_url()?>/uploads.webflow.com/571cab5c86c1049c4c0e7047/5725bf7e639cfa231e7840b7_Icon-twitter_1.png"></a>
                    <a class="footer-social-button w-inline-block" href="http://www.linkedin.com/" target="_blank"><img class="footer-social-icon" src="<?=base_url()?>/uploads.webflow.com/571cab5c86c1049c4c0e7047/5725bf9f138ce8c852415257_Icon-linkedin.png"></a>
                </div>
                <div class="footer-column last w-col w-col-3">
                    <div class="footer-title">About us</div><a class="footer-list-link" href="../about-us.html">About us</a><a class="footer-list-link" href="../404.html">Our Teachers</a><a class="footer-list-link" href="../faqs.html">FAQs</a><a class="footer-list-link" href="../contact-us.html">Contact us</a><a class="footer-list-link" href="../404.html">Helpdesk</a></div>
                <div class="footer-column w-col w-col-3">
                    <div class="footer-title">USEFUL LINKS</div><a class="footer-list-link" href="../faqs.html">FAQs</a><a class="footer-list-link" href="../contact-us.html">Contact us</a><a class="footer-list-link" href="../404.html">Helpdesk</a><a class="footer-list-link" href="../404.html">Our Teachers</a><a class="footer-list-link" href="../about-us.html">About us</a></div>
                <div class="footer-column w-col w-col-3">
                    <div class="footer-title">FEATURED COURSES</div>
                    <div class="w-dyn-list">
                        <div class="w-dyn-items">
                            <div class="w-dyn-item"><a class="footer-list-link" href="beginner-study-english-language.html">Beginner study English language</a></div>
                            <div class="w-dyn-item"><a class="footer-list-link" href="computer-science.html">Computer science beginner class</a></div>
                            <div class="w-dyn-item"><a class="footer-list-link" href="architecture-building-and-planning.html">Architecture, building and planning</a></div>
                            <div class="w-dyn-item"><a class="footer-list-link" href="politics-philosophy-and-theology.html">Politics, philosophy and theology</a></div>
                            <div class="w-dyn-item"><a class="footer-list-link" href="medicine-and-dentistry.html">Medicine and dentistry professional</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom-footer-block">
                <div class="bottom-footer-text">Copyright © University&nbsp;- Images used for demonstration purpose only (<a class="footer-link" href="../404.html">Licenses</a>)</div>
                <div class="bottom-footer-text right">Template design by&nbsp;<a class="footer-link" target="_blank" href="http://studiocorvus.com/">Studio Corvus</a>&nbsp;-&nbsp;<a class="footer-link" target="_blank" href="https://webflow.com/templates/designers/rowan-hartsuiker">View all templates</a></div>
            </div>
        </div>
    </div>
    <script src="<?=base_url()?>/ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>/daks2k3a4ib2z.cloudfront.net/571cab5c86c1049c4c0e7047/js/webflow.61345e897.js" type="text/javascript"></script>
    <!--[if lte IE 9]><script src="//cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif]-->
</body>
<!-- Mirrored from template-university.webflow.io/courses/beginner-study-english-language by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 14 Mar 2019 11:31:52 GMT -->

</html>