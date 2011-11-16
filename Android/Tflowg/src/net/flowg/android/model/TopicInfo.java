package net.flowg.android.model;

import net.flowg.android.util.FlowgUtil;
import net.flowg.android.util.FunctionUtil;

public class TopicInfo {
	
	private String id;
	private String nickname;
	private String avatar;
	private String uid;
	private String createTime;
	private String content;
	
	public String getId() {
		return id;
	}
	public void setId(String id) {
		this.id = id;
	}
	public String getNickname() {
		return nickname;
	}
	public void setNickname(String nickname) {
		this.nickname = nickname;
	}
	public String getAvatar() {
		return avatar;
	}
	public void setAvatar(String avatar) {
		this.avatar = FlowgUtil.getAvatarRealPath(avatar);
	}
	public String getUid() {
		return uid;
	}
	public void setUid(String uid) {
		this.uid = uid;
	}
	public String getCreateTime() {
		return createTime;
	}
	public void setCreateTime(String createTime) {
		this.createTime = FunctionUtil.timeStamp2Date(createTime);
	}
	public String getContent() {
		return content;
	}
	public void setContent(String content) {
		this.content = content;
	}

}
