<?php
	global $_W,$_GPC;
	if( $this->module['config']['isindexverify'] == 1 && $this->module['config']['isverify'] == 1 ){
		$userinfo = model_user::initUserInfo(); //用户信息
	}
	//$userinfo = model_user::initUserInfo(); //用户信息
	$_GPC['op'] = empty($_GPC['op'])?'index':$_GPC['op'];
	$_GPC['do'] = 'index';

	

	if($_GPC['op'] == 'index'){
		if(empty($_GPC['id'])){
			$page = model_custom::getIndexPage();
//            var_dump($page['params']);die;
		}else{
			$page = model_custom::getPage($_GPC['id']);
		}
			
		
		$share = json_decode($page['basicparams'],true);
		if(!empty($share)){	
			$sharedata = array(
				'title' => $share[0]['params']['title'],
				'desc' => $share[0]['params']['desc'],
				'link' => '',
				'imgUrl' => tomedia($this->module['config']['sharepic'])
			);			
		}else{
			echo '<p style="text-align: center;margin-top:20%">页面不存在</p>';die;
		}
	}
	


	$initParams = array(
		'do' => 'index',
		'op' => $_GPC['op'],
		'issetpage' => 1,
		'sharedata' => empty($sharedata) ? '""': $sharedata,
	);
	$title = $share[0]['params']['title'];
	

	include $this->template('index');
?>