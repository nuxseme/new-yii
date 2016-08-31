<?php
/**
* 布局文件脚部文件
* @author caoxl
*/
$TTHelper = Yii::$container->get('TTHelper');
?>
<footer class="footer">
  <div class="fol_new">
    <div class="w clearfix">
       <div class="follow_us">
         <div class="m_follow_us">
           <h5>Follow us and get to know us better</h5>
           <div>
             <a href="https://plus.google.com/u/1/113061239335700732531/posts" target="_blank"  target="_blank" class="google"><i class="icon_google-plus"></i></a>
             <a href="https://twitter.com/dodocoolCSR"  target="_blank" class="twitter"><i class="icon_twitter"></i></a>
             <a href="https://www.youtube.com/channel/UC6fajUtPeTJOeDDIeeeBdvg" target="_blank" class="youtube"><i class="icon_youtube"></i></a>
             <a href="javascript:void(0)"  target="_blank" class="facebook"><i class="icon_facebook"></i></a>
           </div>
         </div>
       </div>
       <div class="newsLetter">
         <div class="m_newsLetter">
           <h5>Our newsletter, join and get free $10</h5>
           <div class="input_box lineBlockBox">
              <input type="text" class="text" placeholder="Enter your Email">
              <button type="button" class="submit_btn" >submit</button>
           </div>
         </div>
       </div>
    </div>
  </div>
  <div class="fn_copy">
    <div class="w clearfix">
       <?= $this->params['footerArticle'];?>
       <div class="copyRight">Copyright <em>©</em> 2016 dodocool inc. All rights reserved.
       <span>English (US)</span></div>
    </div>
  </div>
  <!--<div class="toast animate"></div> -->
  <div class="mask"></div>
</footer>