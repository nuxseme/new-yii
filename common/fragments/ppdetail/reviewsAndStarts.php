<?php if(!empty($reviewsAndStarts['count']) && !empty($reviewsAndStarts['start'])):?>
<div class="star_wrap">
      <div class="product_review">
          <span class="review_bg clearfix">
              <i class="icon_starss"></i>
              <i class="icon_starss"></i>
              <i class="icon_starss"></i>
              <i class="icon_starss"></i>
              <i class="icon_starss"></i>
              <span class="review">
                  <em class="reviews">
                  <?php 
                    $starts = $reviewsAndStarts['start'];
                    for ($i=0; $i < $starts; $i++) 
                    { ?>
                    <i class="icon_stars"></i>
                    <?php } ?>
                  </em>
              </span>
          </span>
      </div> 
    <span class="review_data">(<?=$reviewsAndStarts['count']?> Reviews)</span>
</div>
<?php endif;?>