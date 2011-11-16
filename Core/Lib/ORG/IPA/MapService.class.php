<?php
/**
 * Google Map Service
 * 2011.4.8
 */
import("ORG.IPA.IpLocation");
class mapService{
	
	public static function getIPaddress($ip){
		
	//返回格式
	$format = "text";//默认text,json,xml,js
	//返回编码
	$charset = "utf8"; //默认utf-8,gbk或gb2312
	$ip_l=new IpLocation();
	$address=$ip_l->getaddress($ip);
	$address["area1"] = iconv('GB2312','utf-8',$address["area1"]);
	$address["area2"] = iconv('GB2312','utf-8',$address["area2"]);
	$add=$address["area1"].$address["area2"];
	if($add=="本机地址 "){
		$add="浙江省杭州市下沙区";
	}
	
	return  $add;
	}
}