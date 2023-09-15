<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Mailer\Mailer;
use App\Model\Table\OrdersTable;
use Cake\ORM\TableRegistry;
use http\Url;

/**
 * Orders Controller
 *
 * @property \App\Model\Table\OrdersTable $Orders
 * @property \App\Model\Table\BooksOrdersTable $BooksOrders
 * @method \App\Model\Entity\Order[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OrdersController extends AppController
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
        // $orders = $this->paginate($this->Orders);

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

        $orders = $this->Orders->find()->contain(['Users']);

        $this->set(compact('orders'));
        $this->viewBuilder()-> setLayout('menufooter');
    }

    /**
     * View method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $order = $this->Orders->get($id, [
            'contain' => ['Users', 'Books'],
        ]);
        $this->Authorization->authorize($order);

        $this->set(compact('order'));
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
        $order = $this->Orders->newEmptyEntity();
        if ($this->request->is('post')) {
            $order = $this->Orders->patchEntity($order, $this->request->getData());
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order could not be saved. Please, try again.'));
        }
        $users = $this->Orders->Users->find('list', ['limit' => 200])->all();
        $books = $this->Orders->Books->find('list', ['limit' => 200])->all();
        $this->set(compact('order', 'users', 'books'));
        $this->viewBuilder()-> setLayout('menufooter');
    }

    /**
     * Edit method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $order = $this->Orders->get($id, [
            'contain' => ['Books'],
        ]);
        $this->Authorization->authorize($order);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $order = $this->Orders->patchEntity($order, $this->request->getData());
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order could not be saved. Please, try again.'));
        }
        $users = $this->Orders->Users->find('list', ['limit' => 200])->all();
        $books = $this->Orders->Books->find('list', ['limit' => 200])->all();
        //get the names of the users
        $usersTable = $this->fetchTable('Users')->find();
        $usernames = array();
        foreach($usersTable as $u) {
            if($u->role == 'customer') {
                $usernames[$u->id] = $u->first_name . ' ' . $u->last_name;
            }
        }
        $this->set(compact('order', 'users', 'books','usernames'));
        $this->viewBuilder()-> setLayout('menufooter');
    }

    /**
     * Delete method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $order = $this->Orders->get($id);
        $this->Authorization->authorize($order);
        if ($this->Orders->delete($order)) {
            $this->Flash->success(__('The order has been deleted.'));
        } else {
            $this->Flash->error(__('The order could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function cancel($id = null)
    {
        $this->Authorization->skipAuthorization();
        $orders = $this->Orders->find()->contain(['Users']);

        $this->set(compact('orders'));
        $this->viewBuilder()-> setLayout('menufooter');
    }
    public function success($id = null)
    {
        $this->Authorization->skipAuthorization();
        $orders = $this->Orders->find()->contain(['Users']);



        $this->set(compact('orders'));
        $this->viewBuilder()-> setLayout('menufooter');

        $stripe = new \Stripe\StripeClient(
            'sk_test_51LclOqK2XRplstJPzPyN76YL2vSpExDGKVyMSRhv9j8KK1cYn2r9z3WHqDBOQCVrjNC3iW6UJzDdMifLxBkvlGIC00awRq0lYd'
            );

            $sessionID = basename($_SERVER["REQUEST_URI"]);
            $checkoutdetails = $stripe->checkout->sessions->retrieve(
                $sessionID,
                []
              );
            // echo "<pre>";
            //echo $checkoutdetails; //print out the session
        if(isset($_SESSION['cart'])) {

            //SAVE INTO ORDERS TABLE
            //get data from the Stripe Checkout session
            $customerEmail = $checkoutdetails['customer_details']['email']; //email
            $customerName = $checkoutdetails['customer_details']['name'];
            $amountTotal = number_format((float)$checkoutdetails['amount_total'], 2, '.', '') / 100;// full_amount
            $currency = $checkoutdetails['currency'];
            //$subTotal = number_format((float) $checkoutdetails['amount_subtotal'], 2, '.', '')/100;
            $paymentStatus = $checkoutdetails["payment_status"]; //e.g. Paid
            //$status= $checkoutdetails["status"]; //e.g. "complete"
            $taxAmount = number_format((float)$checkoutdetails["total_details"]["amount_tax"], 2, '.', '') / 100;;
            $customerAddress = $checkoutdetails['customer_details']['address'];

            $customerAddress = $customerAddress['line1'] . ', ' . $customerAddress['city'] . ', ' . $customerAddress['province'] . ', ' . $customerAddress['state'] . ', ' . $customerAddress['postal_code'] . ', ' . $customerAddress['country'];//Address

            //Save to orders table
            $sessionAuth = $this->request->getSession();
            $userID = $sessionAuth->read('Auth');
            $userID = $userID['id'];

            $session2 = $this->request->getSession();
            $shoppingcart = $session2->read('cart');

            $referenceNo = time() . rand(10 * 45, 100 * 98);
            $newarray = array();
            $orderTable = $this->fetchTable('Orders');
            $order = $this->Orders->newEmptyEntity();
            $order->reference_number = $referenceNo;
            $order->customer_name = $customerName;
            $order->email = $customerEmail;
            $order->full_amount = $amountTotal;
            $order->date = date("d/m/y");
            $order->address = $customerAddress;
            $order->currency = $currency;
            $order->status = $paymentStatus;
            $order->user_id = $userID;
            $bookNotes = array();
            foreach ($shoppingcart as $sc) {
                array_push($bookNotes, $sc['title'] . ' ' . $sc['booktype'] . ' Volume:' . $sc['volume'] . ' (Status: ' . $sc['status'] . ') ' . 'Quantity: ' . $sc['quan'] . ', Original Price: $' . $sc['price'] . ', Final price: $' . $sc['finalPrice']);
            }
            $order->book_notes = implode(" | ", $bookNotes);


            if ($orderTable->save($order)) {
                $id = $order->id;

            }


            $anybooksorder = $this->fetchTable('BooksOrders');
            $record = $anybooksorder->newEmptyEntity();
            $record->order_id = $id;
            foreach ($shoppingcart as $sc) {
                array_push($bookNotes, $sc['title'] . ' ' . $sc['booktype'] . ' Volume:' . $sc['volume'] . ' (Status: ' . $sc['status'] . ') ' . 'Quantity: ' . $sc['quan']);
            }
            $record->quantity = $sc['quan'];
            $record->book_id = $sc['pID'];
            if ($anybooksorder->save($record)) {
                $id = $record->id;
            }

            //get the ordered_book_notes
            $bookNotes = array();
            foreach ($shoppingcart as $sc) {
                array_push($bookNotes, $sc['title'] . ' ' . $sc['booktype'] . ' Volume:' . $sc['volume'] . ' (Status: ' . $sc['status'] . ')');
            }

            //SAVE DATA INTO BOOKS_ORDERS table --> need to add a new record for EACH BOOK id (pID)
            //get data from the shopping cart session (for the books)
            $productArray = array();
            foreach ($shoppingcart as $sc) {
                $productArray[$sc['pricetype']] = array('pID' => $sc['pID'], 'quan' => $sc['quan'], 'booktype' => $sc['booktype']);
            }


            $booksTable = $this->fetchTable('Books');
            foreach ($productArray as $id => $val) {
                $targetProducts = $booksTable->find()->where(
                    ['id' => $val['pID']]
                );
                foreach ($targetProducts as $targetProduct) { //for each book id
                    //if hardcover
                    if ($val['booktype'] == "'Hard cover'") {
                        $targetProduct->hardcover_quantity = $targetProduct->hardcover_quantity - $val['quan'];
                    }
                    //if softcover
                    if ($val['booktype'] == "'Soft cover'") {
                        $targetProduct->softcover_quantity = $targetProduct->softcover_quantity - $val['quan'];
                    }
                    //if ebook - no action (no qty for ebooks available)
                }
                $booksTable->saveMany($targetProducts);
            }

            //EMAILING invoice to customer and margalya press
            $mailer = new Mailer('default');
            //setup email parameters
            $mailer
                ->setEmailFormat('html')
                ->setTo($customerEmail) //to the customer
                ->addTo('lpha0014@student.monash.edu') //margalya press also receives email
                ->setFrom('margalyapress@u22s1002.monash-ie.me') //from margalya press
                ->setSubject('Book Order Invoice - Margalya Press ' . " <" . h($customerName) . " (" . h($customerEmail) . ")>")
                ->viewBuilder()
                ->disableAutoLayout()
                ->setTemplate('invoice');

            //send data to the email template
            $mailer->setViewVars([
                // 'content' => $enquiry->body,
                'referenceNo' => $referenceNo,
                'full_name' => $customerName,
                'email' => $customerEmail,
                'address' => $customerAddress,
                'date' => date("d/m/y"),
                'amountTotal' => number_format((float)$amountTotal, 2, '.', ''),
                'taxAmount' => number_format((float)$taxAmount, 2, '.', ''),
                'paymentStatus' => $paymentStatus,
                'shoppingcart' => $shoppingcart,
                'id' => $order->id
            ]);
            //send email
            $email_result = $mailer->deliver();

            //clear cart after
            unset($_SESSION['cart']);

        }

        }

}


