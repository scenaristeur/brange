package org.janusproject.demos.base.helloagents;


import org.arakhne.vmutil.locale.Locale;
import org.janusproject.kernel.address.AgentAddress;
import org.janusproject.kernel.agent.Agent;
import org.janusproject.kernel.message.Message;
import org.janusproject.kernel.message.StringMessage;
import org.janusproject.kernel.status.Status;
import org.janusproject.kernel.status.StatusFactory;
/**
 * Micro test agent B
 */
public class AgentB extends Agent {

	private static final long serialVersionUID = -2478042408957087937L;

	
	private boolean ACKsent = false;

	@Override
	public Status activate(Object... parameters) {
		    print (Locale.getString(AgentB.class,"AgentB.0"));  //$NON-NLS-1$
			return StatusFactory.ok(this);
		  }
	  
	  
	@Override
	public Status live() {
		  
			for(Message m : getMessages()) {
				print(Locale.getString(AgentB.class,"AgentB.1"));  //$NON-NLS-1$				
				if(m instanceof StringMessage && ((StringMessage)m).getContent().equals(Launcher.WELCOME_MESSAGE_STRING_HEADER)) { 
			        replyToMessage(m, new StringMessage(Launcher.WELCOME_MESSAGE_ACK_STRING_HEADER));  
			        AgentAddress a = (AgentAddress)m.getSender();
			        print (Locale.getString(AgentB.class,"AgentB.4",a));  //$NON-NLS-1$
			        print (Locale.getString(AgentB.class,"AgentB.5"));  //$NON-NLS-1$			
					this.ACKsent = true;
				}
			}
		  
			if(this.ACKsent) {
				print(Locale.getString(AgentB.class,"AgentB.6"));  //$NON-NLS-1$
				killMe();
			}

			return StatusFactory.ok(this);
	  }
	}