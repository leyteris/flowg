package net.flowg.android;

import java.util.ArrayList;
import java.util.List;

import net.flowg.android.model.TopicInfo;
import net.flowg.android.util.FunctionUtil;
import net.flowg.android.util.HomeListAdapater;

import org.phprpc.PHPRPC_Client;
import org.phprpc.util.AssocArray;
import org.phprpc.util.Cast;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.Button;
import android.widget.LinearLayout;
import android.widget.ListView;
import android.widget.Toast;

public class HomeListActivity extends CommonActivity {

	private LinearLayout loadingLayout = null;
	List<TopicInfo> list = null;
	private ShareContext shareContext;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		
		super.onCreate(savedInstanceState);
		setContentView(R.layout.topic_list);
		this.setTitle("Flowg微博 - 我的主页");
		
		loadingLayout=(LinearLayout)findViewById(R.id.loadingLayout);
		loadingLayout.setVisibility(View.INVISIBLE);  
		
		Button myHomeBtn = (Button)findViewById(R.id.myhomeBtn);
		Button homeBtn = (Button)findViewById(R.id.homeBtn);
		Button updateBtn = (Button)findViewById(R.id.updateBtn);
		
		myHomeBtn.setOnClickListener(new OnClickListener(){
			public void onClick(View v) {
				
				Intent it = new Intent();
				it.setClass(HomeListActivity.this,MyHomeListActivity.class);
				HomeListActivity.this.startActivity(it);
				
			}
		});
		
		homeBtn.setOnClickListener(new OnClickListener(){
			public void onClick(View v) {
				
				Intent it = new Intent();
				it.setClass(HomeListActivity.this,HomeListActivity.class);
				HomeListActivity.this.startActivity(it);
				
			}
		});
		
		updateBtn.setOnClickListener(new OnClickListener(){
			public void onClick(View v) {
				
				Intent it = new Intent();
				it.setClass(HomeListActivity.this,PostActivity.class);
				HomeListActivity.this.startActivity(it);
				
			}
		});
		
	}

	@Override
	protected void onStart() {
		
		shareContext = ((ShareContext)getApplicationContext());
		this.client = shareContext.getClient();
		this.source = shareContext.getSource();
		
		if(this.client == null){
			
			Intent it = getIntent();
	        String accountStr = it.getStringExtra("accountStr").toString();
	        String passwordStr = it.getStringExtra("passwordStr").toString();
	        
	        this.client = new PHPRPC_Client(SERVICE_URL);  
	        this.client.setEncryptMode(2);  
	        
	        this.source = Cast.toString(client.invoke("check_login", new Object[]{accountStr,passwordStr}));
	        
	        if(this.source == null){
	        	Log.e("flowg_error", "source not find!");
	        	Toast.makeText(getApplicationContext(), "验证错误",Toast.LENGTH_SHORT).show();
	        }else{
	        	client.useService(SERVICE_URL);
		        shareContext.setClient(this.client);
		        shareContext.setSource(this.source);
	        }
	        
	        Object s = client.invoke("selfuser_timeline", new Object[]{source,0,20});
			Log.v("source0",s.toString());
	       
		}
		super.onStart();
		
	}

	@Override
	protected void onResume() {

        if(this.source != null){

        	this.list = new ArrayList<TopicInfo>();
			AssocArray alist = (AssocArray)client.invoke("home_timeline", new Object[]{this.source,0,20});
	    	for(int i = 0 ; i < alist.size();++i){
	    		AssocArray a = (AssocArray)alist.get(i);
	    		TopicInfo ti = new TopicInfo();
	    		ti.setNickname(Cast.toString(a.get("nickname")));
	    		ti.setUid(Cast.toString(a.get("uid")));
	    		ti.setCreateTime(Cast.toString(a.get("create_time")));
	    		ti.setAvatar(Cast.toString(a.get("avatar")));
	    		ti.setContent(Cast.toString(FunctionUtil.Html2Text(Cast.toString(a.get("content")))));
				this.list.add(ti);
	    	}
	    	
	    	if(list!=null){
	    		
	    		HomeListAdapater adapater = new HomeListAdapater(this,list,R.layout.topic_item);
                ListView Msglist=(ListView)findViewById(R.id.list);
                
                Msglist.setOnItemClickListener(new OnItemClickListener(){
                    @Override
                    public void onItemClick(AdapterView<?> arg0, View view,int arg2, long arg3) {
                        Object obj=view.getTag();
                        if(obj!=null){
                            String id=obj.toString();
                            Intent intent = new Intent(HomeListActivity.this,TopicViewActivity.class);
                            Bundle b=new Bundle();
                            b.putString("key", id);
                            intent.putExtras(b);
                            startActivity(intent);
                        }
                    }
                    
                });
                Msglist.setAdapter(adapater);
            }else{
            	Log.e("flowg_error", "list is null!");
            	Toast.makeText(getApplicationContext(), "无列表内容",Toast.LENGTH_SHORT).show();
            }
	    	
        }else{
        	Log.e("flowg_error", "source not find!");
        	Toast.makeText(getApplicationContext(), "验证错误",Toast.LENGTH_SHORT).show();
        }
        loadingLayout.setVisibility(View.GONE);
		super.onResume();
	}
	
}
