package com.example.androidjanus;

import org.janusproject.kernel.agent.Agent;
import org.janusproject.kernel.status.Status;

public class HelloWorldAgent extends Agent {
	 
	public Status live() {
		System.out.println("Oulala");
		return null;
	}
 
}