<?php
namespace rsogsphp\base;

/**
 * 控制器基类
 */
class Controller
{
    protected $_controller;
    protected $_action;
    protected $_view;

    // 构造函数，初始化属性，并实例化对应模型
    public function __construct($controller, $action)
    {
        $this->_controller = $controller;
        $this->_action = $action;
        $this->_view = new View($controller, $action);
    }

    // 分配变量
    public function assign($name, $value)
    {
        $this->_view->assign($name, $value);
    }

    // 渲染视图
    public function render()
    {
		$this->renderTop();
		$this->renderHeader();
		$this->renderView();
		$this->renderFooter();
    }
    public function renderView(){
    	$this->_view->renderView();
	}
	public function renderTop(){
		$this->_view->renderTop();
	}
	public function renderHeader(){
		$this->_view->renderHeader();
	}
	public function renderLayout($layoutFile){
		return ($this->_view->renderLayout($layoutFile));
	}
	public function renderFooter(){
		$this->_view->renderFooter();
	}

    public function getLayouts($layoutFile)
    {
        return ($this->_view->getLayouts($layoutFile));
    }
}