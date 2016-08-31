<?php
use common\components\AppAsset;
use common\widgets\AccountWidget;
use yii\helpers\Url;
//语言包
//注册资源文件
AppAsset::register($this, 'account');
$L = $this->context->langPkg;
$this->title ='My order';
$TTHelper = Yii::$container->get('TTHelper');
?>
<section class="contentInside accInside">
    <?= AccountWidget::widget([
        'displayCount'  => $page->total,
        'displayName'   => Yii::$app->controller->action->id,
    ]);?>

    <div class="accountRight lineBlock orderBox">
        <h6><?= $TTHelper->getSiteLang('account.myOrder')?></h6>
        <ul class="orderUl">
            <li><p><?= $TTHelper->getSiteLang('account.myOrder')?></p><span><?= $orderAllStatus['all']?></span></li>
            <li><p><?= $TTHelper->getSiteLang('account.paymentPending')?></p><span><?= $orderAllStatus['pending']?></span></li>
            <li><p><?= $TTHelper->getSiteLang('account.paymentConfirmed')?></p><span><?= $orderAllStatus['confirmed']?></span></li>
            <li><p><?= $TTHelper->getSiteLang('account.processing')?></p><span><?= $orderAllStatus['processing']?></span></li>
            <li><p><?= $TTHelper->getSiteLang('account.dispatched')?></p><span><?= $orderAllStatus['dispatched']?></span></li>
            <li><p><?= $TTHelper->getSiteLang('account.orderCancelled')?></p><span><?= $orderAllStatus['cancelled']?></span></li>
            <li><p><?= $TTHelper->getSiteLang('account.refunded')?></p><span><?= $orderAllStatus['refunded']?></span></li>
            <div class="clear"></div>
        </ul>
        <div class="xxkDiv">
            <ul class="blackXXKS lbUl">
                <li <?php if($_GET['status'] == ''):?>class="xxkActi"<?php endif;?>><a href="<?=Url::toRoute(['order/index']);?>"><?= $TTHelper->getSiteLang('common.myOrders')?>(<?= $orderAllStatus['all']?>)</a></li>
                <li <?php if($_GET['status'] == 1):?>class="xxkActi"<?php endif;?>><a href="<?=Url::toRoute(['order/index', 'status' => 1]);?>"><?= $TTHelper->getSiteLang('account.paymentPending')?>(<?= $orderAllStatus['pending']?>)</a></li>
                <li <?php if($_GET['status'] == 2):?>class="xxkActi"<?php endif;?>><a href="<?=Url::toRoute(['order/index', 'status' => 2]);?>"><?= $TTHelper->getSiteLang('account.paymentConfirmed')?>(<?= $orderAllStatus['confirmed']?>)</a></li>
                <li <?php if($_GET['status'] == 9):?>class="xxkActi"<?php endif;?>><a href="<?=Url::toRoute(['order/index', 'status' => 9]);?>"><?= $TTHelper->getSiteLang('account.processing')?>(<?= $orderAllStatus['processing']?>)</a></li>
            </ul>
            <form id="orderSearch" action="index.php" method="GET">
                <input type="hidden" name="r" value="account/myorder">
                <ul class="reviewTT_ul lbUl">
                    <li>
                        <select name="interval">
                            <option value="3" <?php if($_GET['interval'] == 3):?>selected<?php endif;?>><?= $TTHelper->getSiteLang('account.last3Months')?></option>
                            <option value="6" <?php if($_GET['interval'] == 6):?>selected<?php endif;?>><?= $TTHelper->getSiteLang('account.last6Months')?></option>
                            <option value="12" <?php if($_GET['interval'] == 12):?>selected<?php endif;?>><?= $TTHelper->getSiteLang('account.lastYear')?></option>
                            <option value="" <?php if($_GET['interval'] == ''):?>selected<?php endif;?>><?= $TTHelper->getSiteLang('account.allDate')?></option>
                        </select>
                    </li>
                    <li>
                        <select name="status">
                            <option value="" <?php if($_GET['status'] == 3):?>selected<?php endif;?>><?= $TTHelper->getSiteLang('account.orderStatus')?></option>
                            <option value="1" <?php if($_GET['status'] == 1):?>selected<?php endif;?>><?= $TTHelper->getSiteLang('account.paymentPending')?></option>
                            <option value="2" <?php if($_GET['status'] == 2):?>selected<?php endif;?>><?= $TTHelper->getSiteLang('account.paymentConfirmed')?></option>
                            <option value="3" <?php if($_GET['status'] == 3):?>selected<?php endif;?>><?= $TTHelper->getSiteLang('account.orderCancelled')?></option>
                            <option value="4" <?php if($_GET['status'] == 4):?>selected<?php endif;?>><?= $TTHelper->getSiteLang('account.processing')?></option>
                            <option value="6" <?php if($_GET['status'] == 6):?>selected<?php endif;?>><?= $TTHelper->getSiteLang('account.dispatched')?></option>
                            <option value="7" <?php if($_GET['status'] == 6):?>selected<?php endif;?>>Completed</option>
                            <option value="8" <?php if($_GET['status'] == 8):?>selected<?php endif;?>><?= $TTHelper->getSiteLang('account.refunded')?></option>
                        </select>
                    </li>
                    <li class="searchInp"><input type="text" name="productName" value="<?= trim($_GET['productName'])?>" placeholder="Product name" ><input class="orderSearch" type="submit" value="<?= $TTHelper->getSiteLang('home.search')?>"></li>
                    <div class="clear"></div>
                </ul>
            </form>
            <div class="xxkBOX boxRa block">
                <ul class="accOrdeTT">
                    <li class="details1"><?= $TTHelper->getSiteLang('account.orderDetails')?></li>
                    <li class="price2"><?= $TTHelper->getSiteLang('account.price')?></li>
                    <li class="qty3"><?= $TTHelper->getSiteLang('account.qty')?></li>
                    <li class="method4"><?= $TTHelper->getSiteLang('account.orderStatus')?></li>
                    <li class="status5"><?= $TTHelper->getSiteLang('account.trackingInfo')?></li>
                    <li class="options6"><?= $TTHelper->getSiteLang('account.options')?></li>
                </ul>
                <?php if($orderList):?>
                    <?php foreach ($orderList as $key => $value):?>
                        <table class="orderTab order-list-table <?= $value['order']['cordernumber']?>" width="100%" border="1" cellspacing="0" cellpadding="0" order-id="<?= $value['order']['cordernumber']?>">
                            <tr>
                                <td colspan="4" class="orderTabTT">
                                    <a class="rightThis" href="javascript:;"><span class="selected-tag"></span></a>
                                    <p><?= $TTHelper->getSiteLang('account.order No.')?> <b class="blue"><?= $value['order']['cordernumber']?></b></p>
                                    <p><?= $TTHelper->getSiteLang('account.orderDate')?>: <?= $value['order']['createDateStr']?></p>
                                    <p><?= $TTHelper->getSiteLang('account.total')?>: <b class="orange"><?= $value['currency']['csymbol'].$value['order']['fgrandtotalStr']?></b></p>
                                </td>
                            </tr>
                            <tr>
                                <td class="orderInfTD">
                                    <?php foreach ($value['orderItems'] as $k => $item):?>
                                        <ul class="orderInfUl">
                                            <li class="orderImg"><img src="<?= $TTHelper::getThumbnailUrl('product', $item['cimageurl'], 60, 60);?>"></li>
                                            <li class="orderInf">
                                                <a class="blue" href="<?= $TTHelper::getProductUrl($item['curl'])?>"><?= $item['ctitle']?></a>
                                                <p class="marT"><span>SKU: <?= $item['sku']?></span>
                                                    <?php foreach ($item['attributeMap'] as $attributeKey => $attributeValue):?>
                                                        <span><?= $attributeKey?>:<?= $attributeValue?></span>
                                                    <?php endforeach;?>
                                                </p>
                                            </li>
                                            <li class="pro_price">
                                                <em class="empty"></em>
                                                <?php
                                                //日元去小数
                                                if($value['currency']['iid'] == 4){
                                                    $item['unitPrice'] = intval($item['unitPrice']);
                                                }
                                                ?>
                                                <p class="newPrice"><?= $value['currency']['csymbol'] . $item['unitPrice']?></p>
                                            </li>
                                            <li class="pro_Nb"><?= $item['iqty']?></li>
                                            <div class="clear"></div>
                                        </ul>
                                    <?php endforeach;?>
                                </td>
                                <td class="orderLogo"><?= $value['orderStatus']?></td>
                                <td class="orderPro" valign="middle">
                                    <a class="orderMiddle" href="javascript:void(0);"><?= $value['trackingNumber']?></a>
                                </td>
                                <td class="orderView">
                                    <a class="blue" href="<?=Url::toRoute(['order/detail', 'orderNumber' => $value['order']['cordernumber']]);?>">View</a>
                                    <?php if($value['orderStatus'] == 'Payment Pending'):?>
                                        <a class="hsA" href="<?=Yii::$app->params['cartHost'];?>/checkout/retry/<?= $value['order']['cordernumber']?>">Pay Now</a>
                                    <?php endif;?>
                                    <a class="rubbish" href="javascript:void(0);"></a>
                                </td>
                            </tr>
                        </table>
                    <?php endforeach;?>
                    <ul class="orderAll_bot">
                        <li>
                            <a href="javascript:void(0);" class="rightAll"><span></span></a>
                            <a href="javascript:void(0);" class="delete"><p class="reMAll"><?= $TTHelper->getSiteLang('account.removeall')?></p>
                                <div class="point dialogss_main">
                                    <h3 class="point_title"><?= $TTHelper->getSiteLang('account.popover')?></h3>
                                    <p class="point_info"><?= $TTHelper->getSiteLang('account.oK')?>?</p>
                                    <div class="point_but">
                                        <button class="point_cancel others_close animate" type="button"><?= $TTHelper->getSiteLang('account.cancel')?></button>
                                        <button class="point_ok others_close animate deleteYes" type="button"><?= $TTHelper->getSiteLang('account.oK')?></button>
                                    </div>
                                    <i class="point_arrows"></i>
                                    <span class="dialogss_close point_code"></span>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <ul class="lbBox pagingWarp">
                        <?= $page->showpage();?>
                    </ul>
                <?php else:?>
                    <ul style="margin:10px;">*No Orders</ul>
                <?php endif;?>
            </div>
        </div>
    </div>
</section>