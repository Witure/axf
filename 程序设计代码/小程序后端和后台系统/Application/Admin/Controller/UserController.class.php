<?php
//命名空间
namespace Admin\Controller;
//引入父类
use Think\Controller;
//声明类并且继承父类
class UserController extends Controller{

	public  function code(){

			$aa = '3' .'B'.'001';

		//dump($data);die;
			if($aa){
					
						//在预约期限内
						//echo 1; die;
					header("Content-Type: text/html;charset=utf-8"); 
		    		//引入二维码生成插件
		    		vendor("phpqrcode.phpqrcode");
		    		// 生成的二维码所在目录+文件名 
		    		$path = "./Uploads/QRcode/";//生成的二维码所在目录
		       		if(!file_exists($path)){   
		           		mkdir($path, 0700,true);
		       		}
		       		$ptime = time().'.png';//生成的二维码文件名
		       		$fileName = $path.$openid . $ptime;//1.拼装生成的二维码文件路径

		     		  $data = $aa;//2.生成二维码的数据(扫码显示该数据)

		     		  $level = 'L';  //3.纠错级别：L、M、Q、H  

		     		  $size = 10;//4.点的大小：1到10,用于手机端4就可以了 

		      		 ob_end_clean();//清空缓冲区
		      		 \QRcode::png($data, $fileName, $level, $size);//生成二维码
		      		 //echo $fileName;
		      		 $newstr = substr($fileName,1,strlen($fileName)-1); 
						//echo $newstr; 
		      		$codepath = 'http://qtmami.com/tsg' . $newstr;

		     		
		     		  
				    
			
			}
			dump($data);
			
		
	}
	//showList
	public function showList(){
		//模型实例化
		$model = M('User');
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
			$model = M('User');
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
			$model = M('User');
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
			$model = M('User');
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
		$model = M('User');
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