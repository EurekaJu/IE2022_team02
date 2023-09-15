<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BookSubmissions Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\BookSubmission newEmptyEntity()
 * @method \App\Model\Entity\BookSubmission newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\BookSubmission[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BookSubmission get($primaryKey, $options = [])
 * @method \App\Model\Entity\BookSubmission findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\BookSubmission patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BookSubmission[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\BookSubmission|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BookSubmission saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BookSubmission[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\BookSubmission[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\BookSubmission[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\BookSubmission[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class BookSubmissionsTable extends Table
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

        $this->setTable('book_submissions');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
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
            ->integer('user_id')
            ->allowEmptyString('user_id');

        $validator
            ->scalar('full_name')
            ->maxLength('full_name', 256)
            ->requirePresence('full_name', 'create')
            ->notEmptyString('full_name')
            ->add('full_name', 'validFormat',[ 'rule' => array('custom', '/^[a-zA-Z\s]*$/'), 'message' =>  __d('cake', 'Characters only') ]);

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email');

        $validator
            ->dateTime('time_sent')
            ->notEmptyDateTime('time_sent');

        $validator
            ->scalar('title')
            ->maxLength('title', 256)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');
            
        $validator
            ->scalar('role')
            ->maxLength('role', 256)
            ->requirePresence('role', 'create')
            ->notEmptyString('role');

        $validator
            ->scalar('language')
            ->maxLength('language', 256)
            ->requirePresence('language', 'create')
            ->notEmptyString('language')
            ->add('language', 'validFormat',[ 'rule' => array('custom', '/^[a-zA-Z\s]*$/'), 'message' =>  __d('cake', 'Characters only') ]);

        $validator
            ->scalar('complete')
            ->maxLength('complete', 64)
            ->requirePresence('complete', 'create')
            ->notEmptyString('complete');

        $validator
            ->scalar('description')
            ->maxLength('description', 1000)
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->scalar('explanation')
            ->maxLength('explanation', 10000)
            ->requirePresence('explanation', 'create')
            ->notEmptyString('explanation');

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
