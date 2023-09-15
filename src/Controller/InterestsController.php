<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Mailer\Mailer;
/**
 * Interests Controller
 *
 * @property \App\Model\Table\InterestsTable $Interests
 * @method \App\Model\Entity\Interest[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InterestsController extends AppController
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

        $interests = $this->Interests->find()->contain(['Books']);

        $this->set(compact('interests'));
        $this->viewBuilder()-> setLayout('menufooter');
    }

    /**
     * View method
     *
     * @param string|null $id Interest id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $interest = $this->Interests->get($id, [
            'contain' => ['Books'],
        ]);
        $this->Authorization->authorize($interest);

        $this->set(compact('interest'));
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
        $interest = $this->Interests->newEmptyEntity();
        if ($this->request->is('post')) {
            $interest = $this->Interests->patchEntity($interest, $this->request->getData());
            if ($this->Interests->save($interest)) {

                //getting book name
                // $books = $this->fetchTable('Books')->find();
                // foreach($interests as $i) {
                //     foreach($books as $b){
                //         if($b->id == $i->book_id) {
                //             $bookname = $b->name;
                //             $bookstatus = $b->status;
                //         }
                //     }
                // }

                //setup email to margalya press
                $mailer = new Mailer('default');
                // //setup email parameters
                $mailer
                    ->setEmailFormat('html')
                    ->setTo('lpha0014@student.monash.edu') //->setTo('margalyapress@u22s1002.monash-ie.me')
                    ->setFrom($interest->email)
                    ->setSubject('Registration of Interest from ' . h($interest->first_name) . ' ' . h($interest->last_name) ." <" . h($interest->email) . ">")
                    ->viewBuilder()
                    ->disableAutoLayout()
                        ->setTemplate('interests');

                $full_name = $interest->first_name . ' ' . $interest->last_name;
                $fulladdress = $interest->address . ', ' . $interest->city . ' ' . $interest->postcode . ', ' . $interest->country;
                //send data to the email template
                $mailer->setViewVars([ //variables we want to send to the email template
                    // 'content' => $bookname,
                    'full_name' => $full_name,
                    'address' => $fulladdress,
                    'email' => $interest->email,
                    'date' => date("yy-m-d"),
                    'id' => $interest->id
                ]);
                //send email
                $email_result = $mailer->deliver();

                if ($email_result) {
                    $this->Interests->save($interest);
                    $this->Flash->success(__('Your interest has been submitted.'));
                } else {
                    $this->Flash->error(__('Interest failed to send.'));
                }

                //$this->Flash->success(__('The interest has been saved.'));

                return $this->redirect(['action' => '../Books/home']);
            }
            $this->Flash->error(__('The interest could not be saved due to a validation error. Please, try again.'));
        }
        $books = $this->Interests->Books->find('list', ['limit' => 200])->all();
        $this->set(compact('interest', 'books'));

        $booksTable = $this->fetchTable('Books')->find();

        $booksInterest = array();
        //get the TIQQUNEI HA-ZOHAR book for interest registration (and link to db)
        foreach($booksTable as $key => $value) {
            if($value->name == 'TIQQUNEI HA-ZOHAR' && $value->status == 'interest'){ //key and value
                $booksInterest[$value->id] =  $value->name;
                $bookId = $value->id;
                $bookstatus = $value->status;
                $this->set(compact('booksInterest','bookId','bookstatus'));
            }
        }

        //countries dropdown
        $countrystates = json_decode(file_get_contents(WWW_ROOT."countrystate.json"), true);

        $sessionCS = $this->request->getSession();
        $sessionCS->write('CountryState', $countrystates);
        $CountryState = $sessionCS->read('CountryState');

        //get the individual countries
        $counter = 0;
        $country = array();
        foreach($CountryState as $cs) {
            while($counter < 191) {
            $countries[$cs[$counter]['country']] = $cs[$counter]['country']; //all countries
            $counter++;
        }
        $this->set(compact('countries'));
        }
        $this->viewBuilder()-> setLayout('menufooter');
    }

    /**
     * Edit method
     *
     * @param string|null $id Interest id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $interest = $this->Interests->get($id, [
            'contain' => [],
        ]);
        $this->Authorization->authorize($interest);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $interest = $this->Interests->patchEntity($interest, $this->request->getData());
            if ($this->Interests->save($interest)) {
                $this->Flash->success(__('The interest has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The interest could not be saved. Please, try again.'));
        }
        $books = $this->Interests->Books->find('list', ['limit' => 200])->all();
        $this->set(compact('interest', 'books'));
        $this->viewBuilder()-> setLayout('menufooter');

        //countries dropdown
        $countrystates = json_decode(file_get_contents(WWW_ROOT."countrystate.json"), true);

        $sessionCS = $this->request->getSession();
        $sessionCS->write('CountryState', $countrystates);
        $CountryState = $sessionCS->read('CountryState');

        //get the individual countries
        $counter = 0;
        $country = array();
        foreach($CountryState as $cs) {
            while($counter < 191) {
            $countries[$cs[$counter]['country']] = $cs[$counter]['country']; //all countries
            $counter++;
        }
        $this->set(compact('countries'));
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Interest id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $interest = $this->Interests->get($id);
        $this->Authorization->authorize($interest);
        if ($this->Interests->delete($interest)) {
            $this->Flash->success(__('The interest has been deleted.'));
        } else {
            $this->Flash->error(__('The interest could not be deleted. Please, try again.'));
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
