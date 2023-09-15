<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Orders Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\BooksTable&\Cake\ORM\Association\BelongsToMany $Books
 *
 * @method \App\Model\Entity\Order newEmptyEntity()
 * @method \App\Model\Entity\Order newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Order[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Order get($primaryKey, $options = [])
 * @method \App\Model\Entity\Order findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Order patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Order[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Order|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Order saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Order[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Order[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Order[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Order[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class OrdersTable extends Table
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

        $this->setTable('orders');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
        ]);
        $this->belongsToMany('Books', [
            'foreignKey' => 'order_id',
            'targetForeignKey' => 'book_id',
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
            ->scalar('reference_number')
            ->maxLength('reference_number', 14)
            ->requirePresence('reference_number', 'create')
            ->notEmptyString('reference_number');

        $validator
            ->scalar('customer_name')
            ->maxLength('customer_name', 256)
            ->requirePresence('customer_name', 'create')
            ->notEmptyString('customer_name')
            ->add('customer_name', 'validFormat',[ 'rule' => array('custom', '/^[a-zA-Z\s]*$/'), 'message' =>  __d('cake', 'Characters only') ]);;

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email');

        $validator
            ->decimal('full_amount')
            ->requirePresence('full_amount', 'create')
            ->notEmptyString('full_amount');

        $validator
            ->date('date')
            ->requirePresence('date', 'create')
            ->notEmptyDate('date');

        $validator
            ->scalar('address')
            ->maxLength('address', 256)
            ->requirePresence('address', 'create')
            ->notEmptyString('address');

        $validator
            ->scalar('currency')
            ->maxLength('currency', 64)
            ->requirePresence('currency', 'create')
            ->notEmptyString('currency');

        $validator
            ->scalar('status')
            ->maxLength('status', 64)
            ->requirePresence('status', 'create')
            ->notEmptyString('status');

        $validator
            ->dateTime('time')
            ->notEmptyDateTime('time');

        $validator
            ->integer('user_id')
            ->allowEmptyString('user_id');

        $validator
            ->integer('user_id')
            ->allowEmptyString('user_id');
        $validator
            ->scalar('book_notes')
            ->maxLength('book_notes', 256)
            ->requirePresence('book_notes', 'create')
            ->notEmptyString('book_notes');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('user_id', 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
