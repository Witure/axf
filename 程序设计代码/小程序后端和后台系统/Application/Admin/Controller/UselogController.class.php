<?php
//命名空间
namespace Admin\Controller;
//引入父类
use Think\Controller;
//声明类并且继承父类
class UselogController extends Controller{
	public function showList(){
		//模型实例化
		$model = M('Uselog');
		//联表查询
		$data = $model -> field('t1.*,t2.name as name') -> alias('t1') -> join('left join user as t2 on t1.openid = t2.openid') -> select();
		//分页第一步：查询总的记录数
		$count = $model -> count();
		//分页第二步：实例化分页类，传递参数
		$page = new \Think\Page($count,15);	//每页显示1个
		//分页第三步：可选步骤，定义提示文字
		$page -> rollPage = 5;
		$page -> lastSuffix = false;
		$page -> setConfig('prev','上一页');
		$page -> setConfig('next','下一页');
		$page -> setConfig('last','末页');
		$page -> setConfig('first','首页');
		//分页第四步：使用show方法生成url
		$show = $page -> show();
		//分页第五步：展示数据
		$data = $model -> limit($page -> firstRow,$page -> listRows) -> select();

		foreach ($data as $k => $value) {

				foreach ($value as $re) {

					$res['hour']= floor($re/3600);
		 			$res['min']= floor(($re - $res['hour'] * 3600)/60);
		 			$res['second']= floor((($re-3600 * $res['hour']) - 60 * $res['min']) % 60); 
					$ltime = $res['hour'] . '时' . $res['min'] . '分' . $res['second'] . '秒';
				}
				$value['length'] = $ltime;
				$data[$k] = $value;
				//$this -> assign('value',$value);
			//dump($value);
		}
		//dump($data);die;
 		
		//分页第六步：传递给模版
		$this -> assign('data',$data);
		$this -> assign('show',$show);
		//分页第七步：展示模版
		$this -> display();







	}
	public function del(){
		//接收参数
		$id = I('get.id');
		//模型实例化
		$model = M('Uselog');
		//删除
		$result = $model -> delete($id);
		//判断结果
		if($result){
			//删除成功
			$this -> success('删除成功！',U('showList'),3);
		}else{
			//删除失败
			$this -> error('删除失败！');
		}
	}
}