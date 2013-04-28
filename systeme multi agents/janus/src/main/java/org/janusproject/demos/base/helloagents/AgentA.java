package org.janusproject.demos.base.helloagents;

import org.arakhne.vmutil.locale.Locale;
import org.janusproject.kernel.address.AgentAddress;
import org.janusproject.kernel.agent.Agent;
import org.janusproject.kernel.mailbox.Mailbox;
import org.janusproject.kernel.message.Message;
import org.janusproject.kernel.message.StringMessage;
import org.janusproject.kernel.status.Status;
import org.janusproject.kernel.status.StatusFactory;

/**
 * Micro test agent A
 */
public class AgentA extends Agent {
	
	private static final long serialVersionUID = 5326548050822336187L;

	private static enum State {
		PRESENTATION, WAIT_FOR_WELCOME;
	}

	private State state;
	

	private boolean ACKreceived = false;

	@Override
	public Status activate(Object... parameters) {
		this.state = State.PRESENTATION;
		print(Locale.getString(AgentA.class,"AgentA.0"));  //$NON-NLS-1$
		return StatusFactory.ok(this);
	}

	@Override
	public Status live() {

		switch (this.state) {

		case PRESENTATION:
			broadcastMessage(new StringMessage(Launcher.WELCOME_MESSAGE_STRING_HEADER));
			print(Locale.getString(AgentA.class,"AgentA.2"));  //$NON-NLS-1$
			this.state = State.WAIT_FOR_WELCOME;
			break;

		case WAIT_FOR_WELCOME:
			print(Locale.getString(AgentA.class,"AgentA.3"));  //$NON-NLS-1$

			boolean stop = false;
			Mailbox box = this.getMailbox();
			Message m;
			while (this.hasMessage() && !stop) {
				m = box.getFirst();
				print(Locale.getString(AgentA.class,"AgentA.4"));  //$NON-NLS-1$
				
				if (m instanceof StringMessage) {
					if (((StringMessage) m).getContent().equals(Launcher.WELCOME_MESSAGE_ACK_STRING_HEADER)) {					
						AgentAddress a = (AgentAddress) m.getSender();
						print(Locale.getString(AgentA.class,"AgentA.5",((StringMessage) m).getContent(),a));    //$NON-NLS-1$
						stop = true;
						this.ACKreceived = true;
					} else if (((StringMessage) m).getContent().equals(Launcher.WELCOME_MESSAGE_STRING_HEADER)) {					
						print(Locale.getString(AgentA.class,"AgentA.6",((StringMessage) m).getContent()));    //$NON-NLS-1$
					} 
				} 

				box.removeFirst();

			}
			
			if(this.ACKreceived) {
				print(Locale.getString(AgentA.class,"AgentA.9"));  //$NON-NLS-1$
				killMe();
			}
			break;
			
		default:
			killMe();
			break;
		}
		return StatusFactory.ok(this);
	}
}