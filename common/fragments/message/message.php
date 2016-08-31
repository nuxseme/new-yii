<?php
$TTHelper = Yii::$container->get('TTHelper');
?>
<div class="accountRight accouMessageBox lineBlock">
    <h6><?= $TTHelper->getSiteLang('account.myMessage')?></h6>
    <div class="xxkDiv">
        <ul class="blackXXK lbUl">
            <li class="xxkActi inboxN_click"><?= $TTHelper->getSiteLang('account.inbox')?></li>
            <li class="Recycle">
                <a class="lineBlock read_accDh" href="javascript:void(0);"><em></em><?= $TTHelper->getSiteLang('account.read')?></a>
                <a class="lineBlock delete_accDh" href="javascript:void(0);"><em></em><?= $TTHelper->getSiteLang('account.delete')?></a>
            </li>
        </ul>
        <div class="block">
            <table class="messageTable" width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <th><a href="javascript:void(0);" class="rightAll"><span class=""></span></a></th>
                    <th><?= $TTHelper->getSiteLang('account.from')?></th>
                    <th><?= $TTHelper->getSiteLang('account.subject')?></th>
                    <th><?= $TTHelper->getSiteLang('account.date')?></th>
                </tr>
                <?php
                if($list):
                    foreach ($list as $key => $value):
                        ?>
                        <tr class="tr-list <?php if($value['status'] == 1):?>aNormal<?php endif;?>" data="id=<?=$value['id']?>&t=<?=$value['tab']?>">
                            <td><a href="javascript:void(0);" class="rightThis"><span class="select-bar"></span></a></td>
                            <td><?=$value['from']?></td>
                            <td><a class="aBold" href="<?=Url::toRoute(['account/mdetails', 'id' => $value['id'], 'status' =>$value['status'], 'tab' => $value['tab'] ]);?>"><?=$value['subject']?></a></td>
                            <td><?= date('Y-m-d H:i:s', substr($value['createDate'], 0, -3))?></td>
                        </tr>
                        <?php
                    endforeach;
                else:
                    ?>
                    <tr class="tr-list">
                        <td colspan="4" align="center"><?= $TTHelper->getSiteLang('account.noMessage')?></td>
                    </tr>
                <?php endif;?>
            </table>
            <?php if($list):?>
                <ul class="lbBox pagingWarp">
                    <?=$pages?>
                </ul>
            <?php endif;?>
        </div>
    </div>
</div>