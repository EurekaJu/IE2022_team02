<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Interests Model
 *
 * @property \App\Model\Table\BooksTable&\Cake\ORM\Association\BelongsTo $Books
 *
 * @method \App\Model\Entity\Interest newEmptyEntity()
 * @method \App\Model\Entity\Interest newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Interest[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Interest get($primaryKey, $options = [])
 * @method \App\Model\Entity\Interest findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Interest patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Interest[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Interest|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Interest saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Interest[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Interest[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Interest[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Interest[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class InterestsTable extends Table
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

        $this->setTable('interests');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Books', [
            'foreignKey' => 'book_id',
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
            ->date('date')
            ->requirePresence('date', 'create')
            ->notEmptyDate('date');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email');

        $validator
            ->scalar('first_name')
            ->maxLength('first_name', 64)
            ->requirePresence('first_name', 'create')
            ->notEmptyString('first_name')
            ->add('first_name', 'validFormat',[ 'rule' => array('custom', '/^[a-zA-Z\s]*$/'), 'message' =>  __d('cake', 'Characters only') ]);

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 64)
            ->requirePresence('last_name', 'create')
            ->notEmptyString('last_name')
            ->add('last_name', 'validFormat',[ 'rule' => array('custom', '/^[a-zA-Z\s]*$/'), 'message' =>  __d('cake', 'Characters only') ]);

        $validator
            ->scalar('address')
            ->maxLength('address', 256)
            ->requirePresence('address', 'create')
            ->notEmptyString('address');

        $validator
            ->scalar('city')
            ->maxLength('city', 64)
            ->requirePresence('city', 'create')
            ->notEmptyString('city')
            ->add('city', 'validFormat',[ 'rule' => array('custom', '/^[a-zA-Z\s]*$/'), 'message' =>  __d('cake', 'Characters only') ]);
        
            $validator
            ->scalar('state')
            ->maxLength('state', 64)
            ->requirePresence('state', 'create')
            ->notEmptyString('state')
            ->add('state', 'validFormat',[ 'rule' => array('custom', '/^[a-zA-Z\s]*$/'), 'message' =>  __d('cake', 'Characters only') ]);

        $validator
            ->integer('postcode')
            ->requirePresence('postcode', 'create')
            ->notEmptyString('postcode')
            ->greaterThan('postcode',0,"Invalid postcode, value is lesser than zero")
            ->lessThan('postcode',999999999,"Invalid postcode, value is greater than 10 digits");

        $validator
            ->scalar('country')
            ->maxLength('country', 64)
            ->requirePresence('country', 'create')
            ->notEmptyString('country')
            ->add('country', 'validFormat',[ 'rule' => array('custom', '/^[a-zA-Z\s]*$/'), 'message' =>  __d('cake', 'Characters only') ]);

        $validator
            ->integer('book_id')
            ->allowEmptyString('book_id')
            ->requirePresence('book_id');

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

        return $rules;
    }
}
