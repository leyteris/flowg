package net.flowg.android;

import net.flowg.android.util.FunctionUtil;
import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

public class LoginActivity extends Activity {
	
	private EditText accountEt;
	private EditText passwordEt;
    private Button loginBtn;
   // private Button regBtn;
    
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.login);
        this.setTitle("FlowgÎ¢²© - µÇÂ¼");
        
        accountEt = (EditText)findViewById(R.id.accountEditText);
        passwordEt = (EditText)findViewById(R.id.passwordEditText);
        loginBtn = (Button)findViewById(R.id.loginBtn);
       // regBtn = (Button)findViewById(R.id.regBtn);
        
        if(FunctionUtil.getLocalIpAddress() == null){
        	Log.e("flowg_error", "internet is not work!");
        	Toast.makeText(getApplicationContext(), "Î´Á¬½Óµ½»¥ÁªÍø£¬Çë¼ì²âÅäÖÃ",Toast.LENGTH_SHORT).show();
        }else{
        	loginBtn.setOnClickListener(new LoginBtnOnclickListener());
        }
        

    }
    
    class LoginBtnOnclickListener implements OnClickListener {

		@Override
		public void onClick(View v) {

			String accountEtStr = accountEt.getText().toString();
			String passwordEtStr = passwordEt.getText().toString();
			
			Intent it = new Intent();
			it.putExtra("accountStr", accountEtStr);
			it.putExtra("passwordStr", passwordEtStr);
			it.setClass(LoginActivity.this,HomeListActivity.class);
			LoginActivity.this.startActivity(it);
			
		}
    	
    }
}
