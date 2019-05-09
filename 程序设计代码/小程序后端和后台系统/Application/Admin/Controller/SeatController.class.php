<?php
//命名空间
namespace Admin\Controller;
//引入父类
use Think\Controller;
//声明类并且继承父类
class SeatController extends Controller{
	public function showList(){
		//模型实例化
		$model = M('Seat');
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
		//分页第六步：传递给模版
		$this -> assign('data',$data);
		$this -> assign('show',$show);
		//分页第七步：展示模版
		$this -> display();
	}
	public function add(){
		//判断请求类型
		if(IS_POST){
			//处理表单提交
			$model = M('Seat');
			//创建数据对象
			$data = $model -> create();
			//添加时间字段
			$data['addtime'] = time();
			//保存数据表
			$result = $model -> add($data);
			//判断是否保存成功
			if($result){
				//成功
				$this -> success('添加成功！',U('showList'),3);
			}else{
				//失败
				$this -> error('添加失败！');
			}
		}else{
			//分配到模版
			$this -> assign('data',$data);
			//展示模版
			$this -> display();
		}
	}
	public function edit(){
		if(IS_POST){
			//处理post请求
			$post = I('post.');
			//实例化
			$model = M('Seat');
			//保存操作
			$result = $model -> save($post);
			//判断结果成功与否
			if($result !== false){
				//修改成功
				$this -> success('修改成功',U('showList'),3);
			}else{
				//修改失败
				$this -> error('修改失败');
			}
		}else{
			//接收id
			$id = I('get.id');
			//实例化模型
			$model = M('Seat');
			//查询id
			$data = $model -> find($id);
			//变量分配
			$this -> assign('data',$data);
			//展示模版
			$this -> display();
		}
	}
	public function del(){
		//接收参数
		$id = I('get.id');
		//模型实例化
		$model = M('Seat');
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