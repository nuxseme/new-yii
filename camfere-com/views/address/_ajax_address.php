<?php
$TTHelper = Yii::$container->get('TTHelper');
$ContryModel = Yii::$container->get('CountryModel');
$countryList =  $this->context->countries;
?>
<form action="index.php?r=address/write" method="POST" id="shopping_address">
	<input type="hidden" name="type" value="<?= $type?>">
	<input type="hidden" name="address_id" value="<?= $info['id']?>">
    <div class="newshopping_address_pop">
        <h2>Enter New <?php if($type=='shipaddress'):?>Shipping Address<?php else:?>Billing Address<?php endif;?></h2>
        <ul class="newshopping_address_input">
            <li>
                <div class="address_input_item left">
                    <h5>Firtst Name<i>*</i></h5>
                    <input class="vipText" type="text" name="cfirstname" autocomplete="off" value="<?= $info['fname']?>"/>
                    <span class="help-inline">Can't be empty!</span>
                </div>
                <div class="address_input_item right">
                    <h5>Last Name<i>*</i></h5>
                    <input class="vipText" type="text" name="clastname" autocomplete="off" value="<?= $info['lname']?>"/>
                    <span class="help-inline">Can't be empty!</span>
                </div>
            </li>
            <li>
                <div class="address_input_item left">
                    <h5>Country<i>*</i></h5>
                    <div class="newshopping_address_country">
                        <div class="address_country"><div><?= (empty($TTHelper->getCountryNameByCode($info['country'],$countryList)))?'United States':$TTHelper->getCountryNameByCode($info['country'],$countryList);?></div><span class="countrySpan"><i></i></span></div>
                        <div class="country_all edit_country" style="display: none;">
                            <div class="search_country"><input type="text" name="country_filter"></div>
                            	<input type="hidden" name="icountry" value="1">
                                <ul class="country_list">
                                	<?php foreach($countryList as $country):?>
										<li class="flag_<?= $country['isoCodeTwo'] ?>" countryId="<?=$country['id'] ?>"><span><?=$country['name'];?></span></li>
								   <?php endforeach;?>
                                </ul>
                        </div>
                    </div>
                </div>
                <div class="address_input_item right">
                    <h5><input type="checkbox" name="isDefault" value="1" <?php if($info['isDef']==1):?>checked="checked"<?php endif;?>></input> is Default</h5>
                </div>
            </li>
            <li>
                <div class="address_input_item">
                    <h5>Address Line 1<i>*</i></h5>
                    <input class="vipText" type="text" name="cstreetaddress" autocomplete="off" value="<?= $info['street']?>"/>
                    <span class="help-inline">Can't be empty!</span>
                </div>
            </li>
            <li>
                <div class="address_input_item left">
                    <h5>City<i>*</i></h5>
                    <input class="vipText" type="text" name="ccity" autocomplete="off" value="<?= $info['city']?>"/>
                    <span class="help-inline">Can't be empty!</span>
                </div>
                <div class="address_input_item right">
                    <h5>State / Region<i>*</i></h5>
                    <input class="vipText" type="text" name="cprovince" utocomplete="off" value="<?= $info['province']?>"/>
                    <span class="help-inline">Can't be empty!</span>
                </div>
            </li>
            <li>
                <div class="address_input_item left">
                    <h5>Postal Code<i>*</i></h5>
                    <input class="vipText" type="text" name="cpostalcode" utocomplete="off" value="<?= $info['postalcode']?>"/>
                    <span class="help-inline">Can't be empty!</span>
                </div>
                <div class="address_input_item right">
                    <h5>Phone Number<i>*</i><div class="hint_phone_num"><p>For shipping and delivery purposes only.</p></div></h5>
                    <input class="vipText" type="text" name="ctelephone" utocomplete="off" value="<?= $info['tel']?>"/>
                    <span class="help-inline">Can't be empty!</span>
                </div>
            </li>
        </ul>

        <div class="newshopping_address_submit">
            <a href="#">Privacy Policy</a>
            <div class="address_submit">
                <a href="javascript:void(0);" class="cancel closePop">Cancel</a>
                <a href="javascript:void(0);" class="save">Save & Continue >></a>
            </div>
        </div>
    </div>
</form>