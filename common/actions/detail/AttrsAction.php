<?php
/*
* 详情页属性相关action
*
*/
namespace common\actions\detail;

use Yii;
use common\components\AppAction;

class AttrsAction extends AppAction
{
	/**
	* 运行action
	*
	* @param array $params
	* $params['pdbList'] array 商品列表
	* $params['attributeMap'] array 属性列表
	*
	* @return string
	*/
	public function run($params)
	{
		return $this->renderPartial(
									'detail/attrs',
									['productAttrs' => $this->getProductAttrs($params['pdbList'], $params['attributeMap'])]
								);
	}

	 /**
     * 获取商品所有的属性
     * 
     * @param    array $products
     * @param    array $defaultAttrs
     * @return array $attrs
     */
    public function getProductAttrs($products, $defaultAttrs)
    {
        $attrs = array();
        foreach($products as $product) 
        {
            if(isset($product['attributeMap']))
            {
                foreach ($product['attributeMap'] as $key => $value) 
                {
                    $key = trim($key);
                    $value = trim($value);
                    !array_key_exists($key, $attrs) && $attrs[$key] = array();
                    !array_key_exists($value, $attrs[$key]) && $attrs[$key][$value] = array('default' => 0, 'value' => $value);
                    if($key == 'color')
                    {
                        if(isset($product['imgList']) && !empty($product['imgList']))
                        {
                            foreach ($product['imgList'] as $img) 
                            {
                                if($img['isMain'] == 1)
                                {
                                    $attrs[$key][$value]['value'] = $img['imgUrl'];
                                    break;
                                }
                            }
                        }
                    }
                }
            }
        }

        //为属性选择默认值
        foreach ($defaultAttrs as $key => $val) 
        {
            isset($attrs[$key][$val]) && $attrs[$key][$val]['default'] = 1;
        }

        //为size属性排序
        array_key_exists('size', $attrs) && $attrs['size'] = $this->sortSizeAttrs($attrs['size'],'attrSizeSort');
        
        //为内存属性排序
        array_key_exists('capacity', $attrs) && $attrs['capacity'] = $this->sortSizeAttrs($attrs['capacity'],'attrMemorySort');
        
        //调整color属性到第一个
        array_key_exists('color', $attrs) && $attrs = $this->sortColorAttr($attrs);
        
        return $attrs;
    }

    /**
     * 为size属性进行排序
     * 
     * @param    array $sizeAttrs
     * @return array $sizeAttrs
     */
    public function sortSizeAttrs($sizeAttrs,$attrKeyName)
    {
        $sortSizeLists = Yii::$app->params[$attrKeyName];
        $sizeToSort = array_flip($sortSizeLists); 
        $maxSortNum = count($sortSizeLists) + 1;

        $sort = array();
        $count = 0;
        foreach ($sizeAttrs as $key => $val) 
        {
            $key = strtoupper(trim($key));
            if(isset($sizeToSort[$key]))
            {
                $sort[] = $sizeToSort[$key];
            }
            else
            {
                $sort[] = $maxSortNum + $count;
                $count += 1;
            }
        }
        array_multisort($sort, SORT_ASC, SORT_NUMERIC, $sizeAttrs);
        return $sizeAttrs;
    }

    /**
     * 将color属性调整至第一
     * 
     * @param    array $attrs
     * @return array $attrs 调整后的属性排序
     */
    public function sortColorAttr($attrs)
    {
        $count = 1;
        $sort = array();
        foreach ($attrs as $key => $attr) 
        {
            $key = trim($key);
            $sort[] =  ($key == 'color' ? 0 : $count);
            $count++;
        }
        array_multisort($sort, SORT_ASC, SORT_NUMERIC, $attrs);
        return $attrs;
    }
}