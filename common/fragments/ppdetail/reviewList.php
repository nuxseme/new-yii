<div class="tab_info review">
     <article>
         <ul>
          <?php 
          if(!empty($reviewLists))
          {
            foreach ($reviewLists as $key => $value)
            { 
          ?>
              <li>
                 <h4>Does not charge fast at all.</h4>
                 <div class="product_review">
                      <span class="review_bg clearfix">
                          <i class="icon_starss"></i>
                          <i class="icon_starss"></i>
                          <i class="icon_starss"></i>
                          <i class="icon_starss"></i>
                          <i class="icon_starss"></i>
                          <span class="review">
                              <em class="reviews">
                                <i class="icon_stars"></i>
                                <i class="icon_stars"></i>
                                <i class="icon_stars"></i>
                                <i class="icon_stars"></i>
                                <i class="icon_stars"></i>
                              </em>
                          </span>
                      </span>
                  </div>
                 <p class="review_time"><span>MIGY</span><?= date('F j, Y H:i:s', strtotime($value['commentDate']))?></p>
                 <p>Absolute crap. Charges slower than the flea market chargers. Not sure why all the good reviews, maybe mine was defective? Anyways, I purchased a different one at T-mobile and although it isn't dual it does charge as fast as my wall charger. It even says "fast charging" on my screen. I've purchased anker products in the past and really thought this would be a good buy.</p>

              </li>
          <?php 
            }
          }
          else
          { 
          ?>
          <h4>There is no reviews</h4>
          <?php  
          }
          ?>     
         </ul>
     </article>
</div>