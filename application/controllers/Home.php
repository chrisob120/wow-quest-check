<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	public function index() {
		$this->load->library('API');

		$this->_data['realms'] = $this->api->realm->getRealms();


		$this->template->create_template_views('main/home', $this->_data);
		$this->template->write('title', 'WoW Test');

		$this->template->render();
	}

	public function check_quest() {
		// if the form was clicked
		if ($this->input->post()) {
			$this->form_validation->set_rules('alias', 'Alias', 'trim|required|alpha_num_space["alias"]');
			$this->form_validation->set_rules('quest_id', 'Quest ID', 'trim|required|numeric');

			if (!$this->form_validation->run()) {
				$fields = array('alias', 'quest_id');

				foreach ($fields as $f) {
					if (form_error($f)) {
						$this->formErrors[$f] = form_error($f, '<span>', '</span>');
					}
				}
			}

			if (empty($this->formErrors)) {
				$charArr = array(
					'server' => $this->input->post('realm'),
					'name' => $this->input->post('alias')
				);

				$this->load->library('API', $charArr);
				$this->api->character->quests();

				if ($this->api->error) {
					$this->formErrors['api_error'] = '<span>' .$this->api->errorMsg. '</span>';
				}


			}

			if (empty($this->formErrors)) {
				$completedQuests = $this->api->data->quests;
				$questFound = false;
				$realmSlug = '';

				// check if quest was completed
				if (in_array($this->input->post('quest_id'), $completedQuests)) {
					$questFound = true;
					$realmSlug = $this->input->post('realm');
				}

				$data = array(
					'error' => false,
					'questCheck' => $questFound,
					'realmSlug' => $realmSlug
				);

			} else {
				$data = array(
					'error' => true,
					'fields' => $this->formErrors
				);
			}

			// send as JSON
			header("Content-Type: application/json", true);
			echo json_encode($data);
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/Home.php */