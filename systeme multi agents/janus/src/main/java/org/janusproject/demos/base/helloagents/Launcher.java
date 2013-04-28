package org.janusproject.demos.base.helloagents;


import org.arakhne.vmutil.locale.Locale;
import org.janusproject.kernel.Kernel;
import org.janusproject.kernel.agent.Kernels;

/**
 * The launcher
 */
public class Launcher {
	
	/**
	 * The content of the string message exchange from A to B
	 */
	public final static String WELCOME_MESSAGE_STRING_HEADER = "hello";  //$NON-NLS-1$
	
	/**
	 * The content of the string message exchange from B to A
	 */
	public final static String WELCOME_MESSAGE_ACK_STRING_HEADER = "welcome";  //$NON-NLS-1$
	
 
	/**
	 * Main function
	 * @param args - empty set of args
	 */
	public static void main(String[] args) {
		
		AgentA a = new AgentA();
		AgentB b = new AgentB();
		
		Kernel k = Kernels.get();
		k.launchLightAgent(b, Locale.getString(Launcher.class, "AGENT-A")); //$NON-NLS-1$
		k.launchLightAgent(a, Locale.getString(Launcher.class, "AGENT-B")); //$NON-NLS-1$
	}
 
}