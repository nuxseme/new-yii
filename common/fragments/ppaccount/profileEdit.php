 <?php
 use yii\helpers\Url;
 $TTHelper = Yii::$container->get('TTHelper');
 $countryList = $this->context->controller->countries;//国家列表

$brithday = array('year'=>'', 'month'=>'', 'day'=>'');
if(isset($userBasicInfo['dbirth']) && !empty($userBasicInfo['dbirth'])){
    $userBasicInfo['dbirth'] = intval($userBasicInfo['dbirth'] / 1000);
    $brithday = array('year'=>date('Y',$userBasicInfo['dbirth']),'month'=>date('m',$userBasicInfo['dbirth']),'day'=>date('d',$userBasicInfo['dbirth']));
}
 ?>
<div class="acount_right">
          <div class="content_wrap">
           <h3 class="hd">Profile</h3>
           <div class="form_wrap">
             <div class="col_one">
                 <form id="editProfile" action="<?=Url::toRoute('account/editprofile')?>" method="POST">
                  <div class="form_control">
                    <div class="control_box edit_photo lineBlockBox">
                      <label></label>
                      <form enctype="multipart/form-data" role="form" id="photo-form" method="POST" action="<?=Url::toRoute('account/uploadimg') ?>">
                      <div class="photo" id="preview"><img id="prvfilepath" src="<?=empty($userBasicInfo['cimageurl'])?$TTHelper->staticPrefix().'/img/photo.jpg' : $userBasicInfo['cimageurl'] ?> " alt=""></div>
                      <div class="edit_btn defaultBtn">Edit Picture<input type="file" value="Edit Picture" id="filepath">
                      </div>
                      <p class="erro_info" id=""></p>
                       </form>
                    </div>
                    <div class="control_box">
                      <label>UserName<span>*</span></label><input type="text" placeholder="please Enter your UserName" value="<?= $userBasicInfo['caccount']?>" name="username" id="username">
                     </div>
                     <div class="control_box">
                        <label>E-mail<span>*</span></label><?= $userBasicInfo['cemail']?>
                     </div>
                     <div class="control_box gender">
                        <label>Gender<span>*</span></label>
                        <div class="radio_wrap lineBlockBox">
                          <div class="chooseOneBox">
                            <label>
                            <input name="sex" value="1" type="radio" >
                            <div class="radio <?php if((isset($userBasicInfo['igender']) && $userBasicInfo['igender'] == 1) || !isset($userBasicInfo['igender'])):?>radioChecked<?php endif;?>"><i></i></div><em>male</em>
                            </label>
                          </div>
                          <div class="chooseOneBox">
                            <label>
                            <input name="sex" value="2" type="radio" >
                            <div class="radio <?php if(isset($userBasicInfo['igender']) && $userBasicInfo['igender'] == 2):?>radioChecked<?php endif;?> "><i></i></div><em>Females</em>
                            </label>
                          </div>
                        </div>
                     </div>
                     <div class="control_box birthday">
                        <label>Birthday:<span>*</span></label>
                        <div class="select_wrap" id="dateSelector">
                          <div  class="select_val month" type="text"><?=$brithday['month']?></div><span class="select_handle"><i class="sjx"></i></span>
                          <ul class="option_list" id="idMonth">
                          </ul>
                        </div>
                         <div class="select_wrap">
                            <div class="select_val day" type="text" ><?=$brithday['day']?></div><span class="select_handle"><i class="sjx"></i></span>
                            <ul class="option_list" id="idDay">
                            </ul>
                         </div>
                         <div class="select_wrap">
                            <div  class="select_val year" type="text" ><?=$brithday['year']?></div><span class="select_handle"><i class="sjx"></i></span>
                            <ul class="option_list" id="idYear">
                            </ul>
                         </div>
                     </div>
                     <div class="control_box location">
                        <label>Location<span>*</span></label>
                        <div class="m_pullDown_country">
              <i class="arrow"></i>
              <div class="result">
                <i></i><em><?= empty($userBasicInfo['ccountry']) ? "US":$userBasicInfo['ccountry'] ?></em>
              </div>
              <div class="m_more_country">
                <p><input type="text" value="" /></p>
                 <ul class="all_country">
                <?=common\widgets\ppaccount\CountryListWidget::widget(['countries' => $countryList])?>
                 </ul>
              </div>
            </div>
                     </div>
                     <div class="control_box textarea">
                      <label>AboutMe</label>
                      <textarea name="aboutme"><?=$userBasicInfo['caboutme']?></textarea>
                     </div>
                     <div class="control_onecol">
                     <div class="control_box">
                      <input type="button" value="submit" class="blueBtn submit_btn">
                      <p class="erro_info submit_error"></p>
                     </div>
                     </div> 
                  </div>
                </form>
              </div>
              </div>
          </div>
     </div>