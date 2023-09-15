<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Articles Controller
 *
 * @property \App\Model\Table\ArticlesTable $Articles
 * @method \App\Model\Entity\Article[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ArticlesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        // $this->paginate = [
        //     'contain' => ['Users'],
        // ];
        // $articles = $this->paginate($this->Articles);

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


        $articles = $this->Articles->find()->contain(['Users']);
        $this->set(compact('articles'));
        $this->viewBuilder()-> setLayout('menufooter');
    }

    /**
     * View method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->Authorization->skipAuthorization();
        $article = $this->Articles->get($id, [
            'contain' => [],
        ]);
        $this->set(compact('article'));
        $this->viewBuilder()-> setLayout('menufooter');
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $article = $this->Articles->newEmptyEntity();
        $this->Authorization->authorize($article);
        if ($this->request->is('post')) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());

            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The article could not be saved. Please, try again.'));
        }
        $users = $this->Articles->Users->find('list', ['limit' => 200])->all();
        $fname = $this->Articles->Users->find()->where(['role !=' => 'customer']);
        $names = array();
        foreach($fname as $f) {
            $fullname = $f->first_name . ' ' . $f->last_name;
            $id = $f->id;
            $names[$id] = $fullname;
        }

        $this->set(compact('article', 'users','names'));
        $this->viewBuilder()-> setLayout('menufooter');
    }

    /**
     * Edit method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $article = $this->Articles->get($id, [
            'contain' => [],
        ]);
        $this->Authorization->authorize($article);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());

            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The article could not be saved. Please, try again.'));
        }
        $users = $this->Articles->Users->find('list', ['limit' => 200])->all();
        $usersTable = $this->fetchTable('Users')->find();
        $usernames = array();
        foreach($usersTable as $u) {
            if($u->role != 'customer') {
                $usernames[$u->id] = $u->first_name . ' ' . $u->last_name;
            }
        }
        $this->set(compact('article', 'users','usernames'));
        $this->viewBuilder()-> setLayout('menufooter');
    }

    /**
     * Delete method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $article = $this->Articles->get($id, [
            'contain' => [],
        ]);
        $this->Authorization->authorize($article);

        $this->request->allowMethod(['post', 'delete']);
        $article = $this->Articles->get($id);
        if ($this->Articles->delete($article)) {
            $this->Flash->success(__('The article has been deleted.'));
        } else {
            $this->Flash->error(__('The article could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function home()
    {
        $this->paginate = [
            'contain' => ['Users'],
        ];
        $articles = $this->paginate($this->Articles);
        $this->Authorization->skipAuthorization();

        $this->set(compact('articles'));
        $this->viewBuilder()-> setLayout('menufooter');
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        $this->Authentication->addUnauthenticatedActions(['home', 'view']);
    }
}
