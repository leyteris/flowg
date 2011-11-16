package net.flowg.android;

import org.phprpc.PHPRPC_Client;

import android.app.Activity;
import android.view.Menu;
import android.view.MenuItem;

public class CommonActivity extends Activity {
	
	protected static final String SERVICE_URL = "http://10.0.2.2/tflowg/service.php";
	private static final int INDEX = 1;
	private static final int MENTION = 2;
	private static final int UPDATE = 3;
	private static final int ABOUT = 4;
	
	protected String source;
	protected PHPRPC_Client client;

	public boolean onCreateOptionsMenu(Menu menu) {

    	menu.add(0, INDEX, 1, R.string.topiclist_index);
    	menu.add(0, MENTION, 2, R.string.topiclist_mention);
    	menu.add(0, UPDATE, 3, R.string.topiclist_update);
    	menu.add(0, ABOUT, 4, R.string.topiclist_about);
		return super.onCreateOptionsMenu(menu);
	}
	
	public boolean onOptionsItemSelected(MenuItem item) {
		
		int itemNum = item.getItemId();
		if(itemNum == INDEX){
			//�û�����˸����б�ť
		}else if(itemNum == MENTION){
			//�û�����˹��ڰ�ť
		}else if(itemNum == UPDATE){
			//�û�����˹��ڰ�ť
		}else if(itemNum == ABOUT){
			//�û�����˹��ڰ�ť
		}
		return super.onOptionsItemSelected(item);
	}
	
	protected void onDestroy() {
		super.onDestroy();
		//System.exit(0);
		android.os.Process.killProcess(android.os.Process.myPid()); 
	}
}
