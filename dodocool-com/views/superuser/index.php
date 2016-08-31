<?php
use common\components\AppAsset;
//注册资源文件
AppAsset::register($this, 'superuser');

?>
<!--main-->
<div id="main">
     <!--主体内容-->
     <div class="content">
          <!--面包屑开始-->
          <?=$breadCrumbs?>
          <!--面包屑结束-->
          <div class="super_banner">
              <div class="w">Welcome to DODOCOOL Super User Program</div>
          </div>
          <div class="container_wrap w">
               <div class="super_info">
                   <p class="p1">The purpose of the Super User Program (SUP) is to reward those who provide crucial feedback and reviews of our products.By seeing through the eyes of our customers, we're able to provide better products and better service.</p>
                   <p class="p2">
                      Once you become an active Super User, you can enjoy the following benefits:
                   </p>
                   <ul>
                     <li>1. [Limited Supply] Free sample products to test and review</li>
                     <li>2. Monthly discounts available exclusively to registered Super Users</li>
                     <li>3. Regularly updated information on our latest products</li>
                   </ul>
                   <p class="p3">
                      To become a DODOCOOL Super User, simply fill out the form below, click “submit” and our team will get in touch with you soon
                   </p>
               </div> 
               <div class="form_wrap">
              
                  <div class="step_one" style="display: <?= $isLogin ? "none":"block"?>">
                      <form action="">
                      <h3>Step 1: Create your account</h3>
                      <div class="form_control">
                         <div class="control_box">
                            <label>E-mail <span>*</span></label><input type="text" placeholder="please Enter your Email" class="email">
                         </div>
                         <div class="control_box">
                            <label>Password <span>*</span></label><input type="text" placeholder="please Enter your Password" class="password">
                         </div>
                         <div class="control_box">
                            <label>Confirm Password <span>*</span></label><input type="text" placeholder="please Enter your Password Again" class="confirmpassword">
                         </div>
                         <div class="control_box">
                            <input type="button" value="next" class="blueBtn next_btn">
                            <p class="erro_info other_erro_info"></p>
                         </div> 
                       </div>
                      </form>
                  </div>
              
                    <div class="step_two" style="display: <?= $isLogin ? "block":"none"?>">
                    <form action="">
                          <h3>Step 2: Register Super User Now</h3>
                          <?=$superuserInfo?>
                    </form>
                    </div>
               </div>
               <div class="fqa_wrap w">
                    <h3>FAQ</h3>
                    <ul>
                       <li>
                         <p class="question">Q1. How can I register?<i class="icon_arr_top"></i></p>
                         <div class="answer">
                              <p>A: Simply complete the registration form and submit. We will review the details and inform you the result within 5 business days.</p>
                         </div>
                       </li>
                       <li>
                        <p class="question">Q2. What do I need to active my account?<i class="icon_arr_top"></i></p>
                        <div class="answer">
                              <p>A: Simply complete the registration form and submit. We will review the details and inform you the result within 5 business days.</p>
                         </div>
                       </li>
                       <li>
                         <p class="question">Q3. Can I receive exclusive discounts for Super User Program? <i class="icon_arr_top"></i></p>
                          <div class="answer">
                              <p>A: Simply complete the registration form and submit. We will review the details and inform you the result within 5 business days.A: Simply complete the registration form and submit. We will review the details and inform you the result within 5 business days.A: Simply complete the registration form and submit. We will review the details and inform you the result within 5 business days.A: Simply complete the registration form and submit. We will review the details and inform you the result within 5 business days.A: Simply complete the registration form and submit. We will review the details and inform you the result within 5 business days.A: Simply complete the registration form and submit. We will review the details and inform you the result within 5 business days.</p>
                           </div>
                       </li>
                    </ul> 
               </div>

          </div>
     </div>
     <!--主体内容 end-->         
</div>
<!--main end-->
