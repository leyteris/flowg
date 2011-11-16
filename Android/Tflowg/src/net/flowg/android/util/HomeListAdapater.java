package net.flowg.android.util;

import java.util.List;

import net.flowg.android.R;
import net.flowg.android.model.TopicInfo;
import net.flowg.android.util.AsyncImageLoader.ImageCallback;
import android.content.Context;
import android.graphics.drawable.Drawable;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

public class HomeListAdapater extends BaseAdapter {
	
	private Context context;
	private List<TopicInfo> list = null;
	private int resource; 

	private static class TopicHolder {
		ImageView avatar;
		TextView userName;
		TextView createTime;
		TextView content;
	}

	public HomeListAdapater(Context context, List<TopicInfo> list,int resource) {
		super();
		this.context = context;
		this.list = list;
		this.resource = resource;
	}

	@Override
	public int getCount() {
		return list.size();
	}

	@Override
	public Object getItem(int position) {
		return list.get(position);
	}

	@Override
	public long getItemId(int position) {
		return position;
	}

	@Override
	public View getView(int position, View convertView, ViewGroup parent) {
		
        //convertView = LayoutInflater.from(getApplicationContext()).inflate(R.layout.weibo, null);
        //LayoutInflater inflater = getLayoutInflater();  
		//View layout = inflater.inflate(resource,null); 
		AsyncImageLoader asyncImageLoader = new AsyncImageLoader();
		Context mContext = context;  
        LayoutInflater inflater = (LayoutInflater)mContext.getSystemService(Context.LAYOUT_INFLATER_SERVICE);  
        convertView = inflater.inflate(resource,null);  
 
        TopicHolder th = new TopicHolder();
        th.avatar = (ImageView) convertView.findViewById(R.id.avatar);
        th.content = (TextView) convertView.findViewById(R.id.content);
        th.createTime = (TextView) convertView.findViewById(R.id.create_time);
        th.userName = (TextView) convertView.findViewById(R.id.username);
       // th.wbimage=(ImageView) convertView.findViewById(R.id.wbimage);
        TopicInfo ti = list.get(position);
        if(ti!=null){
            convertView.setTag(ti.getId());
            th.userName.setText(ti.getNickname());
            th.createTime.setText(ti.getCreateTime());
            th.content.setText(ti.getContent(), TextView.BufferType.SPANNABLE);
            //textHighlight(th.content,new char[]{'#'},new char[]{'#'});
            //textHighlight(th.content,new char[]{'@'},new char[]{':',' '});
            //textHighlight2(th.content,"http://"," ");
            
            //if(wb.getHaveImage()){
            //    wh.wbimage.setImageResource(R.drawable.images);
            //}
            Drawable cachedImage = asyncImageLoader.loadDrawable(ti.getAvatar(),th.avatar, new ImageCallback(){

                @Override
                public void imageLoaded(Drawable imageDrawable,ImageView imageView, String imageUrl) {
                    imageView.setImageDrawable(imageDrawable);
                }
                
            });
             if (cachedImage == null) {
            	 th.avatar.setImageResource(R.drawable.usericon);
                }else{
                	th.avatar.setImageDrawable(cachedImage);
                }
        }
        
        return convertView;
	}

}
