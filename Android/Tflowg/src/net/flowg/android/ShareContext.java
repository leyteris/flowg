package net.flowg.android;

import org.phprpc.PHPRPC_Client;

import android.app.Application;

public class ShareContext extends Application {
	private PHPRPC_Client client = null;
	private String source = null;

	public String getSource() {
		return source;
	}

	public void setSource(String source) {
		this.source = source;
	}

	public PHPRPC_Client getClient() {
		return client;
	}

	public void setClient(PHPRPC_Client client) {
		this.client = client;
	}
}
