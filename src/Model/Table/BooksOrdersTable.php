<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BooksOrders Model
 *
 * @property \App\Model\Table\BooksTable&\Cake\ORM\Association\BelongsTo $Books
 * @property \App\Model\Table\OrdersTable&\Cake\ORM\Association\BelongsTo $Orders
 *
 * @method \App\Model\Entity\BooksOrder newEmptyEntity()
 * @method \App\Model\Entity\BooksOrder newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\BooksOrder[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BooksOrder get($primaryKey, $options = [])
 * @method \App\Model\Entity\BooksOrder findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\BooksOrder patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BooksOrder[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\BooksOrder|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BooksOrder saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BooksOrder[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\BooksOrder[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\BooksOrder[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\BooksOrder[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class BooksOrdersTable extends Table
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

        $this->setTable('books_orders');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Books', [
            'foreignKey' => 'book_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Orders', [
            'foreignKey' => 'order_id',
            'joinType' => 'INNER',
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
            ->integer('book_id')
            ->requirePresence('book_id', 'create')
            ->notEmptyString('book_id');

        $validator
            ->integer('order_id')
            ->requirePresence('order_id', 'create')
            ->notEmptyString('order_id');

        $validator
            ->integer('quantity')
            ->requirePresence('quantity', 'create')
            ->notEmptyString('quantity');

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
        $rules->add($rules->existsIn('book_id', 'Books'), ['errorField' => 'book_id']);
        $rules->add($rules->existsIn('order_id', 'Orders'), ['errorField' => 'order_id']);

        return $rules;
    }
}
