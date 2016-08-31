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

        <div class="xxkBOX boxRa block">
            <table class="profTab" width="760" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td valign="top"><?= $TTHelper->getSiteLang('account.picture')?></td>
                    <td>
                        <div class="headLeft" id="photo">
                            <img id="user-photo" src="<?= (empty($userBasicInfo['cimageurl'])) ?  $TTHelper->staticPrefix().'/icon/HeadPic.jpg' : $userBasicInfo['cimageurl']?>">
                            <input class="hsInput clicks" type="button" value="Edit Picture">
                            <div class="TS">
                                <em></em>
                                <p class="TsTxt"><?= $TTHelper->getSiteLang('account.myProfileEditPictureIco')?></p>
                            </div>
                            <div class="upHead clickPop">
                                <h6><?= $TTHelper->getSiteLang('account.createcustompicture')?></h6>
                                <?= $TTHelper->getSiteLang('account.uploadPicture')?>:
                                <form enctype="multipart/form-data" role="form" id="photo-form" method="POST" action="<?=Url::toRoute('account/uploadimg') ?>">
                                <div class="upFileHead">

                                        <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
                                        <input type="hidden" name="userHeadImage" value="">
                                        <input type="file" name="file"><a href="javascript:void(0);">Browse..</a>

                                </div>
                                <div class="throbber" id="loading"></div>
                                <div style="color:red;" class="msg"></div>
                                <p style="width:470px;"><?= $TTHelper->getSiteLang('account.myProfileEditPicture')?></p>

                                    <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
                                    <input type="hidden" name="filePath" value="">
                                    <input type="button" value="<?= $TTHelper->getSiteLang('product.cancel')?>" class="closePop">
                                    <input type="submit" value="Save" class="closePop picSave" disabled="disabled">
                                </form>
                                <div class="rightHead">
                                    <p><?= $TTHelper->getSiteLang('account.preview')?></p>
                                    <div id="preview">
                                        <img width="120" height="120" src="<?php if($userBasicInfo['cimageurl']):?><?= $userBasicInfo['cimageurl']?><?php else:?><?= $TTHelper->staticPrefix();?>/icon/HeadPic.jpg<?php endif;?>">
                                    </div>
                                    120x120
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            <form id="editAccount" action="<?=Url::toRoute('account/editprofile')?>" method="POST">
                <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
                <table class="profTab mar0" id="profChange" width="760" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td><?= $TTHelper->getSiteLang('account.emailAddress')?></td>
                        <td><?= $userBasicInfo['cemail']?></td>
                    </tr>
                    <tr>
                        <td><?= $TTHelper->getSiteLang('account.nickName')?></td>
                        <td class="nameED">
                            <input type="text" class="proText" name="account" autocomplete=off value="<?= $userBasicInfo['caccount']?>">
                            <span class="help-inline"><?= $TTHelper->getSiteLang('message.cannotBeEmpty')?>!</span>
                        </td>
                    </tr>
                    <tr>
                        <td><?= $TTHelper->getSiteLang('account.firstName')?></td>
                        <td class="nameED">
                            <input type="text" class="proText" name="fname" autocomplete=off value="<?= $userBasicInfo['cfirstname']?>">
                            <span class="help-inline"><?= $TTHelper->getSiteLang('message.cannotBeEmpty')?>!</span>
                        </td>
                    </tr>
                    <tr>
                        <td><?= $TTHelper->getSiteLang('account.lastName')?></td>
                        <td class="nameED">
                            <input type="text" class="proText" name="lname" autocomplete=off value="<?= $userBasicInfo['clastname']?>">
                            <span class="help-inline"><?= $TTHelper->getSiteLang('message.cannotBeEmpty')?>!</span>
                        </td>
                    </tr>
                    <tr>
                        <td><?= $TTHelper->getSiteLang('account.gender')?></td>
                        <td class="radioBox">
                            <label><input type="radio" <?php if(isset($userBasicInfo['igender']) && $userBasicInfo['igender'] == 1):?>checked="checked"<?php endif;?> name="gender" value="1"><?= $TTHelper->getSiteLang('account.male')?></label>
                            <label class="femaleLab"><input type="radio" <?php if(isset($userBasicInfo['igender']) && $userBasicInfo['igender'] == 2):?>checked="checked"<?php endif;?> name="gender" value="2">Females</label>
                        </td>
                    </tr>
                    <tr>
                        <td><?= $TTHelper->getSiteLang('account.birthday')?></td>
                        <td class="timeSe">
                            <select class="sel_month" name="month" rel="<?= $brithday['month']?>"> </select> <?= $TTHelper->getSiteLang('account.month')?>
                            <select class="sel_day" name="day" rel="<?= $brithday['day']?>"> </select> <?= $TTHelper->getSiteLang('account.day')?>
                            <select class="sel_year" name="year" rel="<?= $brithday['year']?>"> </select> <?= $TTHelper->getSiteLang('account.year')?>
                            <div class="TS">
                                <em></em>
                                <p class="TsTxt"><?= $TTHelper->getSiteLang('account.myProfileP1')?>.</p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><?= $TTHelper->getSiteLang('account.country')?></td>
                        <td class="edit_country">
                            <div class="Countries_box">
                                <div class="select_country">
                                    <h3>
                                        <span id="currents_flage" class="flag_<?= $userBasicInfo['ccountry']?>"><em> </em></span>
                                        <span class="flag_Txt"><?=$userBasicInfo['ccountry'] ;?></span><em class="ship_xSJ"></em>
                                        <input type="hidden" name="countryName" autocomplete=off value="<?= (empty($userBasicInfo['ccountry']))?'US':$userBasicInfo['ccountry'];?>">
                                    </h3>
                                    <div class="pu_blockWarp country_all">
                                        <div class="search_country"><input type="text" name="country_filter"></div>
                                        <ul class="country_list">
                                            <?php foreach($countryList as $country):?>
                                                <li class="country_item flag_<?= $country['isoCodeTwo'] ?>">
                                                    <em></em><span data="<?= $country['isoCodeTwo'] ?>"><?=$country['name'] ?></span>
                                                </li>
                                            <?php endforeach;?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
<!--                    <tr>-->
<!--                        <td>Years in Hobby:</td>-->
<!--                        <td class="timeYears">-->
<!--                            <select class="sel_years"  name="hobby_years">-->
<!--                                --><?php
//                                foreach ($hobby_years as $k=>$v) {
//                                    if($v['id'] == $userBasicInfo['hobby_years']){
//                                        echo '<option selected="" value="' . $v['id'] . '">' . $v['name'] . '</option>';
//                                    }else{
//                                        echo '<option  value="' . $v['id'] . '">' . $v['name'] . '</option>';
//                                    }
//                                }
//                                ?>
<!--                            </select>-->
<!--                        </td>-->
<!--                    </tr>-->
<!--                    <tr>-->
<!--                        <td>Experience Level:</td>-->
<!--                        <td class="timeLevel">-->
<!--                            <select class="sel_Level"  name="experience_level">-->
<!--                                --><?php
//                                foreach ($experience_level as $k => $v) {
//                                    if($v['id'] == $userBasicInfo['$experience_level']){
//                                        echo '<option selected="" value="' . $v['id'] . '">' . $v['name'] . '</option>';
//                                    }else{
//                                        echo '<option  value="' . $v['id'] . '">' . $v['name'] . '</option>';
//                                    }
//                                }
//                                ?>
<!--                            </select>-->
<!--                        </td>-->
<!--                    </tr>-->
                    <tr>
                        <td valign="top"><?= $TTHelper->getSiteLang('account.aboutMe')?></td>
                        <td class="aboutMe">
                            <input type="hidden" name="bactivated" value="<?= $userBasicInfo['bactivated']?>">
                            <textarea name="about" autocomplete=off><?= $userBasicInfo['caboutme']?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="changeHs">
                            <a href="javascript:void(0);" class="infChange"><?= $TTHelper->getSiteLang('account.saveChanges')?></a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <div class="xxkBOX boxRa">
            <form action="<?=Url::toRoute('account/editpassword')?>" id="change_password" method="POST">
                <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
                <table class="profTab" width="650" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td><?= $TTHelper->getSiteLang('account.emailAddress')?></td>
                        <td><?= $userBasicInfo['cemail']?></td>
                    </tr>
                    <tr>
                        <td><?= $TTHelper->getSiteLang('account.oldPassword')?></td>
                        <td>
                            <div>
                                <input class="proText" type="password" name="cpassword" autocomplete=off>
                                <span class="rightUse"></span>
                                <span class="help-inline"><?= $TTHelper->getSiteLang('account.pleaseEnterAnyNotes')?>.</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><?= $TTHelper->getSiteLang('account.newPassword')?></td>
                        <td>
                            <div class="rights">
                                <input class="proText" type="password" name="cnewpassword" autocomplete=off>
                                <span class="rightUse"></span>
                                <span class="help-inline"><?= $TTHelper->getSiteLang('account.pleaseEnterAnyNotes')?>.</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><?= $TTHelper->getSiteLang('account.confirmPassword')?></td>
                        <td>
                            <div>
                                <input class="proText" type="password" name="ccnewpassword" autocomplete=off>
                                <span class="rightUse"></span>
                                <span class="help-inline"><?= $TTHelper->getSiteLang('account.pleaseEnterAnyNotes')?>.</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td class="changeHs"><input class="passChange" type="button" value="Save Changes"></td>
                    </tr>
                </table>
            </form>
        </div>
