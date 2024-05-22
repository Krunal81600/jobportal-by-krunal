<?php

class User {
	private $dbHost     = "localhost";
    private $dbUsername = "Africaglobalnetw";
    private $dbPassword = "Africaglobalnetwork";
    private $dbName     = "Africaglobalnetwork";
	private $userTbl    = 'users';
	private $userTbla    = 'user';
	
	function __construct(){
		if(!isset($this->db)){
            // Connect to the database
            $conn = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
            if($conn->connect_error){
                die("Failed to connect with MySQL: " . $conn->connect_error);
            }else{
                $this->db = $conn;
            }
        }
	}
	
	function checkUser($userData = array()){
		if(!empty($userData)){
			// Check whether user data already exists in database
			$prevQuery = "SELECT * FROM ".$this->userTbl." WHERE oauth_provider = '".$userData['oauth_provider']."' AND oauth_uid = '".$userData['oauth_uid']."'";
			$prevResult = $this->db->query($prevQuery);
			if($prevResult->num_rows > 0){
				// Update user data if already exists
				$query = "UPDATE ".$this->userTbl." SET first_name = '".$userData['first_name']."', last_name = '".$userData['last_name']."', email = '".$userData['email']."', gender = '".$userData['gender']."', locale = '".$userData['locale']."', picture = '".$userData['picture']."', link = '".$userData['link']."', modified = '".date("Y-m-d H:i:s")."' WHERE oauth_provider = '".$userData['oauth_provider']."' AND oauth_uid = '".$userData['oauth_uid']."'";
				$update = $this->db->query($query);
			}else{
				// Insert user data
				$query = "INSERT INTO ".$this->userTbl." SET oauth_provider = '".$userData['oauth_provider']."', oauth_uid = '".$userData['oauth_uid']."', first_name = '".$userData['first_name']."', last_name = '".$userData['last_name']."', email = '".$userData['email']."', gender = '".$userData['gender']."', locale = '".$userData['locale']."', picture = '".$userData['picture']."', link = '".$userData['link']."', created = '".date("Y-m-d H:i:s")."', modified = '".date("Y-m-d H:i:s")."'";
				$insert = $this->db->query($query);
				
				$rand=mt_rand(1,99999);
				$user=$userData['first_name'].$rand;
				$email=$userData['email'];
				$query = "INSERT INTO ".$this->userTbla." SET user = '".$user."', email = '".$email."', fname = '".$userData['first_name']."', lname = '".$userData['last_name']."', rtype = 'Employee', jct = '".date("Y-m-d h:i:sa")."'";
				$insert = $this->db->query($query);
				$insert_id = $this->db->insert_id();
				?>
				<script>
					alert('<?php echo $insert_id; ?>');
				</script>
				<?php
				
				$_SESSION['member_id']=$insert_id;
                $_SESSION['member_email'] = $email;
                $_SESSION['member_user'] = $user;

			}
			
			// Get user data from the database
			$result = $this->db->query($prevQuery);
			$userData = $result->fetch_assoc();
		}
		
		// Return user data
		return $userData;
	}
}
?>