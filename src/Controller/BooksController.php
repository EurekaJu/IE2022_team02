<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Books Controller
 *
 * @property \App\Model\Table\BooksTable $Books
 * @method \App\Model\Entity\Book[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BooksController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        // $books = $this->paginate($this->Books);

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

        $books = $this->Books->find();
        $this->set(compact('books'));
        $this->viewBuilder()-> setLayout('menufooter');
    }

    /**
     * View method
     *
     * @param string|null $id Book id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->Authorization->skipAuthorization();
        $book = $this->Books->get($id, [
            'contain' => ['Orders', 'BookImages', 'Interests', 'Videos'],
        ]);
        $this->set(compact('book'));
       $this->viewBuilder()->setLayout('menufooter');

        //get the video ID that has the same bookID
        $vid = $this->fetchTable('Videos')->find()->where(
            ['book_id' => $book->id]
        );
        $videoArray = array();
        foreach ($vid as $v) {
            if($v->book_id == $book->id) {
                $videoArray[$v->video] = $v->description;
            }
        }

        $this->set(compact('videoArray'));
    //add to cart
    if(! (isset($_SESSION['cart']))) { //isset checks for the existence of a variable
        $_SESSION['cart']= array(); //if cart session does not exist then create a session called cart
    }

    //check to see if form (add to cart) is submitted
    if( isset($_GET['pID'])) {
        $pID = $_GET['pID']; //name of the field in the form
        $cost = $_GET['cost']; //contains both price and book type
        $quan =  intval($_GET['quan']);

        $cost = explode(',', $cost); //split the book type and cost into arrays
        $booktype = $cost[0];
        $price = $cost[1];
        $title = $book->name;
        $image = $book->thumbnail_img;
        $volume = $book->volume;
        $status = $book->status;
        $deposit = $book->deposit;
        //combine book Id and type
        $pricetype = $pID .  '/'. $booktype;

        $finalCost = 0;
        //if status of book = pre-order, then finalcost is from database, if not then 50%. If not pre-order then finalcost=$price
        if($book->status == 'Pre-Order') {
            $finalPrice = $price * (($book->deposit)/100);
        }
        else {
            $finalPrice = $price;
        }

        //process the cart session and group the qtys together
        if(isset($_SESSION['cart'])) {
            if(isset($_SESSION['cart'][$pricetype])) { //book type is already in the array, update the qty
                $_SESSION['cart'][$pricetype]['quan'] += intval($quan); //increment
            }
            else { //if the book type is NOT in the array, add to cart
                $_SESSION['cart'][$pricetype] = array('pricetype' => $pricetype,'pID' => $pID, 'title' => $title, 'booktype' => $booktype, 'price' => $price, 'quan' => $quan, 'image' => $image, 'volume' => $volume, 'status'=>$status, 'finalPrice' => $finalPrice, 'deposit' => $deposit); //push the book details into the cart
            }
        }
        return $this->redirect(['controller' => 'books', 'action' => 'shoplist']);
        }

    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $book = $this->Books->newEmptyEntity();
        $this->Authorization->authorize($book);
        if ($this->request->is('post')) {
            $book = $this->Books->patchEntity($book, $this->request->getData());

            if ($this->Books->save($book)) {
                $this->Flash->success(__('The book has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The book could not be saved. Please, try again.'));
        }
        $orders = $this->Books->Orders->find('list', ['limit' => 200])->all();
        $this->set(compact('book', 'orders'));
        $this->viewBuilder()-> setLayout('menufooter');
    }

    /**
     * Edit method
     *
     * @param string|null $id Book id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $book = $this->Books->get($id, [
            'contain' => ['Orders'],
        ]);
        $this->Authorization->authorize($book);
        $thumb = $book['thumbnail_img'];
        if ($this->request->is(['patch', 'post', 'put'])) {
            $book = $this->Books->patchEntity($book, $this->request->getData());


            if ($this->Books->save($book)) {
                $this->Flash->success(__('The book has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The book could not be saved. Please, try again.'));
        }
        $orders = $this->Books->Orders->find('list', ['limit' => 200])->all();
        $this->set(compact('book', 'orders'));
        $this->viewBuilder()-> setLayout('menufooter');
    }

    /**
     * Delete method
     *
     * @param string|null $id Book id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $book = $this->Books->get($id, [
            'contain' => [],
        ]);
        $this->Authorization->authorize($book);
        $this->request->allowMethod(['post', 'delete']);
        $book = $this->Books->get($id);
        if ($this->Books->delete($book)) {
            $this->Flash->success(__('The book has been deleted.'));
        } else {
            $this->Flash->error(__('The book could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function home($id = null)
    {
        $this->Authorization->skipAuthorization();
        $books = $this->paginate($this->Books);

        $this->set(compact('books'));
        $this->viewBuilder()-> setLayout('menufooter');

        //get images
        $HomeImagesTable = $this->fetchTable('HomeImages')->find('all');
        foreach($HomeImagesTable as $h) {
            if($h->title == 'Banner 1') {
                $banner1 = $h;
                $banner1Img = '/img/' . $h['image'];
            }
            if($h->title == 'Banner 2') {
                $banner2 = $h;
                $banner2Img = '/img/' . $h['image'];
            }
        }
        $this->set(compact('banner1','banner2','banner1Img','banner2Img'));

        //GET GENRES
        //loop through all genres and store them (unique)
        $allgenres = array();

        foreach($books as $book) {
            array_push($allgenres, strtoupper($book->genre));
        }
        //get unique genres
        $uniqueGenres = array_unique(array_values($allgenres));
        $this->set(compact('allgenres','uniqueGenres'));

        //checking for the 'TIQQUNEI HA-ZOHAR' book status (if status='interest' then display in the menu)
        // foreach($books as $b) {
        //     if ($b->name == 'TIQQUNEI HA-ZOHAR') {
        //         $session = $this->request->getSession();
        //         $session->write('bookStatus', $b->status);
        //     }
        // }

        //displaying the articles
        $articles = $this->fetchTable('Articles')->find('all',['order' => ['Articles.created' => 'DESC']]);

        $i = 0;
        $top = array();
        //get the top 3 articles
        foreach($articles as $a) {
            if( $a->published == 1) {
                if($i < 3) {
                    array_push($top, $a);
                    $i++;
                }
                else {
                    break;
                }
            }
        }
        $this->set(compact('top'));

    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        $this->Authentication->addUnauthenticatedActions(['home', 'view', 'shoplist', 'about']);
    }

    public function shoplist($id = null)
    {
        $this->Authorization->skipAuthorization();
        $books = $this->paginate($this->Books);

        $this->viewBuilder()-> setLayout('menufooter');

        //GET GENRES
        //loop through all genres and store them (unique)
        $allgenres = array();
        array_push($allgenres,'ALL');

        foreach($books as $key => $value) {
            $allgenres[$value->id] = $value->genre;
            //array_push($allgenres, $book->genre);
        }
        //get unique genres
        $uniqueGenres = array_unique(array_values($allgenres));
        $this->set(compact('allgenres','uniqueGenres'));

        //SEARCH BAR
        $search_criteria = $this->request->getQuery();
        $query = $this->Books->find(); //base query

        $key = $this->request->getQuery('key');
        $genrefilter = $this->request->getQuery('genrefilter');

        if($search_criteria) {
            if($key) { //search bar
                $searched = $search_criteria['key'];
                $query->where(['OR' => [
                    'name'=>"%$searched%",
                    'volume LIKE'=>"%".$search_criteria['key']."%",
                    'keywords LIKE'=>'%'.$search_criteria['key'].'%',
                    'summary LIKE'=>'%'.$search_criteria['key'].'%',
                    'authors LIKE'=>'%'.$search_criteria['key'].'%',
                    'genre LIKE'=>'%'.$search_criteria['key'].'%',
                ]]);
                $books = $this->paginate($query);
            }
            if($genrefilter){//DROP DOWN GENRE FILTER
                $selected = $uniqueGenres[$search_criteria['genrefilter']]; //prints the correct selection
                $query->where([
                    'genre' => $selected
                ]);
                $books = $this->paginate($query);
            }
            else {
                $books = $this->paginate($query);
            }
        }
        else {
            $query = $this->Books;
            $books = $this->paginate($query);
        }

        $this->set(compact('books'));
    }

    public function about()
    {
        $this->Authorization->skipAuthorization();
        $books = $this->paginate($this->Books);

        $this->set(compact('books'));
        $this->viewBuilder()-> setLayout('menufooter');
    }

    public function cart()
    {
        $this->Authorization->skipAuthorization();
        $books = $this->Books->find();
        $this->set(compact('books'));

        $this->viewBuilder()-> setLayout('menufooter');

        //the cart page
        $session = $this->request->getSession();

        if(isset($_SESSION['cart'])) {

        //if the qty is updated
        if(isset($_GET['qty'])) {
            $pricetype = $_GET['pricetype'];
            $qty = $_GET['qty'];
            if(isset($_SESSION['cart'][$pricetype])) {
                $_SESSION['cart'][$pricetype]['quan'] = $qty;
            }
        }

        if(isset($_GET['RemovepID'])) { //if removing from cart
            if(!empty($_SESSION['cart'])) {
                $removeId = $_GET['RemovepID'];
                    unset($_SESSION['cart'][$removeId]);
                    $this->Flash->success(__('Successfully removed from cart.'));
                }
            }
                //calculating sum

        $sum = 0;
        foreach($_SESSION['cart'] as $c) {
            if(isset($c['finalPrice'])) {
            $sum += $c['finalPrice'] * $c['quan'];
            }
        }
        $this->set(compact('sum'));
    }

    if(isset($_SESSION['cart'])) {
        $session2 = $this->request->getSession();
        $session2->write('cart', $_SESSION['cart']);
        $sessioncart = $session2->read('cart'); //use this in checkout page

        $session2->write('totalsum', number_format((float) $sum, 2, '.', '')); //use this in checkout page
    }

        require '../vendor/autoload.php';
        \Stripe\Stripe::setApiKey('sk_test_51LclOqK2XRplstJPzPyN76YL2vSpExDGKVyMSRhv9j8KK1cYn2r9z3WHqDBOQCVrjNC3iW6UJzDdMifLxBkvlGIC00awRq0lYd');

        $session2 = $this->request->getSession();
        $shoppingcart = $session2->read('cart');
        $totalsum = $session2->read('totalsum');
        if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        //get the cart products and qtys for STRIPE
        foreach ($shoppingcart as $sc) {
            $line_items_array[] = array(
                'price_data' => array(
                    'currency' => 'aud',
                    'unit_amount' => number_format((float) $sc['finalPrice'], 2, '.', '') * 100,
                    'product_data' => array(
                        'name' => $sc['title'] . ' ' . $sc['booktype'] . ' Volume: ' . $sc['volume'] . '(Status: '.$sc['status'].')',
                    ),
                    'tax_behavior' => 'inclusive',
                ),
                'quantity' => $sc['quan'],
            );
        }
        $successURL = "https://" . $_SERVER['SERVER_NAME'] . '/margalyapress/orders/success/{CHECKOUT_SESSION_ID}';
        $cancelURL = "https://" . $_SERVER['SERVER_NAME'] . '/margalyapress/orders/cancel/';

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'shipping_address_collection' => [
                'allowed_countries' => ['AC', 'AD', 'AE', 'AF', 'AG', 'AI', 'AL', 'AM', 'AO', 'AQ', 'AR', 'AT', 'AU', 'AW', 'AX', 'AZ',
                    'BA', 'BB', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BL', 'BM', 'BN', 'BO', 'BQ', 'BR', 'BS', 'BT', 'BV', 'BW', 'BY', 'BZ',
                    'CA', 'CD', 'CF', 'CG', 'CH', 'CI', 'CK', 'CL', 'CM', 'CN', 'CO', 'CR', 'CV', 'CW', 'CY', 'CZ',
                    'DE', 'DJ', 'DK', 'DM', 'DO', 'DZ', 'EC', 'EE', 'EG', 'EH', 'ER', 'ES', 'ET',
                    'FI', 'FJ', 'FK', 'FO', 'FR',
                    'GA', 'GB', 'GD', 'GE', 'GF', 'GG', 'GH', 'GI', 'GL', 'GM', 'GN', 'GP', 'GQ', 'GR', 'GS', 'GT', 'GU', 'GW', 'GY',
                    'HK', 'HN', 'HR', 'HT', 'HU',
                    'ID', 'IE', 'IL', 'IM', 'IN', 'IO', 'IQ', 'IS', 'IT',
                    'JE', 'JM', 'JO', 'JP',
                    'KE', 'KG', 'KH', 'KI', 'KM', 'KN', 'KR', 'KW', 'KY', 'KZ',
                    'LA', 'LB', 'LC', 'LI', 'LK', 'LR', 'LS', 'LT', 'LU', 'LV', 'LY',
                    'MA', 'MC', 'MD', 'ME', 'MF', 'MG', 'MK', 'ML', 'MM', 'MN', 'MO', 'MQ', 'MR', 'MS', 'MT', 'MU', 'MV', 'MW', 'MX', 'MY', 'MZ',
                    'NA', 'NC', 'NE', 'NG', 'NI', 'NL', 'NO', 'NP', 'NR', 'NU', 'NZ', 'OM',
                    'PA', 'PE', 'PF', 'PG', 'PH', 'PK', 'PL', 'PM', 'PN', 'PR', 'PS', 'PT', 'PY', 'QA', 'RE', 'RO', 'RS', 'RU', 'RW',
                    'SA', 'SB', 'SC', 'SE', 'SG', 'SH', 'SI', 'SJ', 'SK', 'SL', 'SM', 'SN', 'SO', 'SR', 'SS', 'ST', 'SV', 'SX', 'SZ',
                    'TA', 'TC', 'TD', 'TF', 'TG', 'TH', 'TJ', 'TK', 'TL', 'TM', 'TN', 'TO', 'TR', 'TT', 'TV', 'TW', 'TZ',
                    'UA', 'UG', 'US', 'UY', 'UZ',
                    'VA', 'VC', 'VE', 'VG', 'VN', 'VU',
                    'WF', 'WS', 'XK', 'YE', 'YT', 'ZA', 'ZM', 'ZW','ZZ'],
            ],
            'line_items' => $line_items_array,
            'automatic_tax' => [
                'enabled' => true,
            ],
            'mode' => 'payment',
            'success_url' => $successURL,
            'cancel_url' => $cancelURL,
        ]);

        $this->set(compact('session'));
    }
    }
}
