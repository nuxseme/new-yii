  <?php 
 $countryList = $this->context->controller->countries;//国家列表
  ?>
  <div class="form_control">
     <div class="control_towcol lineBlockBox">
       <div class="control_box">
            <label>Name<span>*</span></label><input type="text" placeholder="please Enter your Name" value="<?=$superuserInfo['name']?>" id="name">
       </div>
       <div class="control_box gender">
          <label>Geader <span>*</span></label>
         <div class="radio_wrap lineBlockBox">
            <div class="chooseOneBox">
              <label>
              <input name="sex" value="1" type="radio">
              <div class="radio <?php if((isset($superuserInfo['gender']) && 1 == $superuserInfo['gender']) || !isset($superuserInfo['gender'])) echo 'radioChecked'; ?>"><i></i></div><em>male</em>
              </label>
            </div>
            <div class="chooseOneBox">
              <label>
              <input name="sex" value="2" type="radio">
              <div class="radio <?php if(2 == $superuserInfo['gender']) echo 'radioChecked' ?>"><i></i></div><em>Females</em>
              </label>
            </div>
        </div>
       </div> 
     </div>
     <div class="control_towcol lineBlockBox">
         <div class="control_box">
            <label>Country <span>*</span></label>
            <div class="country_wrap">
            <input type="text" placeholder="please Enter your Country" class="you_country" value="<?=$superuserInfo['country']?>" id="country" ><span class="sjx"></span>
            <ul class="country_list">
             <?=common\widgets\ppaccount\CountryListWidget::widget(['countries' => $countryList])?>
            </ul>
            </div>
         </div>
         <div class="control_box">
              <label>State <span>*</span></label><input type="text" placeholder="please Enter your State" value="<?=$superuserInfo['state']?>" id="state">
         </div> 
           
     </div>
     <div class="control_towcol lineBlockBox">
       <div class="control_box">
          <label>City <span>*</span></label><input type="text" placeholder="please Enter your City" value="<?=$superuserInfo['city']?>" id="city">
       </div>
       <div class="control_box">
          <label>Address <span>*</span></label><input type="text" placeholder="please Enter your Address"  value="<?=$superuserInfo['address']?>" id="address">
       </div> 
     </div>
     <div class="control_towcol lineBlockBox">
       <div class="control_box">
          <label>Zip Code<span>*</span></label><input type="text" placeholder="please Enter your Zip Code" value="<?=$superuserInfo['zipcode']?>" id="zipcode">
       </div>
       <div class="control_box">
          <label>Phone <span>*</span></label><input type="text" placeholder="please Enter your Phone" value="<?=$superuserInfo['phone']?>" id="phone">
       </div> 
     </div>
     <div class="control_towcol lineBlockBox">
         <div class="control_box">
            <label>I'm <span>*</span></label>
            <div class="select_wrap">
              <div placeholder="please Enter your Type" class="select_val" type="text" id="iam"><?=$superuserInfo['iam']?></div><span class="select_handle"><i class="sjx"></i></span>
              <ul class="option_list">
                  <li>Customer</li>
                  <li>Potential Customer</li>
                  <li>Professional Reviewer</li>
              </ul>
           </div>
            <div class="purchase_tips">
               <i></i>
               <div class="tips">
                <span></span>
                <h3>How do find your purchase order number?</h3>
                <p>If you bought your product on Amazon, your purchase order can be found in 
the confirmation email you received from Amazon. You can also find it in your 
Amazon account center.</p>                    <p>For other websites such as eBay and Newegg.com, please check your 
confirmation email when you bought your Dodocool product, for your 
purchase order.</p>

               </div>
            </div>
         </div>
           <div class="control_box">
              <label>I identify myself as a <span>*</span></label>
              <div class="select_wrap">
                  <div placeholder="please Enter your role" class="select_val" type="text" id="role"><?=$superuserInfo['role']?></div><span class="select_handle"><i class="sjx"></i></span>
                  <ul class="option_list">
                      <li>Normal User</li>
                      <li>Tech Savvy Consumer</li>
                      <li>IT Expert</li>
                  </ul>
               </div>
         </div>
      </div>
        <div class="control_towcol lineBlockBox">
           <div class="control_box">
              <label>Your Amazon account
country domain<span>*</span></label><div class="select_wrap">
                  <div placeholder="please Enter your Amazon account country domain" class="select_val" type="text" id="amazonCountryDomain" ><?=$superuserInfo['amazonCountryDomain']?></div><span class="select_handle"><i class="sjx"></i></span>
                  <ul class="option_list">
                    <li>Amazon.com</li>
                    <li>Amazon.ca</li>
                    <li>Amazon.de</li>
                    <li>Amazon.fr</li>
                    <li>Amazon.es</li>
                    <li>Amazon.uk</li>
                    <li>Amazon.jp</li>
                  </ul>
               </div>
           </div>
           <div class="control_box right_tips">
                <label>Amazon Profile Link<span>*</span></label>
                 <input placeholder="http://" type="text" value="<?=$superuserInfo['amazonProfileLink']?>" id="amazonProfileLink">
                <div class="purchase_tips">
                     <i></i>
                     <div class="tips right_tips">
                        <span></span>
                        <h3>How do find your purchase order number?</h3>
                        <p>If you bought your product on Amazon, your purchase order can be found in 
the confirmation email you received from Amazon. You can also find it in your 
Amazon account center.</p>                    <p>For other websites such as eBay and Newegg.com, please check your 
confirmation email when you bought your Dodocool product, for your 
purchase order.</p>

                     </div>
                </div>
           </div>
        </div>
        <div class="control_onecol">
            <div class="control_box external">
              <label>My External
Reviewer Profile<span>*</span></label>
              <div class="right_group">
                  <div class="one_col">
                     <div class="select_wrap">
                        <div placeholder="please Enter your External
Reviewer Profile" class="select_val" type="text"></div><span class="select_handle"><i class="sjx"></i></span>
                        <ul class="option_list">
                          <li>YouTube</li>
                          <li>Facebook</li>
                          <li>Twitter</li>
                          <li>Blog</li>
                          <li>Websites</li>
                          <li>BBS</li>
                          <li>Others</li>
                        </ul>
                     </div>
                  <input type="text" placeholder="please Enter your order code">
                  </div>
                  <span class="plug_btn"><i class="icon_plus"></i></span>
             </div>
           </div>
        </div>
       <div class="control_onecol">
           <div class="control_box">
                <input type="button" value="submit" class="blueBtn finish_btn">
           </div> 
       </div> 
  </div>
