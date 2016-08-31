<?php
use yii\helpers\Url;
$TTHelper = Yii::$container->get('TTHelper');
?>
<?php if($reviewList):?>
    <h6><?= $TTHelper->getSiteLang('common.myReviews')?> <a href="<?= Url::toRoute('account/myreviews')?>"><?= $TTHelper->getSiteLang('common.more')?> >></a></h6>
    <table class="myRevi" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <th><?= $TTHelper->getSiteLang('account.items')?></th>
            <th class="capTh"><?= $TTHelper->getSiteLang('account.review/caption')?></th>
            <th><?= $TTHelper->getSiteLang('account.postDate')?></th>
            <th><?= $TTHelper->getSiteLang('account.status')?></th>
            <th><?= $TTHelper->getSiteLang('account.options')?></th>
        </tr>
        <?php foreach ($reviewList as $key => $value):?>
            <tr>
                <td class="firImg"><a href=""></a></td>
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
                            <li class="hoveSTText"><?= $TTHelper->getSiteLang('product.price')?>:</li>
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
                    <a href=""><?= $TTHelper->getSiteLang('account.view')?></a>
                </td>
            </tr>
        <?php endforeach;?>
    </table>
<?php endif;?>
