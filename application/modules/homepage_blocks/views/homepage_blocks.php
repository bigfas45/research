<style>
.cdd{
    background-position: 50% 50%;
  background-size: cover;
}
</style>
<div class="section tint" id="research">
        <div class="container w-container">
        <?php 	foreach($query->result() as $row){

            $parent_cart_id = $row->id; 
            $sql_parent_cart_id = $this->db->query("SELECT * FROM store_categories WHERE parent_cart_id ='$parent_cart_id' ORDER BY `priority` LIMIT 3");
            // $row_parent_cart_id= $sql->row();
            
            ?>
            <div class="section-title-wrapper">
                <h2 class="section-title">  <?=$row->cat_tittle?></h2>
                <div class="section-title-divider"></div>
            </div>
            <div class="featured-courses-list-wrapper w-dyn-list">
                <div class="featured-courses-list w-clearfix w-dyn-items w-row">
                   
                   
                    
                <?php 	foreach($sql_parent_cart_id->result() as $row_parent_cart_id){
                    $id = $row_parent_cart_id->id;
                      $small_pic_path = base_url()."big_pics/".$row_parent_cart_id->big_pic;
                    ?>
                     <div class="featured-course-item w-col w-col-4 w-dyn-item">
                        <div class="auto-height course-block-wrapper">
                            <a class="course-image-link-block large w-inline-block cdd" href="<?=base_url()?>store_items/view_more_post/<?=$id?>" style="background-image: url('<?php echo $small_pic_path; ?>');">
                                <div class="image-overlay-block w-clearfix">
                                    <div class="featured-label">Featured</div>
                                </div>
                               
                            </a>
                            <div class="course-content-block"><a class="course-title-link" href="courses/politics-philosophy-and-theology.html"><?=$row_parent_cart_id->cat_tittle?></a></div>
                            <div class="_2 course-content-block">
                                <div class="course-info-icon"></div>
                                <div class="course-info-title">60</div>
                                <div class="course-info-icon"></div>
                                <div class="course-info-title">5 hours</div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    
                    
                    
                    
                </div>
            </div>
            <div class="bottom-info-text"><a href="<?=base_url()?>homepage_blocks/view_more/<?=$parent_cart_id?>">View More →</a></div>
         
            <?php } ?>
        </div>
        
    </div>
     
        
  
  
  
  
  
  
  
  
  
  
  
 
  
  