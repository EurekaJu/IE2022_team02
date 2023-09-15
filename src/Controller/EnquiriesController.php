<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Mailer\Mailer;

/**
 * Enquiries Controller
 *
 * @property \App\Model\Table\EnquiriesTable $Enquiries
 * @method \App\Model\Entity\Enquiry[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EnquiriesController extends AppController
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

        $enquiry = $this->Enquiries->find()->contain(['Users']);

        $this->set(compact('enquiry'));
        $this->viewBuilder()-> setLayout('menufooter');
    }

    /**
     * View method
     *
     * @param string|null $id Enquiry id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $enquiry = $this->Enquiries->get($id, [
            'contain' => ['Users'],
        ]);
        $this->Authorization->authorize($enquiry);

        $this->set(compact('enquiry'));
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
        $enquiry = $this->Enquiries->newEmptyEntity();
        if ($this->request->is('post')) {
            $enquiry = $this->Enquiries->patchEntity($enquiry, $this->request->getData());
            if ($this->Enquiries->save($enquiry)) {
                $this->Flash->success(__('The enquiry has been saved.'));
                //Send email
                $mailer = new Mailer('default');
                //setup email parameters
                $mailer
                    ->setEmailFormat('html')
                    ->setTo('lpha0014@student.monash.edu')
                    ->setFrom($enquiry->email)
                    ->setSubject('New enquiry from ' . h($enquiry->full_name) . " <" . h($enquiry->email) . ">")
                    ->viewBuilder()
                    ->disableAutoLayout()
                        ->setTemplate('enquiries');

                //print_r('here');
                //send data to the email template
                $mailer->setViewVars([ //variables we want to send to the email template
                    'content' => $enquiry->body,
                    'full_name' => $enquiry->full_name,
                    'email' => $enquiry->email,
                    'time_sent' => date("d/m/y"),
                    'id' => $enquiry->id
                ]);

                //send email
                $email_result = $mailer->deliver();

                if ($email_result) {
                    //$enquiry->resolved = ($resolved) ? true : false;
                    $this->Enquiries->save($enquiry);
                    $this->Flash->success(__('Your enquiry has been submitted.'));
                } else {
                    $this->Flash->error(__('Enquiry failed to send.'));
                }

                return $this->redirect(['action' => '../Books/home']);

            }
            $this->Flash->error(__('The enquiry could not be saved. Please, try again.'));
        }
        $users = $this->Enquiries->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('enquiry', 'users'));
        $this->viewBuilder()-> setLayout('menufooter');
    }

    /**
     * Edit method
     *
     * @param string|null $id Enquiry id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $enquiry = $this->Enquiries->get($id, [
            'contain' => [],
        ]);
        $this->Authorization->authorize($enquiry);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $enquiry = $this->Enquiries->patchEntity($enquiry, $this->request->getData(), [
                // Added: Disable modification of user_id.
                'accessibleFields' => ['user_id' => false]
            ]);
            if ($this->Enquiries->save($enquiry)) {
                $this->Flash->success(__('The enquiry has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The enquiry could not be saved. Please, try again.'));
        }
        $users = $this->Enquiries->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('enquiry', 'users'));
        $this->viewBuilder()-> setLayout('menufooter');
    }

    /**
     * Delete method
     *
     * @param string|null $id Enquiry id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $enquiry = $this->Enquiries->get($id);
        $this->Authorization->authorize($enquiry);
        if ($this->Enquiries->delete($enquiry)) {
            $this->Flash->success(__('The enquiry has been deleted.'));
        } else {
            $this->Flash->error(__('The enquiry could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        $this->Authentication->addUnauthenticatedActions(['add', 'view']);
    }
}
