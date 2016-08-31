<?php
use common\components\AppAsset;
use common\widgets\AccountWidget;
use yii\helpers\Url;

$this->title ='My Order';
AppAsset::register($this, 'account');
$TTHelper = Yii::$container->get('TTHelper');
?>
<section class="contentInside accInside">
    <?= AccountWidget::widget([
        'displayCount'  => $page->total,
        'displayName'   => Yii::$app->controller->action->id,
    ]);?>


	<div class="accountRight lineBlock orderBox">

		<h6>Order Detail</h6>
		<ul class="detailTT">
			<li>orderNumber: <b class="blue"><?= $orderStatus;?></b></li>
		    <li>orderStatus>: <b class="blue"><?= $orderStatus;?></b></li>
		</ul>
		<ul class="orderStatus">
			<li class="statusAcc">
		    	<p>
		        	<span>orderSubmitted</span><br>
		            <?= $TTHelper::dateFormat($order['dcreatedate']);?>
		        </p>
		    </li>
		    <?php if($orderStatus == 'Payment Declined'):?>
			<li class="statusError">
		    	<ol></ol>
		    	<p>
		        	<span><?= $TTHelper->getSiteLang('account.paymentDeclined')?></span><br>
		            <?= $TTHelper::dateFormat($order['dpaymentdate']); ?>
		        </p>
		    </li>
		    <?php else:?>
		    <li <?php if($orderStatus == 'Payment Pending' || $orderStatus == 'Payment Processing' || $orderStatus == 'Payment Confirmed'):?>class="statusAcc"<?php endif;?>>
		    	<ol></ol>
		    	<p>
		        	<span><?= $orderStatus?></span><br>
		        	<?= date("m/j/Y g:i A",substr( $orderStatusHistoryMap[$orderStatus]['dcreatedate'],0,-3)); ?>
		        </p>
		    </li>
		    <?php endif;?>
			<li <?php if($orderStatus == 'On Hold' || $orderStatus == 'Processing'):?>class="statusAcc"<?php endif;?>>
		    	<ol></ol>
		    	<p>
		        	<span><?= $TTHelper->getSiteLang('account.orderProcessing')?></span><br>
		        	<?php if($orderStatus == 'On Hold' || $orderStatus == 'Processing'):?>
		            	<?= date("m/j/Y g:i A",substr( $orderStatusHistoryMap[$orderStatus]['dcreatedate'],0,-3)); ?>
		            <?php endif;?>
		        </p>
		    </li>
			<li <?php if($orderStatus == 'Dispatched'):?>class="statusAcc"<?php endif;?>>
		    	<ol></ol>
		    	<p>
		        	<span><?= $TTHelper->getSiteLang('account.shippied')?></span><br>
		        	<?php if($orderStatus == 'Dispatched'):?>
		            	<?= date("m/j/Y g:i A",substr( $orderStatusHistoryMap[$orderStatus]['dcreatedate'],0,-3)); ?>
		            <?php endif;?>
		        </p>
		    </li>
			<li <?php if($orderStatus == 'Completed'):?>class="statusAcc"<?php endif;?>>
		    	<ol></ol>
		    	<p>
		        	<span><?= $TTHelper->getSiteLang('account.completedOrders')?></span><br>
		            <?php if($orderStatus == 'Completed'):?>
		            	<?= date("m/j/Y g:i A",substr( $orderStatusHistoryMap[$orderStatus]['dcreatedate'],0,-3)); ?>
		            <?php endif;?>
		        </p>
		    </li>
		</ul>
		<table class="orderINFs" width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
		    <th><?= $TTHelper->getSiteLang('account.orderInformation')?></th>
		    <th></th>
		  </tr>
		  <tr>
		    <td></td>
		    <td></td>
		  </tr>
		  <tr>
		    <td>Customer Name:</td>
		    <td><?= $order['clastname']?> <?= $order['cfirstname']?></td>
		  </tr>
		  <tr>
		    <td>Shipping Address:</td>
		    <td><?= $order['clastname']?> <?= $order['cfirstname']?>,<?= $order['cstreetaddress']?>,<?= $order['ccity']?>,<?= $order['cprovince']?> <?= $order['cpostalcode']?>,<?= $order['ccountry']?></td>
		  </tr>
		  <tr>
		    <td>shippingMethod:</td>
		    <td><?= $shippingMethodInfo['title']?></td>
		  </tr>
		  <tr>
		    <td>trackNumber:</td>
		    <td><span class="blue trackNub"><?= $trackingNumber?></span></td>
		  </tr>
		  <tr>
		    <td>orderPlacedDate:</td>
		    <td><?= $order['createDateStr']?></td>
		  </tr>
		  <tr>
		    <td>shippedDate:</td>
		    <td><?php if($orderStatus == 'Dispatched'):?><?= date("m/j/Y g:i A",substr( $orderStatusHistoryMap[$orderStatus]['dcreatedate'],0,-3)); ?><?php endif;?></td>
		  </tr>
		  <tr>
		    <td>Your Message:</td>
		    <td><?= $order['cmessage']?></td>
		  </tr>
		  <tr>
		    <td></td>
		    <td></td>
		  </tr>
		</table>
		<table class="orderINFs" width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
		    <th>paymentInformation</th>
		    <th></th>
		  </tr>
		  <tr>
		    <td></td>
		    <td></td>
		  </tr>
		  <tr>
		    <td>paymentMethod:</td>
		    <td><?php if($order['cpaymenttype'] == 'paypal'):?><img src="icon/PayPal01.jpg"><?php endif;?><?= $order['cpaymenttype']?></td>
		  </tr>
		  <tr>
		    <td></td>
		    <td></td>
		  </tr>
		</table>
		<div class="shoppingCart_con">
			<div class="productOrTT">productInformation</div>
		    <table class="detailesTab" width="100%" border="0" cellspacing="0" cellpadding="0">
		      <tr>
		        <th class="itemTH">items</th>
		        <th class="descriptionTH">description</th>
		        <th class="priceTH">price</th>
		        <th class="quanTH">orderQuantity</th>
		        <th class="totalTH">total</th>
		        <th>review</th>
		      </tr>
		      <tr>
		        <td colspan="6">
		            <ul class="cartListUL oneS">
		                <?php foreach ($orderItems as $key => $item):?>
		                <li class="cartListLI">
		                    <a class="inBlock pro_img" href="<?= $TTHelper::urlRewrite($item['curl'],'product')?>"><img alt="<?= $item['ctitle']?>" src="<?= $TTHelper::getThumbnailUrl('product',$item['cimageurl'],60,60);?>"></a>
		                    <div class="inBlock pro_info">
		                        <a href="<?= $TTHelper::urlRewrite($item['curl'],'product')?>" title="<?= $item['ctitle']?>"><?= $item['ctitle']?></a>
		                        <p class="parameter"><span>SKU: <?= $item['sku']?></span>
		                        <?php foreach ($item['attributeMap'] as $k => $attr):?>
		                        	<span><?= $k?>:<?= $attr?></span>
		                        <?php endforeach;?>
		                        </p>
		                    </div>
		                    <div class="inBlock pro_price">
		                        <p class="newPrice"><?= $symbol?> <?= $item['unitPrice']?></p>
		                    </div>
		                    <ul class="qty_num inBlock">
		                        <li class="qty_nums"><?= $item['iqty']?></li>
		                    </ul>
		                    <span class="pro_total inBlock"><?= $symbol?> <?= $item['totalPrice']?></span>
		                    <?php if($orderStatus == 'Completed'):?>
		                    	<a class="orderReview" href="<?=Url::toRoute(['review/add', 'listingId' =>$item['clistingid'], 'oid'=>$order['iid']]);?>"><?= $TTHelper->getSiteLang('account.review')?></a>
		                    <?php endif;?>
		                </li>
		                <?php endforeach;?>
		            </ul>
		        </td>
		      </tr>
		    </table>
		    <table class="orderB_table">
		        <tr>
		        <td class="cart_bottom"></td>
		        <td align="right">
		            <table class="grandTotal" width="500" border="0" cellspacing="0" cellpadding="0">
		              <tr>
		                <td>orderSubtotal: </td>
		                <td width="105"><b><?= $symbol?> <?= $order['fordersubtotalStr']?></b></td>
		              </tr>
		              <?php if($order['fshippingprice']>0):?>
		              <tr>
		                <td class="airmailB">Shipping Cost:</td>
		                <td width="105"><b><?= $symbol?> <?= $order['fshippingprice']?></b></td>
		              </tr>
		              <?php endif;?>
		              <tr>
		                <td>discountTotal</td>
		                <td><span class="green"><?= $symbol?> <?= $order['fextra']?></span></td>
		              </tr>
		              <tr class="grandTotal_txt">
		                <td>grandTotal:</td>
		                <td><span class="orange"><?= $symbol?> <?= $order['fgrandtotalStr']?></span></td>
		              </tr>
		              <tr class="earned">
		                <td colspan="2">This order earned <?= $point?> CHICUU points</td>
		              </tr>
		            </table>
		        </td>
		      </tr>
		    </table>
		</div>
		<?php if($orderStatus == 'Payment Pending'):?>
		<div class="shoppingCart_con shoppingCart_conBT">
		    <table style="width:100%">
		          <tr class="Continue">
		            <td width="550"></td>
		            <td class="continusRe">
		                <p class="ContinueSpay"></a><input type="button" class="spayOut" onclick="javascript:window.location.href=<?php if ($order['istatus']==1):?>'https://cart.chicuu.com/checkout/retry/<?= $order['cordernumber']?>'<?php else:?>'#'<?php endif;?> " value="<?php if($order['istatus']==1):?>Pay Now<?php else:?>Proceed to checkout<?php endif;?>"></p>
			                <label><input class="agreeTT" type="checkbox" checked="checked"> I agree to the CHICUU <a href="/terms-conditions.html">Terms & Conditions.</a></label>
		                <p class="checkouts">Please review the chicuu.com Terms and Conditions and by clicking on 'I agree to the chicuu.com Terms and Policy' to continue checkout.</p>
		            </td>
		          </tr>
		    </table>
		    <div class="cart_bot">
		        <em></em><span><?= $TTHelper->getSiteLang('account.secureCheckout')?></span> <br><?= $TTHelper->getSiteLang('account.myOrderP1')?><i></i>
		    </div>
		</div>
		<?php endif;?>
	</div>
</section>