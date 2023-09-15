<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * BookImages Controller
 *
 * @property \App\Model\Table\BookImagesTable $BookImages
 * @method \App\Model\Entity\BookImage[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BookImagesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        // $this->paginate = [
        //     'contain' => ['Books'],
        // ];

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

        $bookImages = $this->BookImages->find()->contain(['Books']);

        $this->set(compact('bookImages'));
        $this->viewBuilder()-> setLayout('menufooter');
    }

    /**
     * View method
     *
     * @param string|null $id Book Image id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $bookImage = $this->BookImages->get($id, [
            'contain' => ['Books'],
        ]);
        $this->Authorization->authorize($bookImage);

        $this->set(compact('bookImage'));
        $this->viewBuilder()-> setLayout('menufooter');
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $bookImage = $this->BookImages->newEmptyEntity();
        $this->Authorization->authorize($bookImage);
        if ($this->request->is('post')) {
            $bookImage = $this->BookImages->patchEntity($bookImage, $this->request->getData());


            if ($this->BookImages->save($bookImage)) {
                $this->Flash->success(__('The book image has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The book image could not be saved. Please, try again.'));
        }
        $books = $this->BookImages->Books->find('list', ['limit' => 200])->all();
        $this->set(compact('bookImage', 'books'));
        $this->viewBuilder()-> setLayout('menufooter');
    }

    /**
     * Edit method
     *
     * @param string|null $id Book Image id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $bookImage = $this->BookImages->get($id, [
            'contain' => [],
        ]);
        $this->Authorization->authorize($bookImage);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $bookImage = $this->BookImages->patchEntity($bookImage, $this->request->getData());

            if ($this->BookImages->save($bookImage)) {
                $this->Flash->success(__('The book image has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The book image could not be saved. Please, try again.'));
        }
        $books = $this->BookImages->Books->find('list', ['limit' => 200])->all();
        $this->set(compact('bookImage', 'books'));
        $this->viewBuilder()-> setLayout('menufooter');
    }

    /**
     * Delete method
     *
     * @param string|null $id Book Image id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bookImage = $this->BookImages->get($id);
        $this->Authorization->authorize($bookImage);
        if ($this->BookImages->delete($bookImage)) {
            $this->Flash->success(__('The book image has been deleted.'));
        } else {
            $this->Flash->error(__('The book image could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
