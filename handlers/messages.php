
<?php
	include ('../config.php');


	switch ($_REQUEST['action']) {
		case 'sendMessage':
		session_start();
			$query =$conn->prepare("INSERT INTO messages SET user=?, message=?");
			$run=$query->execute([$_SESSION['username'],$_REQUEST['message']]);

			if($run){
				echo 1;
				exit;
			}
			break;

		case 'getMessage':
		    $query =$conn->prepare("SELECT * FROM messages ");
			$run=$query->execute();	
			$fp=$query->fetchAll(PDO::FETCH_OBJ);
			$chat='';
			foreach ($fp as $message) {
				//$chat .= $message->message .'<br>';
				$chat .= '<div class="sigle-message">
					<strong>'.$message->user.' :</strong>  '.$message->message.'
					<span>'.date('d-m-Y h:i a',strtotime($message->date)).'</span>
				</div>';
			}
			echo $chat;

		break;
		
	
	}




?>
