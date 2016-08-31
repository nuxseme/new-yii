<?php
/**
* 布局文件头部文件
* @author nuxseme
*/
use yii\helpers\Url;

$siteInfo = $this->context->siteInfo;//站点基本信息
$TTHelper = Yii::$container->get('TTHelper');

?>
<header>
  <div class="down_bg animate"></div><!--特殊方式处理下拉层的背景-->
  <div class="w lineBlockBox">
     <div class="handle"><div></div></div>
     <div class="logo"><a href="<?= Url::home();?>"><img src="<?= $TTHelper->staticPrefix();?>/img/logo.png" alt="dodocool"></a></div>
     <?php echo  $this->params['nav']; ?>
     <div class="search_wrap lineBlockBox animate">
         <button class="search_btn lineBlock" type="button" ><i class="icon_search"></i></button>
         <input type="text" class="search_text animate" placeholder="Search dodocool.com">
         <span class="close"><i class="icon_cross"></i></span>
     </div>
     <div  class="member_icon">
          <i class="icon_myaccount"></i>
          <ul>
            <?php if($this->params['isLogin']) : ?>
              <li><a href="<?=Url::toRoute('account/index')?>">my account</a></li>
              <li><a href="<?=Url::toRoute('member/logout')?>">logout</a></li>
            <?php else: ?>
              <li><a href="<?=Url::toRoute('account/index')?>">login</a></li>
              <li><a href="<?=Url::toRoute('member/index')?>">register</a></li>
              <li><a href="<?=Url::toRoute('account/index')?>">my account</a></li>
            <?php endif;?>
          </ul>
     </div>
  </div>
</header>    