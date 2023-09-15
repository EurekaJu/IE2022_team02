<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * HomeImages Controller
 *
 * @property \App\Model\Table\HomeImagesTable $HomeImages
 * @method \App\Model\Entity\HomeImage[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class HomeImagesController extends AppController
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

        $homeImages = $this->HomeImages->find();

        $this->set(compact('homeImages'));
        $this->viewBuilder()-> setLayout('menufooter');
    }
    /**
     * View method
     *
     * @param string|null $id Home Image id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $homeImage = $this->HomeImages->get($id, [
            'contain' => [],
        ]);
        $this->Authorization->authorize($homeImage);

        $this->set(compact('homeImage'));
        $this->viewBuilder()-> setLayout('menufooter');
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $homeImage = $this->HomeImages->newEmptyEntity();
        $this->Authorization->authorize($homeImage);
        if ($this->request->is('post')) {
            $homeImage = $this->HomeImages->patchEntity($homeImage, $this->request->getData());
            if ($this->HomeImages->save($homeImage)) {
                $this->Flash->success(__('The home image has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The home image could not be saved. Please, try again.'));
        }
        $this->set(compact('homeImage'));
        $this->viewBuilder()-> setLayout('menufooter');
    }

    /**
     * Edit method
     *
     * @param string|null $id Home Image id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $homeImage = $this->HomeImages->get($id, [
            'contain' => [],
        ]);
        $this->Authorization->authorize($homeImage);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $homeImage = $this->HomeImages->patchEntity($homeImage, $this->request->getData());
            if ($this->HomeImages->save($homeImage)) {
                $this->Flash->success(__('The home image has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The home image could not be saved. Please, try again.'));
        }
        $this->set(compact('homeImage'));
        $this->viewBuilder()-> setLayout('menufooter');
    }

    /**
     * Delete method
     *
     * @param string|null $id Home Image id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $homeImage = $this->HomeImages->get($id);
        $this->Authorization->authorize($homeImage);
        if ($this->HomeImages->delete($homeImage)) {
            $this->Flash->success(__('The home image has been deleted.'));
        } else {
            $this->Flash->error(__('The home image could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
