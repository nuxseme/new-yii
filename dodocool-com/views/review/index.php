<?php
use common\components\AppAsset;
use common\widgets\AccountWidget;

//语言包
//注册资源文件
AppAsset::register($this, 'account');
$this->title ='My Review';
$TTHelper = Yii::$container->get('TTHelper');
?>
<section class="contentInside accInside">
    <?= AccountWidget::widget([
        'displayCount'  => $page->total,
        'displayName'   => Yii::$app->controller->action->id,
    ]);?>

    <div class="accountRight accouReviewBox lineBlock">
        <h6><?= $TTHelper->getSiteLang('account.reviewsList')?></h6>
        <ul class="myReviewsList lbUl">
            <li class="headPortrait">
                <div><img src="<?= (empty($accountBaseInfo['cimageurl'])) ? '/icon/HeadPic.jpg' : $accountBaseInfo['cimageurl']?>"></div>
                <p><?= ($accountBaseInfo['caccount'] != '') ? $accountBaseInfo['caccount'] : $accountBaseInfo['cemail'];?></p>
            </li>
            <li>
                <ol><?= $TTHelper->getSiteLang('account.totalReviews')?>: <b><?= $reviewStatistical['totalReviewsCount']?></b></ol>
                <ol><?= $TTHelper->getSiteLang('account.approvedReviews')?>: <b><?= $reviewStatistical['approvedReviewsCount']?></b></ol>
                <ol><?= $TTHelper->getSiteLang('account.pendingReviews')?>: <b><?= $reviewStatistical['pendingReviewsCount']?></b></ol>
                <ol><?= $TTHelper->getSiteLang('account.failedReviews')?>: <b><?= $reviewStatistical['failedReviewsCount']?></b></ol>
            </li>
            <li>
                <ol><?= $TTHelper->getSiteLang('account.chicuuPoints')?>: <b><?= $reviewStatistical['pointsTotal']?></b></ol>
            </li>
        </ul>
        <p class="marT"><?= $TTHelper->getSiteLang('account.myReviewsP1')?></p>
        <p class="marT"><?= $TTHelper->getSiteLang('account.myReviewsP2')?></p>
        <img class="marT" src="<?= $TTHelper->staticPrefix();?>/icon/accReviewsList.jpg">
        <div class="xxkDiv">
            <ul class="blackXXK lbUl">
                <li class="xxkActi"><?= $TTHelper->getSiteLang('account.writeAReview')?></li>
            </ul>
            <form class="topSearch_search" action="index.php" id="reviewSearch" method="GET">
                <input type="hidden" name="r" value="review/index">
                <ul class="reviewTT_ul lbUl">
                    <li>
                        <select name="dateType">
                            <option value="0" <?php if($_GET['dateType'] == '0'):?>selected<?php endif;?>><?= $TTHelper->getSiteLang('account.allDate')?></option>
                            <option value="3" <?php if($_GET['dateType'] == '3'):?>selected<?php endif;?>><?= $TTHelper->getSiteLang('account.last3Months')?></option>
                            <option value="6" <?php if($_GET['dateType'] == '6'):?>selected<?php endif;?>><?= $TTHelper->getSiteLang('account.last6Months')?></option>
                            <option value="12" <?php if($_GET['dateType'] == '12'):?>selected<?php endif;?>><?= $TTHelper->getSiteLang('account.lastYear')?></option>
                        </select>
                    </li>
                    <li>
                        <select name="status">
                            <option value="-1" <?php if($_GET['status'] == '-1'):?>selected<?php endif;?>><?= $TTHelper->getSiteLang('account.status')?></option>
                            <option value="0" <?php if($_GET['status'] == '0'):?>selected<?php endif;?>><?= $TTHelper->getSiteLang('account.pending')?></option>
                            <option value="1" <?php if($_GET['status'] == '1'):?>selected<?php endif;?>><?= $TTHelper->getSiteLang('account.approved')?></option>
                            <option value="2" <?php if($_GET['status'] == '2'):?>selected<?php endif;?>><?= $TTHelper->getSiteLang('account.failed')?></option>
                        </select>
                    </li>
                    <li class="searchInp"><input class="orderSearch" type="submit" value="<?= $TTHelper->getSiteLang('account.search')?>"></li>
                </ul>
            </form>
            <div class="xxkBOX boxRa block">
                <table class="myRevi" width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr class="werThTT">
                        <th class="capItems"><?= $TTHelper->getSiteLang('account.items')?></th>
                        <th class="capTh"><?= $TTHelper->getSiteLang('account.reviewCaption')?></th>
                        <th class="myDate"><?= $TTHelper->getSiteLang('account.postDate')?></th>
                        <th class="myUnapproved"><?= $TTHelper->getSiteLang('account.status')?></th>
                        <th class="myView"><?= $TTHelper->getSiteLang('account.options')?></th>
                    </tr>
                    <?php
                    if($reviewList):
                        foreach ($reviewList as $key => $value):
                            ?>
                            <tr id="iid_<?= $value['rid']?>">
                                <td class="firImg"><a href=""><img src=""></a></td>
                                <td class="capTd">
                                    <div class="productReviews reviHover">
                                        <div class="product_review">
									<span class="review_bg clearfix">
										<i class="icon_starss"></i>
										<i class="icon_starss"></i>
										<i class="icon_starss"></i>
										<i class="icon_starss"></i>
										<i class="icon_starss"></i>
										<span class="review" style="width:<?= $value['fs'] * 20?>%">
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
                                        <ul class="hoverStar">
                                            <li class="hoveSTText hoverAll"><?= $TTHelper->getSiteLang('product.overall')?>:</li>
                                            <li class="hoverAll">
                                                <div class="product_review">
											<span class="review_bg clearfix">
												<i class="icon_starss"></i>
												<i class="icon_starss"></i>
												<i class="icon_starss"></i>
												<i class="icon_starss"></i>
												<i class="icon_starss"></i>
												<span class="review" style="width:<?= $value['fs'] * 20?>%">
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
                                            </li>
                                            <li class="hoveSTText"><?= $TTHelper->getSiteLang('product.usefulness')?>:</li>
                                            <li>
                                                <div class="product_review">
											<span class="review_bg clearfix">
												<i class="icon_starss"></i>
												<i class="icon_starss"></i>
												<i class="icon_starss"></i>
												<i class="icon_starss"></i>
												<i class="icon_starss"></i>
												<span class="review" style="width:<?= $value['us'] * 20?>%">
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
                                            </li>
                                            <li class="hoveSTText"><?= $TTHelper->getSiteLang('product.shipping')?>:</li>
                                            <li>
                                                <div class="product_review">
											<span class="review_bg clearfix">
												<i class="icon_starss"></i>
												<i class="icon_starss"></i>
												<i class="icon_starss"></i>
												<i class="icon_starss"></i>
												<i class="icon_starss"></i>
												<span class="review" style="width:<?= $value['ss'] * 20?>%">
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
                                            </li>
                                            <li class="hoveSTText"><?= $TTHelper->getSiteLang('account.price')?>:</li>
                                            <li>
                                                <div class="product_review">
											<span class="review_bg clearfix">
												<i class="icon_starss"></i>
												<i class="icon_starss"></i>
												<i class="icon_starss"></i>
												<i class="icon_starss"></i>
												<i class="icon_starss"></i>
												<span class="review" style="width:<?= $value['ps'] * 20?>%">
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
                                            </li>
                                            <li class="hoveSTText"><?= $TTHelper->getSiteLang('product.quality')?>:</li>
                                            <li>
                                                <div class="product_review">
											<span class="review_bg clearfix">
												<i class="icon_starss"></i>
												<i class="icon_starss"></i>
												<i class="icon_starss"></i>
												<i class="icon_starss"></i>
												<i class="icon_starss"></i>
												<span class="review" style="width:<?= $value['qs'] * 20?>%">
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
                                            </li>
                                        </ul>
                                    </div>
                                    <p><?= $value['comment']?></p>
                                    <ol class="writePic lbUl">
                                        <?php foreach ($value['photosUrl'] as $key => $reviewImg):?>
                                            <li class="lineBlock"><a href="javascript:void(0);"><img src="<?= $reviewImg?>"></a></li>
                                        <?php endforeach;?>
                                    </ol>
                                    <!--addPic-->
                                    <div class="writeAddPic blockPopup_box">
                                        <div class="writeAddPicBox">
                                            <div class="close"> </div>
                                            <div class="AddPicLClick leftArr"> </div>
                                            <div class="AddPicRClick rightArr"> </div>
                                            <ul class="customer_bigPic">
                                                <?php foreach ($value['photosUrl'] as $key => $reviewImg):?>
                                                    <li><img class="lazy" src="<?= $reviewImg?>" /></li>
                                                <?php endforeach;?>
                                            </ul>
                                        </div>
                                        <div class="black"> </div>
                                    </div>
                                </td>
                                <td class="myDate"><?= date("F j, Y", substr($value['createDate'], 0, -3))?></td>
                                <td class="myUnapproved"><?= $value['status']?></td>
                                <td class="myView">
                                    <?php if($value['status'] == 'Pending'):?>
                                        <span class="editor" reviewId="<?= $value['rid']?>"></span>
                                        <a class="removeR delete" href="javascript:void(0);" dataId="<?= $value['rid']?>"><?= $TTHelper->getSiteLang('account.remove')?>
                                            <div class="point dialogss_main">
                                                <h3 class="point_title"><?= $TTHelper->getSiteLang('account.popover')?></h3>
                                                <p class="point_info"><?= $TTHelper->getSiteLang('account.removefromyourcart')?></p>
                                                <div class="point_but">
                                                    <button class="point_cancel others_close animate" type="button"><?= $TTHelper->getSiteLang('account.cancel')?></button>
                                                    <button class="point_ok others_close animate deleteYes" type="button"><?= $TTHelper->getSiteLang('account.oK')?></button>
                                                </div>
                                                <i class="point_arrows"></i>
                                                <span class="dialogss_close point_code"></span>
                                            </div>
                                        </a>
                                    <?php else:?>
                                        <a href=""><?= $TTHelper->getSiteLang('account.view')?></a>
                                    <?php endif;?>
                                </td>
                            </tr>
                            <?php
                        endforeach;
                    else:
                        ?>
                        <tr>
                            <td class="noProducts" colspan="6">
                                <p class="noCommentTXT"><?= $TTHelper->getSiteLang('account.myReviewsP3')?></p>
                            </td>
                        </tr>
                    <?php endif;?>
                </table>
                <div class="writeEdit writeReview">  </div>
                <?php if($reviewList):?>
                    <ul class="lbBox pagingWarp">
                        <?= $page->showpage();?>
                    </ul>
                <?php endif;?>
            </div>
        </div>
    </div>
</section>