<?php
/**
 * @desc 自定义帮助类
 */
namespace common\helpers;

use Yii;
use common\components\AppHelper;

class TTPageHelper extends AppHelper
{
	/**
	* @var int $total 总记录
	*/
	protected $total;

	/**
	* @var int $pageSize 每页显示多少条
	*/
	protected $pageSize;  	//每页显示多少条

	/**
	* @var int $page 当前页码
	*/
	protected $page;

	/**
	* @var int $pageNum 总页码
	*/
	protected $pageNum;

	/**
	* @var string $url 地址
	*/
	protected $url;

	/**
	* @var int $bothNum 两边保持数字分页的量
	*/
	protected $bothNum;

	
	/**
	* 构造函数
	* 
	* @param int $total 总数
	* @param int $page 当前页
	* @param int $pageSize 每页条数
	*/
	public function __construct($total, $pageSize, $page = 1)
	{
		$this->total = $total ? $total : 1;
		$this->pageSize = $pageSize;
		$this->pageNum = ceil($this->total / $this->pageSize);
		$this->page = $page;
		$this->url = $this->_getUrl();
		$this->bothNum = 2;
	}

	/**
	* 拦截器
	* 
	* @param sting $key 键名
	*/
	public function __get($key) 
	{
		return $this->{$key};
	}


	/**
	* 获取当前url
	* 
	* @return string $page
	*/
	private function _getUrl() 
	{
		$_url = $_SERVER["REQUEST_URI"];
		$_par = parse_url($_url);
		if (isset($_par['query']))
		{
			parse_str($_par['query'], $_query);
			foreach ($_query as $key => $item)
			{
				if($key=='p'||$item=='')
				{
					unset($_query[$key]);
				}
			}
			$_url = $_par['path'] . '?' . http_build_query($_query);
		}
		return $_url;
	}  	
	
	/**
	* 页码列表
	* 
	* @return string $pageList
	*/
	private function _getPageList() 
	{
		$_pagelist = '<li class="lineBlock pageLink">';
		for ($i = $this->bothNum; $i >= 1; $i--) 
		{
			$_page = $this->page-$i;
			if ($_page < 1) continue;
			$_pagelist .= ' <a class="lineBlock" href="' . $this->url . '&p=' . $_page . '">' . $_page . '</a> ';
		}
		$_pagelist .= ' <a class="lineBlock active">' . $this->page . '</a> ';
		for ($i = 1; $i <= $this->bothNum; $i++) 
		{
	 		$_page = $this->page + $i;
			if($_page > $this->pageNum) break;
			$_pagelist .= ' <a class="lineBlock" href="' . $this->url . '&p=' . $_page . '">' . $_page . '</a> ';
		}
		if(!strstr($_pagelist,'?'))
		{
			$_pagelist = str_replace('&', '?', $_pagelist);
		}
		if(strstr($_pagelist, '?&'))
		{
			$_pagelist = str_replace('?&', '?', $_pagelist);
		}
		$_pagelist .= '</li>';
		return $_pagelist;
	}

	/**
	* 首页DOM
	* 
	* @return string $html
	*/
	private function _getFirst() 
	{
		if ($this->page > $this->bothNum + 1) 
		{
			$url = explode('?', $this->url);
			if($url[1] == '')
			{
				$this->url = str_replace('?', '', $this->url);
			}
			return '<li class="lineBlock pageLink"> <a class="lineBlock" href="' . $this->url . '">1</a> ...</li>';
		}
	}

	/**
	* 上一页DOM
	* 
	* @return string $html
	*/
	private function _getPrev() 
	{
		if ($this->page == 1) 
		{
			return '<li class="lineBlock pageP"><i class="icon-pageP"> </i>Previous Page</li>';
		}
		$previousPage = '<li class="lineBlock pageP pageClick"><i class="icon-pageP"> </i><a class="lineBlock" href="'.$this->url.'&p='.($this->page-1).'">Previous Page</a></li>';
		if(strstr($previousPage, '?&'))
		{
			$previousPage = str_replace('?&', '?', $previousPage);
		}
		return $previousPage;
	}

	/**
	* 下一页DOM
	* 
	* @return string $html
	*/
	private function _getNext() 
	{
		if ($this->page >= $this->pageNum)
		{
			return '<li class="lineBlock pageN">Next Page<i class="icon-pageN"> </i></li>';
		}
		$nextPage = '<li class="lineBlock pageN pageClick"><a class="lineBlock" href="' .$this->url.'&p='.($this->page+1).'">Next Page<i class="icon-pageN"> </i></a></li>';
		if(!strstr($nextPage,'?'))
		{
			$nextPage = str_replace('&','?',$nextPage);
		}
		return $nextPage;
	}

	/**
	* 尾页DOM
	* 
	* @return string $html
	*/
	private function _getLast() 
	{
		if ($this->pageNum - $this->page > $this->bothNum) 
		{
			$lastPage = '<li class="lineBlock pageLink"> ...<a class="lineBlock" href="' . $this->url . '&p=' . $this->pageNum . '">' . $this->pageNum . '</a></li>';
			if(!strstr($lastPage, '?'))
			{
				$lastPage = str_replace('&', '?', $lastPage);
			}
			return $lastPage;
			
		}
	}

	/**
	* 显示分页信息
	* 
	* @return string $html
	*/
	public function showpage() {
		$_page = $this->_getPrev();
		$_page .= $this->_getFirst();
		$_page .= $this->_getPageList();
		$_page .= $this->_getLast();
		$_page .= $this->_getNext();
		return $_page;
	}
}