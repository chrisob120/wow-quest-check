<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {
		
	public function __construct() {
		parent::__construct();
	}
	
	public function is_unique($str, $field) {
		$field_ar = explode('.', $field);
		$query = $this->CI->db->get_where($field_ar[0], array($field_ar[1] => $str), 1, 0);
		if ($query->num_rows() === 0) {
			return true;
		}
		
		$this->CI->form_validation->set_message('is_unique', 'The ' .ucfirst($field_ar[1]). ' \'<strong>' .$str. '</strong>\' is already taken.');
		return false;
	}

    public function is_unique_where($str, $field) {
        list($table, $field1, $field2, $val2) = explode('.', $field);

        $qry = $this->CI->db->select()
            ->from($table)
            ->where($field1, $str)
            ->where($field2, $val2)
            ->limit(1)
            ->get();

        if ($qry->num_rows() === 0) {
            return true;
        }

        $this->CI->form_validation->set_message('is_unique_where', 'The ' .ucfirst($field1). ' \'<strong>' .$str. '</strong>\' is already taken.');
        return false;
    }
	
	public function exists($str, $field) {
		$field_ar = explode('.', $field);
		$query = $this->CI->db->get_where($field_ar[0], array($field_ar[1] => $str), 1, 0);
		if ($query->num_rows() === 1) {
			return true;
		}
		
		$this->CI->form_validation->set_message('exists', 'The ' .ucfirst($field_ar[1]). ' \'<strong>' .$str. '</strong>\' does not exist.');
		return false;
	}
	
	public function force_false($str, $msg) {
		$this->CI->form_validation->set_message('force_false', $msg);
		return false;
	}
	
	public function alpha_num_space($str, $field) {
		if (!preg_match('/[^0-9a-zA-Z ]/', $str)) {
			return true;
		}

		$this->CI->form_validation->set_message('alpha_num_space', 'The ' .ucfirst($field). ' field may only contain alpha-numeric characters and spaces.');
		return false;
	}

    public function repo_exists($str) {
        $this->CI->load->library('GitHub');
        $repos = $this->CI->github->request("/user/repos", 'GET', array(), 200, 'GitHubSimpleRepo', true);
        $repoArr = array();

        foreach ($repos as $r) {
            $repoArr[] = $r->name;
        }

        if (in_array($str, $repoArr)) return true;

        $this->CI->form_validation->set_message('repo_exists', "The repo <strong>'" .$str. "'</strong> does not exist for GitHub user <strong>'" .$this->CI->configData['gitHubUserName']. "'</strong>.");
        return false;
    }

    public function check_folder($folder){
        $envArr = array('devDomain', 'qaDomain', 'demoDomain');
        $alreadyExistsArr = array();

        foreach ($envArr as $envDomain) {
            // get the domain and path
            $domain = $this->CI->configData[$envDomain];
            $path = '/' .$this->CI->configData['home']. '/' .$this->CI->configData['account']. '/' .$this->CI->configData['rootFolder']. '/' .$domain . '/' .$folder;

            if (is_dir($path)) {
                $alreadyExistsArr[] = $domain;
            }
        }

        // if empty, the folder does not already exist in any of the non production environments
        if (empty($alreadyExistsArr)) {
            return true;
        }

        $envString = implode(', ', $alreadyExistsArr);

        $this->CI->form_validation->set_message('check_folder', "The folder '" .$folder. "' already exists in the following environments: <strong>" .$envString. "</strong>");
        return false;
    }
	
}


/* End of file MY_Form_validation.php */
/* Location: ./application/libraries/MY_Form_validation.php */