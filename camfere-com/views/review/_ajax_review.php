
<form action="/index.php?r=review/write" id="editReviewInfo" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="commentid" value="<?= $reviewdetail['commentid']?>">
    <input type="hidden" name="listingId" value="<?= $reviewdetail['listingId']?>">
    <input type="hidden" name="sku" value="<?= $reviewdetail['sku']?>">
	<input type="hidden" name="commentPhotosUrl" value="<?= $reviewdetail['commentPhotosUrl']?>">
	<div class="writeReview_right">
        <h5>Write a review  <span>(*Indicates required fields)</span></h5>
        <hr>
        <table class="writeInp" width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td colspan="2">
            <ul class="startUL">
                <li class="startTxt">Price:</li>
                <li class="startEdi">
                	<input type="hidden" name="ipriceStarWidth" value="<?= $reviewdetail['ipriceStarWidth']?>" />
                    <div class="product_Reviews start<?= $reviewdetail['ipriceStarWidth']?>" id="ipriceStarWidth">
                        <em class="starOne"></em>
                        <em class="starTwo"></em>
                        <em class="starThree"></em>
                        <em class="starFour"></em>
                        <em class="starFive"></em>
                    </div> 
                </li>
                <li class="startTxt">Quality:</li>
                <li class="startEdi">
                	<input type="hidden" name="iqualityStarWidth" value="<?= $reviewdetail['iqualityStarWidth']?>" />
                    <div class="product_Reviews start<?= $reviewdetail['iqualityStarWidth']?>" id="iqualityStarWidth">
                        <em class="starOne"></em>
                        <em class="starTwo"></em>
                        <em class="starThree"></em>
                        <em class="starFour"></em>
                        <em class="starFive"></em>
                    </div> 
                </li>
                <li class="startTxt">Usefulness:</li>
                <li class="startEdi">
                	<input type="hidden" name="iusefulness" value="<?= $reviewdetail['iusefulness']?>" />
                    <div class="product_Reviews start<?= $reviewdetail['iusefulness']?>" id="iusefulness">
                        <em class="starOne"></em>
                        <em class="starTwo"></em>
                        <em class="starThree"></em>
                        <em class="starFour"></em>
                        <em class="starFive"></em>
                    </div> 
                </li>
                <li class="startTxt">Shipping:</li>
                <li class="startEdi">
                	<input type="hidden" name="ishippingStarWidth" value="<?= $reviewdetail['ishippingStarWidth']?>" />
                    <div class="product_Reviews start<?= $reviewdetail['ishippingStarWidth']?>" id="ishippingStarWidth">
                        <em class="starOne"></em>
                        <em class="starTwo"></em>
                        <em class="starThree"></em>
                        <em class="starFour"></em>
                        <em class="starFive"></em>
                    </div> 
                </li>
                <li class="startTxt startAll">Overall Rating:</li>
                <li class="startAll">
                    <div class="product_Reviews">
                        <input name="foverallratingStarWidth" type="hidden" value="<?=$reviewdetail['foverallratingStarWidth']?>">
                        <div id="foverallratingStarWidth" class="product_Start" style="width:<?=$reviewdetail['foverallratingStarWidth']*20?>%"></div>
                    </div> 
                </li>
            </ul>
            </td>
          </tr>
          <tr>
            <td valign="top">Reviews:<span class="read">*</span></td>
            <td><textarea id="ccomment" name="ccomment" autocomplete="off"><?=$reviewdetail['ccomment']?></textarea></td>
          </tr>
        </table>
        <h5>Upload Pictures</h5>
        <hr>
        <ul class="addPic_Box lbBox" id="result">
            <li class="addPic lineBlock add-pic-btn" id="addPic"></li>
            <?php 
            if($reviewdetail['commentPhotosUrl']):
                foreach ($reviewdetail['commentPhotosUrl'] as $key => $value):
            ?>
            <li class="lineBlock exist-img" style="height:138px;"><img src="<?=$value;?>"><input type="hidden" name="existPic[]" value="<?=$value;?>"></input><div class="deleteAddPic-after" style="position: absolute;right: -8px;top: -8px;width: 20px;text-align:center;line-height:20px;height: 20px;background-color: rgba(0,0,0,.7);border-radius: 20px;color: #fff;cursor: pointer;">X</div></li>
            <?php 
                endforeach;
                endif;
            ?>
        </ul>
        <table class="upFilePV" width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td>&nbsp;</td>
            <td>Max 5 images, 5MB per image，Format: jpeg/jpg/gif/png/bmp Clear photos are much appreciated!</td>
          </tr>
          <tr class="upF_pdT">
            <td>Video:</td>
            <td><input id="commentVideoUrl" type="text" name="commentVideoUrl" autocomplete="off" placeholder="Paste Your YouTube Video URL" value="<?=$reviewdetail['commentVideoUrl']?>"></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>Share a video with your review, please make sure your video is related to the product </td>
          </tr>
          <tr class="upF_pdT">
            <td>Video Title:</td>
            <td><input id="videoTitle" type="text" name="videoTitle" value="<?=$reviewdetail['videoTitle']?>" autocomplete="off"></td>
          </tr>
          <tr class="upF_last">
            <td>&nbsp;</td>
            <td>
                <input class="closePP hsInput" type="button" value="Cancel">
                <input class="closePP yellowInput" type="submit" value="Submit">
            </td>
          </tr>
        </table>
	</div>
</form>


<script type="text/javascript">
    var modules = '<li class="lineBlock" style="height:138px;display:none"><img><input type="file" name="files[]" style="display:none"><div class="deleteAddPic-after" style="position: absolute;right: -8px;top: -8px;width: 20px;text-align:center;line-height:20px;height: 20px;background-color: rgba(0,0,0,.7);border-radius: 20px;color: #fff;cursor: pointer;">X</div></li>';
    var box = $('.addPic_Box');
    //点击选择
    $('#addPic').click(function(){
        if ($(this).siblings('li').length < 4) 
        {
            box.append(modules);
            var files = box.find('li input[type="file"]');
            for (var i = 0; i < files.length; i++) {
                if (!files.eq(i).val()) 
                {
                   files.eq(i).click();break; 
                }
            }
        }
    })
    //选择后
    $(document).on('change','.addPic_Box input[type="file"]', function(event){
        var files = event.target.files; 
        if (files && files.length > 0) {
            file = files[0];
            var URL = window.URL || window.webkitURL;
            var imgURL = URL.createObjectURL(file);
            $(this).siblings('img').attr('src', imgURL);
            $(this).parent('li').show();
        }        
    })
    //删除图片
    $(document).on('click','.deleteAddPic-after',function(){
        $(this).parents('li').remove();
    })
</script>