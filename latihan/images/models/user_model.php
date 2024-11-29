<?php 
require_once 'domain_object/node_user.php';
require_once 'domain_object/node_role.php';
class modelUser
{
    private $users = [];
    
    public function __construct() {
        if (isset($_SESSION['users'])) {
            $this->users = unserialize($_SESSION['users']);
        } else {
            $this->initializeDefaultUser();
        }
    }
    public function initializeDefaultUser() {
        $obj_role1 = new \role(1, "Admin", "administrator", 1);
        $obj_role2 = new \role(2, "Developer", "Pengembang", 1);
        $obj_role3 = new \role(3, "Kasir", "pembayaran", 0);
        $this->addUser("nina", "1234", $obj_role1);
        $this->addUser("octoramadhan_", "1234", $obj_role2);
        $this->addUser("feast", "1234", $obj_role3);
    }
    public function addUser($username, $password, $role) {
        $user_id = $this->generateRandomId(); // Generate random unique ID
        $pengguna = new user($user_id, $username, $password, $role);
        $this->users[] = $pengguna;
        $this->saveToSession();
    }
    private function generateRandomId() {
        do {
            $randomId = random_int(10000, 99999); // Generate random ID in the range 10000 to 99999
        } while ($this->isIdExists($randomId)); // Ensure the ID is unique
        return $randomId;
    }
    private function isIdExists($id) {
        foreach ($this->users as $user) {
            if ($user->user_id == $id) {
                return true;
            }
        }
        return false;
    }
    private function saveToSession() {
        $_SESSION['users'] = serialize($this->users);
    }
    public function getAllUser() {
        return $this->users;
    }
    public function getUserById($user_id) {
        foreach ($this->users as $user) {
            if ($user->user_id == $user_id) {
                return $user;
            }
        }
        return null;
    }
    public function updateUser($user_id, $username, $password, $role) {
        foreach ($this->users as $user) {
            if ($user->user_id == $user_id) {
                $user->username = $username;
                $user->password = $password;
                $user->role = $role;
                $this->saveToSession();
                return true;
            }
        }
        return false;
    }
    public function deleteUser($user_id) {
        foreach ($this->users as $key => $user) {
            if ($user->user_id == $user_id) {
                unset($this->users[$key]);
                $this->users = array_values($this->users); // Reset array keys
                $this->saveToSession();
                return true;
            }
        }
        return false;
    }
    public function getUserByName($username) {
        foreach ($this->users as $user) {
            if ($user->username == $username) {
                return $user;
            }
        }
        return null;
    }
}
?>