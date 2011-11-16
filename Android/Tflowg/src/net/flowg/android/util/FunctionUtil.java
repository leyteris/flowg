package net.flowg.android.util;

import java.io.IOException;
import java.io.InputStream;
import java.net.InetAddress;
import java.net.MalformedURLException;
import java.net.NetworkInterface;
import java.net.SocketException;
import java.net.URL;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.Enumeration;
import java.util.regex.Pattern;

import android.graphics.drawable.Drawable;
import android.util.Log;

public class FunctionUtil {
	
	/**
	 * 时间戳2date
	 * @param timestampString
	 * @return
	 */
	public static String timeStamp2Date(String timestampString){
		Long timestamp = Long.parseLong(timestampString)*1000;    
		String date = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss").format(new Date(timestamp));    
		return date; 
	}
	/**
	 * 取得ip
	 * @param inputString
	 * @return
	 */
	public static String getLocalIpAddress() {  
	    try {  
	        for (Enumeration<NetworkInterface> en = NetworkInterface.getNetworkInterfaces(); en.hasMoreElements();) {  
	            NetworkInterface intf = en.nextElement();  
	            for (Enumeration<InetAddress> enumIpAddr = intf.getInetAddresses(); enumIpAddr.hasMoreElements();) {  
	                InetAddress inetAddress = enumIpAddr.nextElement();  
	                if (!inetAddress.isLoopbackAddress()) {  
	                    return inetAddress.getHostAddress().toString();  
	                }  
	            }  
	        }  
	    } catch (SocketException ex) {  
	        Log.e("error", ex.toString());  
	    }  
	    return null;  
	} 
	/**
	 * 去除文本内部HTML标签
	 * @param inputString
	 * @return
	 */
	public static String Html2Text(String inputString) {   
		
        String htmlStr = inputString;
        String textStr ="";   
        java.util.regex.Pattern p_script;   
        java.util.regex.Matcher m_script;   
        java.util.regex.Pattern p_style;   
        java.util.regex.Matcher m_style;   
        java.util.regex.Pattern p_html;   
        java.util.regex.Matcher m_html;   
          
        java.util.regex.Pattern p_html1;   
        java.util.regex.Matcher m_html1;   
       
        try {   
        	String regEx_script = "<[\\s]*?script[^>]*?>[\\s\\S]*?<[\\s]*?\\/[\\s]*?script[\\s]*?>"; //定义script的正则表达式{或<script[^>]*?>[\\s\\S]*?<\\/script> }   
        	String regEx_style = "<[\\s]*?style[^>]*?>[\\s\\S]*?<[\\s]*?\\/[\\s]*?style[\\s]*?>"; //定义style的正则表达式{或<style[^>]*?>[\\s\\S]*?<\\/style> }   
            String regEx_html = "<[^>]+>"; //定义HTML标签的正则表达式   
            String regEx_html1 = "<[^>]+";   
            p_script = Pattern.compile(regEx_script,Pattern.CASE_INSENSITIVE);   
            m_script = p_script.matcher(htmlStr);   
            htmlStr = m_script.replaceAll(""); //过滤script标签   

            p_style = Pattern.compile(regEx_style,Pattern.CASE_INSENSITIVE);   
            m_style = p_style.matcher(htmlStr);   
            htmlStr = m_style.replaceAll(""); //过滤style标签   
          
            p_html = Pattern.compile(regEx_html,Pattern.CASE_INSENSITIVE);   
            m_html = p_html.matcher(htmlStr);   
            htmlStr = m_html.replaceAll(""); //过滤html标签   
              
            p_html1 = Pattern.compile(regEx_html1,Pattern.CASE_INSENSITIVE);   
            m_html1 = p_html1.matcher(htmlStr);   
            htmlStr = m_html1.replaceAll(""); //过滤html标签   
          
            textStr = htmlStr;   
        }catch(Exception e) {   
                 System.err.println("Html2Text: " + e.getMessage());   
        }   
       
        return textStr;//返回文本字符串   
	}   
	
	/**
	 * 通过URL获取图像
	 * @param url
	 * @return
	 */ 
    public static Drawable getImageFromUrl(String url){
        URL m;
        InputStream i = null;
        try {
            m = new URL(url);
            i = (InputStream) m.getContent();
        } catch (MalformedURLException e1) {
            e1.printStackTrace();
        } catch (IOException e) {
            e.printStackTrace();
        }
        Drawable d = Drawable.createFromStream(i, "src");
        return d;
    }
}
