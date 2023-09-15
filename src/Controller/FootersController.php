<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Footers Controller
 *
 * @property \App\Model\Table\FootersTable $Footers
 * @method \App\Model\Entity\Footer[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FootersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();

        $session2 = $this->request->getSession();
        $role = $session2->read('userRole');
        $result = $this->Authentication->getResult();
        //redirect user if not staff
        if($role == 'customer'){
            $this->Flash->error('Access denied. Staff access only.');
            return $this->redirect(array('controller' => 'Books','action'=>'home'));
        }
        //redirect user if not logged in
        elseif (!$result->isValid()){
            $this->Flash->error('Access denied. Please log in.');
            return $this->redirect(array('controller' => 'Books','action'=>'home'));
        }
        $footers = $this->Footers->find();

        $this->set(compact('footers'));
        $this->viewBuilder()-> setLayout('menufooter');
    }

    /**
     * View method
     *
     * @param string|null $id Footer id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->Authorization->skipAuthorization();
        $footer = $this->Footers->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('footer'));
        $this->viewBuilder()-> setLayout('menufooter');
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $footer = $this->Footers->newEmptyEntity();
        $this->Authorization->authorize($footer);
        if ($this->request->is('post')) {
            $footer = $this->Footers->patchEntity($footer, $this->request->getData());
            if ($this->Footers->save($footer)) {
                $this->Flash->success(__('The footer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The footer could not be saved. Please, try again.'));
        }
        $this->set(compact('footer'));
        $this->viewBuilder()-> setLayout('menufooter');
    }

    /**
     * Edit method
     *
     * @param string|null $id Footer id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $footer = $this->Footers->get($id, [
            'contain' => [],
        ]);
        $this->Authorization->authorize($footer);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $footer = $this->Footers->patchEntity($footer, $this->request->getData());
            if ($this->Footers->save($footer)) {
                $this->Flash->success(__('The footer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The footer could not be saved. Please, try again.'));
        }
        $this->set(compact('footer'));
        $this->viewBuilder()-> setLayout('menufooter');
    }

    /**
     * Delete method
     *
     * @param string|null $id Footer id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $footer = $this->Footers->get($id, [
            'contain' => [],
        ]);
        $this->Authorization->authorize($footer);
        $this->request->allowMethod(['post', 'delete']);
        $footer = $this->Footers->get($id);
        if ($this->Footers->delete($footer)) {
            $this->Flash->success(__('The footer has been deleted.'));
        } else {
            $this->Flash->error(__('The footer could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
