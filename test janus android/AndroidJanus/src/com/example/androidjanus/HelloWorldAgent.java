package com.example.androidjanus;

import org.janusproject.kernel.agent.Agent;
import org.janusproject.kernel.status.Status;
import org.janusproject.kernel.status.StatusFactory;



public class HelloWorldAgent extends Agent {
	
	public HelloWorldAgent(){
		
	}
	
	@Override
	public Status activate(Object... parameters) {
		//Initializes capacities and memory
		//Creates or joins groups and requests roles
		//...
		System.out.println(this.getName());

		
		return StatusFactory.ok(this);
	}
	
	public Status live() {
		
		return null;
	}
 
}