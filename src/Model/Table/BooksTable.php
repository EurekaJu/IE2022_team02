<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Books Model
 *
 * @property \App\Model\Table\BookImagesTable&\Cake\ORM\Association\HasMany $BookImages
 * @property \App\Model\Table\InterestsTable&\Cake\ORM\Association\HasMany $Interests
 * @property \App\Model\Table\VideosTable&\Cake\ORM\Association\HasMany $Videos
 * @property \App\Model\Table\OrdersTable&\Cake\ORM\Association\BelongsToMany $Orders
 *
 * @method \App\Model\Entity\Book newEmptyEntity()
 * @method \App\Model\Entity\Book newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Book[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Book get($primaryKey, $options = [])
 * @method \App\Model\Entity\Book findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Book patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Book[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Book|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Book saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Book[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Book[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Book[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Book[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class BooksTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('books');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'thumbnail_img' => [
                'fields' => [
                    'dir' => 'thumbnail_img_dir', // defaults to dir
                ],
                'path' => 'webroot{DS}img{DS}',
            ],
        ]);

        $this->hasMany('BookImages', [
            'foreignKey' => 'book_id',
        ]);
        $this->hasMany('Interests', [
            'foreignKey' => 'book_id',
        ]);
        $this->hasMany('Videos', [
            'foreignKey' => 'book_id',
        ]);
        $this->belongsToMany('Orders', [
            'foreignKey' => 'book_id',
            'targetForeignKey' => 'order_id',
            'joinTable' => 'books_orders',
        ]);

    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('name')
            ->maxLength('name', 64)
            ->requirePresence('name', 'create')
            ->allowEmptyString('name',"Please Enter Name of Book",false)
            ->notEmptyString('name');

//        $validator

//            ->add( 'thumbnail_img',[
//                'mimeType' => [
//                    'rule' => [ 'mimeType',[ 'name/jpg','name/png','name/jpeg']],
//                    'message' => 'Please Upload only jpg and png',
//                ],
//                'fileSize' => [
//                    'rule' => ['filesize','<=','10MB'],
//                    'message' => 'Image File must be lesser than 10MB'
//                ]])
//            ->scalar('thumbnail_img')
//            ->maxLength('thumbnail_img', 64)
//            ->requirePresence('thumbnail_img', 'create')
//            ->notEmptyString('thumbnail_img');

        $validator
            ->scalar('year_published')
            ->requirePresence('year_published', 'create')
            ->notEmptyString('year_published')
            ->greaterThan('year_published',0,"Invalid year, value is lesser than zero");;

        $validator
            ->scalar('summary')
            ->maxLength('summary', 10000)
            ->requirePresence('summary', 'create')
            ->notEmptyString('summary');

        $validator
            ->scalar('volume')
            ->maxLength('volume', 64)
            ->requirePresence('volume', 'create')
            ->notEmptyString('volume');

        $validator
            ->decimal('hardcover_price')
            ->requirePresence('hardcover_price', 'create')
            ->notEmptyString('hardcover_price')
            ->greaterThan('hardcover_price',0.00,"Invalid price, value is lesser than zero");

        $validator
            ->decimal('softcover_price')
            ->requirePresence('softcover_price', 'create')
            ->notEmptyString('softcover_price')
            ->greaterThan('softcover_price',0.00,"Invalid price, value is lesser than zero");

        $validator
            ->decimal('ebook_price')
            ->greaterThan('ebook_price',0.00,"Invalid price, value is lesser than zero");
//            ->requirePresence('ebook_price', 'create')
//            ->notEmptyString('ebook_price');

        $validator
            ->scalar('authors')
            ->maxLength('authors', 64)
            ->requirePresence('authors', 'create')
            ->notEmptyString('authors');

        $validator
            ->scalar('genre')
            ->maxLength('genre', 64)
            ->requirePresence('genre', 'create')
            ->notEmptyString('genre');

        $validator
            ->integer('hardcover_quantity')
            ->requirePresence('hardcover_quantity', 'create')
            ->greaterThan('hardcover_quantity',-1,"Invalid quantity, value is lesser than zero")
            ->notEmptyString('hardcover_quantity');

        $validator
        ->integer('softcover_quantity')
        ->requirePresence('softcover_quantity', 'create')
        ->greaterThan('softcover_quantity',-1,"Invalid quantity, value is lesser than zero")
        ->notEmptyString('softcover_quantity');

        $validator
            ->scalar('status')
            ->maxLength('status', 64)
            ->requirePresence('status', 'create')
            ->notEmptyString('status');

        $validator
        ->decimal('deposit')
        ->requirePresence('deposit', 'create')
        ->notEmptyString('deposit')
        ->greaterThan('deposit',0.99,"Invalid value, value is lesser than zero");

        $validator
            ->scalar('fulfillment_type')
            ->maxLength('fulfillment_type', 64)
            ->requirePresence('fulfillment_type', 'create')
            ->notEmptyString('fulfillment_type');

        $validator
            ->scalar('keywords')
            ->maxLength('keywords', 1000)
            ->requirePresence('keywords', 'create')
            ->notEmptyString('keywords');


        $validator
            ->scalar('additional_information')
            ->maxLength('additional_information', 2000)
            ->requirePresence('additional_information', 'create')
            ->notEmptyString('additional_information');


        return $validator;
    }
}
