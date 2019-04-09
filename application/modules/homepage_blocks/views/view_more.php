<div class="section">
        <div class="container w-container">
            <div class="w-dyn-list">
                <div class="w-clearfix w-dyn-items w-row">
                <?php foreach($query->result() as $row){
                    $id = $row->id;
                 $small_pic_path = base_url()."big_pics/".$row->big_pic;
                    ?>
                    <div class="courses-list-item w-col w-col-4 w-dyn-item">
                        <div class="auto-height course-block-wrapper">
                            <a class="course-image-link-block w-inline-block" href="<?=base_url()?>store_items/view_more_post/<?=$id?>" style="background-image: url('<?php echo $small_pic_path; ?>');">
                                <div class="image-overlay-block w-clearfix">
                                    <div class="featured-label w-condition-invisible">Featured</div>
                                </div>
                               
                            </a>
                            <div class="course-content-block"><a class="course-title-link" href="../courses/how-to-successfully-become-a-freelancer.html"><?=$row->cat_tittle?></a></div>
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