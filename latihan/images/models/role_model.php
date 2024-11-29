<?php 
require_once 'domain_object/node_role.php';
class modelRole
{
    private $roles = [];
    private $nextId = 1;
    public function __construct() {
        if (isset($_SESSION['roles'])) {
            $this->roles = unserialize($_SESSION['roles']);
            // Periksa apakah array kosong sebelum menggunakan max()
            $this->nextId = !empty($this->roles) ? max(array_column($this->roles, 'role_id')) + 1 : 1;        
        } else {
            $this->initializeDefaultRole();
        }
    }
    
    public function initializeDefaultRole() {
        $this->addRole("Admin", "Administrator", 1);
        $this->addRole("Developer", "Pengembang", 1);
        $this->addRole("Kasir", "Pembayaran", 0);
    }
    public function addRole($role_name, $role_description, $role_status) {
        $peran = new Role($this->nextId++, $role_name, $role_description, $role_status);
        $this->roles[] = $peran;
        $this->saveToSession();
    }
    private function saveToSession() {
        foreach ($this->roles as $role) {
            if (!($role instanceof Role)) {
                echo "Error: Data yang disimpan bukan objek Role.";
                exit;
            }
        }
        $_SESSION['roles'] = serialize($this->roles);
    }
    
    public function getAllRoles() {
        return $this->roles;
    }
    public function getRoleById($role_id) {
        foreach ($this->roles as $role) {
            if ($role->role_id == $role_id) {
                return $role;
            }
        }
        return null;
    }
    
    public function updateRole($role_id, $role_name, $role_description, $role_status) {
        foreach ($this->roles as $role) {
            if ($role->role_id == $role_id) {
                $role->role_name = $role_name;
                $role->role_descriptionription = $role_description;
                $role->role_status = $role_status;
    
                $this->saveToSession();
                return true; // Berhasil diperbarui
            }
        }
        return false; // Tidak menemukan role dengan ID yang diberikan
    }
    
    public function deleteRole($role_id) {
        foreach ($this->roles as $key => $role) {
            if ($role->role_id == $role_id) {
                unset($this->roles[$key]); // Menghapus role dari array
                $this->roles = array_values($this->roles); // Menyusun ulang array yang terhapus
                $this->reassignIds(); // Memperbarui ID role
                $this->saveToSession();
                return true;
            }
        }
        return false;
    }
    
    private function reassignIds() {
        // Mengubah role_id agar urut mulai dari 1
        foreach ($this->roles as $index => $role) {
            $role->role_id = $index + 1; // Mengatur ulang ID mulai dari 1
        }
    }
    
    public function getRoleByName($role_name) {
        foreach ($this->roles as $role) {
            if ($role->role_name == $role_name) {
                return $role;
            }
        }
        return null;
    }
    
}
?>