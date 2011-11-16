package net.flowg.android;

import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.os.Message;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

public class PostActivity extends CommonActivity {
	
	private EditText postEt;
    private Button postBtn;
    private Button closeBtn;
    private ShareContext shareContext;

	public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.post);
        this.setTitle("Flowg微博 - 发布微博");
		
		shareContext = ((ShareContext)getApplicationContext());
    	client = shareContext.getClient();
    	source = shareContext.getSource();
        
    	client.useService(SERVICE_URL);
        postEt = (EditText)findViewById(R.id.postEditText);
        postBtn = (Button)findViewById(R.id.postBtn);
        closeBtn =  (Button)findViewById(R.id.closeBtn);
        postBtn.setOnClickListener(new PostBtnOnclickListener());
        
        closeBtn.setOnClickListener(new OnClickListener(){
			public void onClick(View v) {
				
				Intent it = new Intent();
				it.setClass(PostActivity.this,HomeListActivity.class);
				PostActivity.this.startActivity(it);
				
			}
		});

    }
	
	class PostBtnOnclickListener implements OnClickListener {

		public void onClick(View v) {

			Log.v("source0",shareContext.getSource());
			Log.v("source0",shareContext.getClient().toString());
			
			if(client == null || source == null){
				Log.e("flowg_error", "source or client not find!");
	        	Toast.makeText(getApplicationContext(), "验证错误",Toast.LENGTH_SHORT).show();
			}
			//String postEtStr = postEt.getText().toString();
			
			//Object s = client.invoke("update", new Object[]{source,postEtStr});

			//Object s = client.invoke("home_timeline", new Object[]{source,0,20});
			//Log.v("source0",s.toString());
			//Toast.makeText(getApplicationContext(), "发布成功",Toast.LENGTH_SHORT).show();
				
			updateHandler.post(updateThread);
		}
    	
    }
	
    Handler updateHandler = new Handler(){

		@Override
		public void handleMessage(Message msg) {
			if(msg.arg1 == 1){
				Toast.makeText(getApplicationContext(), "发布成功",Toast.LENGTH_SHORT).show();
			}
		}
    	
    };
    
    Runnable updateThread = new Runnable(){
		public void run() {
			
			String postEtStr = postEt.getText().toString();
			Object s = client.invoke("update", new Object[]{source,postEtStr,"Android"});
			Log.v("source0",s.toString());
			Message msg = updateHandler.obtainMessage();
			msg.arg1 = 1 ;
			updateHandler.sendMessage(msg);
			//updateHandler.removeCallbacks(updateThread);

		}
    };
}
