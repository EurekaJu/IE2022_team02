<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Mailer\Mailer;

/**
 * BookSubmissions Controller
 *
 * @property \App\Model\Table\BookSubmissionsTable $BookSubmissions
 * @method \App\Model\Entity\BookSubmission[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BookSubmissionsController extends AppController
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
        // $bookSubmissions = $this->paginate($this->BookSubmissions);

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

        $bookSubmissions = $this->BookSubmissions->find()->contain(['Users']);

        $this->set(compact('bookSubmissions'));
        $this->viewBuilder()-> setLayout('menufooter');
    }

    /**
     * View method
     *
     * @param string|null $id Book Submission id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $bookSubmission = $this->BookSubmissions->get($id, [
            'contain' => ['Users'],
        ]);
        $this->Authorization->authorize($article);

        $this->set(compact('bookSubmission'));
        $this->viewBuilder()-> setLayout('menufooter');
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->Authorization->skipAuthorization();
        $bookSubmission = $this->BookSubmissions->newEmptyEntity();

        if ($this->request->is('post')) {
            $bookSubmission = $this->BookSubmissions->patchEntity($bookSubmission, $this->request->getData());
            if ($this->BookSubmissions->save($bookSubmission)) {

                //email
                $mailer = new Mailer('default');
                // //setup email parameters
                $mailer
                    ->setEmailFormat('html')
                    ->setTo('lpha0014@student.monash.edu') //->setTo('margalyapress@u22s1002.monash-ie.me')
                    ->setFrom($bookSubmission->email)
                    ->setSubject('Book Submission from ' . h($bookSubmission->full_name) . " <" . h($bookSubmission->email) . ">")
                    ->viewBuilder()
                    ->disableAutoLayout()
                        ->setTemplate('submissions');

                //send data to the email template
                $mailer->setViewVars([ //variables we want to send to the email template
                    // 'content' => $bookname,
                    'full_name' => $bookSubmission->full_name,
                    'email' => $bookSubmission->email,
                    'date' => date("d-m-yy"),
                    'title' => $bookSubmission->title,
                    'role' => $bookSubmission->role,
                    'language' => $bookSubmission->language,
                    'complete' => $bookSubmission->complete,
                    'description' => $bookSubmission->description,
                    'explanation' => $bookSubmission->explanation,
                    'id' => $bookSubmission->id
                ]);
                //send email
                $email_result = $mailer->deliver();

                if ($email_result) {
                    $this->BookSubmissions->save($bookSubmission);
                    $this->Flash->success(__('Your interest has been submitted.'));
                } else {
                    $this->Flash->error(__('Interest failed to send.'));
                }

                $this->Flash->success(__('The book submission has been saved.'));
                return $this->redirect(['controller' => 'Books', 'action' => 'home']);
            }
            $this->Flash->error(__('The book submission could not be saved. Please, try again.'));
        }
        $users = $this->BookSubmissions->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('bookSubmission', 'users'));

        $this->viewBuilder()-> setLayout('menufooter');

    }

    /**
     * Edit method
     *
     * @param string|null $id Book Submission id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $bookSubmission = $this->BookSubmissions->get($id, [
            'contain' => [],
        ]);
        $this->Authorization->authorize($bookSubmission);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $bookSubmission = $this->BookSubmissions->patchEntity($bookSubmission, $this->request->getData());
            if ($this->BookSubmissions->save($bookSubmission)) {
                $this->Flash->success(__('The book submission has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The book submission could not be saved. Please, try again.'));
        }
        $users = $this->BookSubmissions->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('bookSubmission', 'users'));

        $this->viewBuilder()-> setLayout('menufooter');
    }

    /**
     * Delete method
     *
     * @param string|null $id Book Submission id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bookSubmission = $this->BookSubmissions->get($id);
        $this->Authorization->authorize($bookSubmission);
        if ($this->BookSubmissions->delete($bookSubmission)) {
            $this->Flash->success(__('The book submission has been deleted.'));
        } else {
            $this->Flash->error(__('The book submission could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        $this->Authentication->addUnauthenticatedActions(['add']);
    }
}
