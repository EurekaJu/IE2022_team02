<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Core\Configure;
use Cake\Mailer\Mailer;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Utility\Security;
use Cake\Routing\Router;
use Cake\Http\Client;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
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
        $users = $this->Users->find()->contain(['Enquiries', 'Orders']);

        $this->set(compact('users'));
        $this->viewBuilder()-> setLayout('menufooter');
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Articles', 'Enquiries', 'Orders'],
        ]);
        $this->Authorization->authorize($user);

        $this->set(compact('user'));
        $this->viewBuilder()-> setLayout('menufooter');
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */

    # MailChimp details


    public function add()
    {
        $this->Authorization->skipAuthorization();
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $postData = $this->request->getData();
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {

                $this->_addSubscriberToMailchimp(['email' => $user->email,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'mobile_number' => $user->mobile_number,
                    ]);

                $user = $this->Users->patchEntity($user, $this->request->getData());
                $recaptcha = $postData['g-recaptcha-response'];
                $google_url = "https://www.google.com/recaptcha/api/siteverify";
                $secret = Configure::consume('recaptcha_secret');
                $ip = $_SERVER['REMOTE_ADDR'];
                $url = $google_url . "?secret=" . $secret . "&response=" . $recaptcha;
                $http = new Client();

                $res = $http->get($url);

                $json = $res->getJson();

                if ($json['success'] == "true"){
                    $this->Flash->success(__('Sign up successful.'));
                    return $this->redirect(['action' => 'login']);}

            }else{
                $this->Flash->error(__('The user could not be saved. Please, try again.'));


            }

        }
        $recaptcha_user = Configure::consume('recaptcha_user');
        $this->set(compact('recaptcha_user'));
        $this->set(compact('user'));
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
    public function _addSubscriberToMailchimp($user = null)
    {
        $apiUsername = Configure::consume('mailchimp_username');
        $apiKey = Configure::consume('mailchimp_apiKey');
        $apiListId = Configure::consume('mailchimp_apiListId');
        $this->set(compact('apiUsername', 'apiKey','apiListId'));

        # If emtpy or the e-mail is not valid
        if (!$user ||  !filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        $user__Json = json_encode([
            'email_address' => $user['email'],
            'status' => 'subscribed', // "subscribed","unsubscribed","cleaned","pending"
            'merge_fields' => [
                'FNAME' => $user['first_name'],
                'LNAME' => $user['last_name'],
                'PHONE' => $user['mobile_number'],
            ]
        ]);


        $dataCenter = substr($apiKey, strpos($apiKey, '-') + 1);
        $url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $apiListId . '/members';

        $http = new Client();

        $http->post($url, $user__Json, [
            'auth' => [
                'username' => $apiUsername,
                'password' => $apiKey
            ],
            'type'  =>  'json'
        ]);

        return true;
    }
    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        $this->Authorization->authorize($user);

        $session2 = $this->request->getSession();
        $role = $session2->read('userRole');
        //redirect user if not staff
        if($role == 'customer'){
            $this->Flash->error('Access denied. Staff access only.');
            return $this->redirect(array('controller' => 'books','action'=>'home'));
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($role == 'absolute'){
            $user = $this->Users->patchEntity($user, $this->request->getData(),[
                // Added: Disable modification of user_id.
                'accessibleFields' => ['user_id' => false]
            ]);
            }
            else{
                $user = $this->Users->patchEntity($user, $this->request->getData(),[
                    // Added: Disable modification of user_id.
                    'accessibleFields' => ['user_id' => false, 'user_role' => false]
                ]);
            }

            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
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
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $user = $this->Users->get($id);
        $this->Authorization->authorize($user);
        $this->request->allowMethod(['post', 'delete']);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        $session = $this->request->getSession();
        $userRole = $session->read('userRole');
        if($userRole == 'customer') {
            $this->Authentication->logout();
            $session2 = $this->request->getSession();
            $session2->destroy();
            $this->Flash->success(__('Your account has been deleted.'));
            return $this->redirect(['controller' => 'Books', 'action' => 'home']);
        }

        return $this->redirect(['action' => 'index']);
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        $this->Authentication->addUnauthenticatedActions(['login']);
        $this->Authentication->addUnauthenticatedActions(['login', 'add', 'forgotpassword', 'resetpassword']);
    }

    public function login()
    {
        $this->Authorization->skipAuthorization();
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result && $result->isValid()) {

            $id = $this->Authentication->getIdentityData('id');
            $role = $this->Authentication->getIdentityData('role');
            $email = $this->Authentication->getIdentityData('email');
            if ($role == 'customer'){
                // redirect to /articles after login success
                $redirect = $this->redirect(array('controller'=>'users','action'=>'view', $id));
                $session2 = $this->request->getSession();
                $session2->write('userRole', $role);
                $session2->write('userId', $id);
                $session2->write('email', $email);
            }


            elseif ($role == 'absolute'||'editor'|| 'admin') {
                $redirect = $this->request->getQuery('redirect', [
                    'controller' => 'users',
                    'action' => 'index',
                ]);
                $session2 = $this->request->getSession();
                $session2->write('userRole', $role);
                $session2->write('userId', $id);
            }

            else {
                $session2->write('userRole', 'none');
            }

            return $this->redirect($redirect);
        }
        // display error if user submitted and authentication failed
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Invalid username or password'));
        }

        $this->viewBuilder()-> setLayout('menufooter');
    }

    public function logout()
    {
        $this->Authorization->skipAuthorization();
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result ->isValid()) {
            $this->Authentication->logout();
            $session2 = $this->request->getSession(); //destroy the session that stores the user's role and id
            $session2->destroy();
            return $this->redirect(['controller' => 'books', 'action' => 'home']);
        }
    }

    public function adminadd()
    {
        $this->Authorization->skipAuthorization();

        $session2 = $this->request->getSession();
        $role = $session2->read('userRole');
        //redirect user if not staff
        if($role == 'customer'||$role == 'admin'||$role == 'editor'){
            $this->Flash->error('Access denied. Absolute access only.');
            return $this->redirect(array('controller' => 'books','action'=>'home'));
        }
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
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

    public function customeredit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        $this->Authorization->authorize($user);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('You have changed your profile successfully.'));

                return $this->redirect(['action' => 'view', $user->id]);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
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

    public function forgotpassword() {
        $this->Authorization->skipAuthorization();
        $this->viewBuilder()-> setLayout('menufooter');

        $token = Security::hash(Security::randomBytes(25));

        if ($this->request->is('post')) {//submit email
            $emailReset =  $this->request->getData();
            $emailReset = $emailReset['emailReset'];

            $usersTable = $this->fetchTable('Users');

            $user = $usersTable->find('all')->where(['email'=>$emailReset])->first();

            //check if the user and email exists
            if(!$user) {
                $this->Flash->error('An account does not exist with this email address.');
                return $this->redirect(array('controller' => 'Users','action' => 'forgotpassword'));
            }
            else {
                $targetUser = $usersTable->get($user->id);
                $user->token = $token;

                if($usersTable->save($user)){
                    $this->Flash->success(__('Password reset next steps sent to email'));
                }
                else {
                    $this->Flash->error('Email reset failed');
                }

                $this->set(compact('token'));
                //Send email
                $mailer = new Mailer('default');

                $baseUrl = strval(Router::url('/',true));
                $new_pwd = $baseUrl."users/resetpassword/$user->token";

                //setup email parameters
                $mailer
                    ->setEmailFormat('html')
                    ->setTo($emailReset)
                    ->setFrom('margalyapress@u22s1002.monash-ie.me')
                    ->setSubject('Reset password - Margalya Press')
                    ->viewBuilder()
                    ->disableAutoLayout()
                    ->setTemplate('forgotpassword');
                //send data to the email template
                $mailer->setViewVars([ //variables we want to send to the email template
                    'email' => $emailReset,
                    'time_sent' => date("d/m/y"),
                    'token' => $token,
                    'new_pwd' => $new_pwd
                ]);

                //send email
                $email_result = $mailer->deliver();

                return $this->redirect(array('controller' => 'Books','action' => 'home'));
                $this->set(compact('emailReset'));
            }
        }
    }

    public function resetpassword($token) {

        $this->Authorization->skipAuthorization();
        $this->viewBuilder()-> setLayout('menufooter');

        if ($this->request->is('post')) {
            $pwd = $this->request->getData('newpassword');

            $userTables = $usersTable = $this->fetchTable('Users');
            $user = $usersTable->find('all')->where(['token' => $token])->first();

            $user->password = $pwd; //works (password hash is changed)

            if($usersTable->save($user)) {
                $this->Flash->success(__('Password reset successful. Please log in.'));
                return $this->redirect(array('controller' => 'Users','action' => 'login'));
            }
        }
    }
}
