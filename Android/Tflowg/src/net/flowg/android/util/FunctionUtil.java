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
	 * ʱ���2date
	 * @param timestampString
	 * @return
	 */
	public static String timeStamp2Date(String timestampString){
		Long timestamp = Long.parseLong(timestampString)*1000;    
		String date = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss").format(new Date(timestamp));    
		return date; 
	}
	/**
	 * ȡ��ip
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
	 * ȥ���ı��ڲ�HTML��ǩ
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
        	String regEx_script = "<[\\s]*?script[^>]*?>[\\s\\S]*?<[\\s]*?\\/[\\s]*?script[\\s]*?>"; //����script��������ʽ{��<script[^>]*?>[\\s\\S]*?<\\/script> }   
        	String regEx_style = "<[\\s]*?style[^>]*?>[\\s\\S]*?<[\\s]*?\\/[\\s]*?style[\\s]*?>"; //����style��������ʽ{��<style[^>]*?>[\\s\\S]*?<\\/style> }   
            String regEx_html = "<[^>]+>"; //����HTML��ǩ��������ʽ   
            String regEx_html1 = "<[^>]+";   
            p_script = Pattern.compile(regEx_script,Pattern.CASE_INSENSITIVE);   
            m_script = p_script.matcher(htmlStr);   
            htmlStr = m_script.replaceAll(""); //����script��ǩ   

            p_style = Pattern.compile(regEx_style,Pattern.CASE_INSENSITIVE);   
            m_style = p_style.matcher(htmlStr);   
            htmlStr = m_style.replaceAll(""); //����style��ǩ   
          
            p_html = Pattern.compile(regEx_html,Pattern.CASE_INSENSITIVE);   
            m_html = p_html.matcher(htmlStr);   
            htmlStr = m_html.replaceAll(""); //����html��ǩ   
              
            p_html1 = Pattern.compile(regEx_html1,Pattern.CASE_INSENSITIVE);   
            m_html1 = p_html1.matcher(htmlStr);   
            htmlStr = m_html1.replaceAll(""); //����html��ǩ   
          
            textStr = htmlStr;   
        }catch(Exception e) {   
                 System.err.println("Html2Text: " + e.getMessage());   
        }   
       
        return textStr;//�����ı��ַ���   
	}   
	
	/**
	 * ͨ��URL��ȡͼ��
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
