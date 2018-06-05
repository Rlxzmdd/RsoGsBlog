<?php
namespace rsogsphp\base;

/**
 * 视图基类
 */
class View
{
    protected $variables = array();
    protected $_controller;
    protected $_action;

    function __construct($controller, $action)
    {
        $this->_controller = strtolower($controller);
        $this->_action = strtolower($action);
    }

    //得到一个页面数据
    public function getLayouts($layoutFiles)
    {
        extract($this->variables);
        $controllerLayout = APP_PATH . 'app/views/layouts/' . $this->_controller . '/' . $layoutFiles . '.php';
        //判断视图文件是否存在
        if (is_file($controllerLayout)) {
            return (require($controllerLayout));
        } else {
            return "<h1>这里发生了一个错误</h1>";
        }
    }
    // 分配变量
    public function assign($name, $value)
    {
        $this->variables[$name] = $value;
    }
    public function renderTop(){
		//将数组中的值转为变量
		$defaultStyle = '/static/assets/css/'.$this->_controller.'/'.'default.css';
		$controllerStyle = '/static/assets/css/'.$this->_controller.'/'.$this->_action.'.css';

		$this->assign('defaultStyle',$defaultStyle);
		$this->assign('controllerStyle',$controllerStyle);

		extract($this->variables);
		$defaultTop = APP_PATH . 'app/views/top.php';
		$controllerTop = APP_PATH . 'app/views/' . $this->_controller . '/top.php';
		// 页头文件
		if (is_file($controllerTop)) {
			include ($controllerTop);
		} else {
			include ($defaultTop);
		}
	}
	public function renderHeader(){

		//将数组中的值转为变量
		extract($this->variables);
		$defaultHeader = APP_PATH . 'app/views/header.php';
		$controllerHeader = APP_PATH . 'app/views/' . $this->_controller . '/header.php';
		// 导航栏文件
		if (is_file($controllerHeader)) {
			include ($controllerHeader);
		} else {
			include ($defaultHeader);
		}
	}
	public function renderView(){

		//将数组中的值转为变量
		extract($this->variables);
		$controllerLayout = APP_PATH . 'app/views/' . $this->_controller . '/' . $this->_action . '.php';

		//判断视图文件是否存在
		if (is_file($controllerLayout)) {
			include ($controllerLayout);
		} else {
			echo $controllerLayout;
			echo "<h1>这里发生了一个错误</h1>";
		}
	}
	public function renderLayout($layoutFiles){
		//将数组中的值转为变量
		extract($this->variables);
		$controllerLayout = APP_PATH . 'app/views/layouts/' . $this->_controller . '/' . $layoutFiles . '.php';
		//判断视图文件是否存在
		if (is_file($controllerLayout)) {
			return (require  ($controllerLayout));
		} else {
			echo "<h1>这里发生了一个错误</h1>";
		}
	}
	public function renderFooter(){
		//将数组中的值转为变量
		extract($this->variables);
		$defaultFooter = APP_PATH . 'app/views/footer.php';
		$controllerFooter = APP_PATH . 'app/views/' . $this->_controller . '/footer.php';
		// 页脚文件
		if (is_file($controllerFooter)) {
			include ($controllerFooter);
		} else {
			include ($defaultFooter);
		}
	}
    // 渲染显示
    public function render()
    {
    	$this->renderTop();
    	$this->renderHeader();
    	$this->renderView();
    	$this->renderFooter();
    }
}
