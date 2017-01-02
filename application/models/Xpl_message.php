<?php

class Xpl_Message{

  public $broadcast = "255.255.255.255";
  public $port = 3865;     
  public $listenOnAddress="ANY_LOCAL";   
  public $xPLSource = "xpl-ardui.server"; 
  public $xPLType;
  public $xPLTarget;
  public $xPLSchema;
  public $xPLBody;
	
	public function send($_type, $_target, $_schema, $_body){
		$this->xPLType = $_type;
		$this->xPLTarget = $_target;
		$this->xPLSchema = $_schema;
		$this->xPLBody = $_body;

	
			if( !function_exists( 'socket_create' ) )
		  {
			trigger_error( 'Sockets not enabled in this version of PHP', E_USER_ERROR );
		  }
			
		  // create low level socket
		  if( !$socket = socket_create( AF_INET, SOCK_DGRAM, SOL_UDP ) )
		  {
			trigger_error('Error creating new socket',E_USER_ERROR);		
		  }

		  // Set the socket to broadcast
		  if( !socket_set_option( $socket, SOL_SOCKET, SO_BROADCAST, 1 ) )
		  {
			trigger_error( 'Unable to set socket into broadcast mode', E_USER_ERROR );
		  }
			
		  // If the listenOnAddress is not set to ANY_LOCAL, we need to bind the socket.
		  if( $this->listenOnAddress != "ANY_LOCAL" )
		  {
			if( !socket_bind( $socket, $this->listenOnAddress, 0 ) )
			{
			  trigger_error('Error binding socket to ListenOnAddress', E_USER_ERROR );
			}
		  }

		  // Send the message
		  $msg = $this->xPLType."\n{\nhop=1\nsource=".$this->xPLSource."\ntarget="
							.$this->xPLTarget."\n}\n".$this->xPLSchema."\n{\n".$this->xPLBody."\n}\n";
			
		  if(FALSE===socket_sendto($socket, $msg, strlen($msg), 0, $this->broadcast, $this->port))
		  {
			trigger_error('Failed to send message', E_USER_ERROR );
		  }

		  // We're done
		  socket_close( $socket );
	
	}




}