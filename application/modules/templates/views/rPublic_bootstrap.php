<?php include 'files/head.php'?>
<?php include 'files/nav.php'?>

<?php include 'files/slider.php'?>
  

<?php
   


  if ($page_url == "") {
    require_once 'content_homepage.php';
  }elseif (isset($view_file)) {
  $this->load->view($view_module.'/'.$view_file);
}

?>    






  
  
  
  
  
    <div class="image-section">
        <div class="image-section-overlay">
            <div class="container w-container">
                <div class="image-section-content-block">
                    <h2 class="image-section-title">Interested in taking a Bus Tour?</h2>
                    <h2 class="_2 image-section-title"><strong>Register Here!</strong></h2>
                    
                     <h2 class="_2 image-section-title">This is an urban development knowledge Bus Tour of Lagos to sites, institutions and relevant individuals in the Knowledge Space. 
The tour will create a platform for engagement, geared towards public enlightenment and change in government policy.

</h2>
                    
                    
                    <a class="button w-button white" href="404.html">Learn more</a></div>
                <div class="image-section-contact-form w-form">
                    <form data-name="Register Form" id="wf-form-Register-Form" name="wf-form-Register-Form">
                        <div class="contact-form-block">
                            <div class="contact-form-title"><strong>Register now</strong> </div>
                        </div>
                        <div class="_2 contact-form-block">
                            <input class="field register w-input" data-name="Name" id="Name-3" maxlength="256" name="Name" placeholder="Enter your name" type="text">
                            <input class="field register w-input" data-name="Email" id="Email-3" maxlength="256" name="Email" placeholder="Enter your email address" required="required" type="email">
                            <input class="button submit-button w-button" data-wait="Please wait..." type="submit" value="Submit">
                        </div>
                    </form>
                    <div class="success-bg w-form-done">
                        <p>Thank you! Your submission has been received!</p>
                    </div>
                    <div class="error-bg w-form-fail">
                        <p>Oops! Something went wrong while submitting the form</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section tint">
        <div class="container w-container">
            <div class="w-row">
                <div class="news-column-left w-col w-col-6">
                    <div class="section-title-wrapper">
                        <h2 class="section-title">RIL in the media</h2>
                        <div class="section-title-divider"></div>
                    </div>
                    <div class="w-dyn-list">
                        <div class="w-dyn-items">
                            <div class="blog-post-item w-dyn-item"><a class="blog-post-title-link" target="_blank" href="https://www.youtube.com/watch?v=2sZCGYylyRA&t=129s">Making Our Environment Better By Addressing Urban Issues" - | Today On STV</a>
                                <div class="blog-post-info-block">
                                    <div class="course-info-icon"></div>
                                    <div class="blog-info-title">Today On STV</div>
                                    <div class="course-info-icon"></div>
                                    <div class="blog-info-title"> Deji Akinpelu</div>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                    <div class="bottom-info-text">Want to read more?&nbsp;<a href="blog.html">View Full Blog Archive&nbsp;→</a></div>
                </div>
                <div class="about-column-right w-col w-col-6">
                    <div class="section-title-wrapper">
                        <h2 class="section-title">About RIL</h2>
                        <div class="section-title-divider"></div>
                    </div>
                    <a class="video-lightbox w-inline-block w-lightbox" href="#">
                     
                        
                            <iframe width="460" height="315" src="https://www.youtube.com/embed/gAQS2UDbN6A?start=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </a>
                    <p>“Research in Lagos” is an information platform and contact point portal for all looking to find out more about Lagos urban development research landscape and its latest research achievements. We highlight activities of relevant organisations, researchers and research works, and supports foreign researchers in their decision to collaborate with Lagos research organisations or to complete a research stay in Lagos.</p><a class="link-below-paragraph" href="about-us.html">Learn more&nbsp;→</a></div>
            </div>
        </div>
    </div>
    


    <?= modules::run('blog/_draw_feed_hp')?>


    </div>
    <?php include 'files/footer.php'?>