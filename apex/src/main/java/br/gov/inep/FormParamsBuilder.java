package br.gov.inep;

import org.apache.http.Consts;
import org.apache.http.HttpEntity;
import org.apache.http.NameValuePair;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.message.BasicNameValuePair;

import java.util.ArrayList;
import java.util.List;

public class FormParamsBuilder {

	private List<NameValuePair> formparams = new ArrayList<>();

	public FormParamsBuilder add(String name, String value) {
		formparams.add(new BasicNameValuePair(name, value));
		return this;
	}

	public HttpEntity build() {
		return new UrlEncodedFormEntity(formparams, Consts.UTF_8);
	}

}
