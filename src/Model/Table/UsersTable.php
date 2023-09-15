<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use http\Message;

/**
 * Users Model
 *
 * @property \App\Model\Table\ArticlesTable&\Cake\ORM\Association\HasMany $Articles
 * @property \App\Model\Table\EnquiriesTable&\Cake\ORM\Association\HasMany $Enquiries
 * @property \App\Model\Table\OrdersTable&\Cake\ORM\Association\HasMany $Orders
 *
 * @method \App\Model\Entity\User newEmptyEntity()
 * @method \App\Model\Entity\User newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Articles', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Enquiries', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Orders', [
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
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email',"Please enter a valid email address");

        $validator
            ->scalar('password')
            ->maxLength('password', 64)
            ->requirePresence('password', 'create')
            ->notEmptyString('password',"Please enter a password for the user")
            ->add('password', 'validFormat',[ 'rule' => array('custom', '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/'), 'message' =>  __d('cake', 'Minimum eight characters, at least one capital and lowercase letter, one number and one special character required.') ]);

        $validator
            ->scalar('first_name')
            ->maxLength('first_name', 64)
            ->requirePresence('first_name', 'create')
            ->notEmptyString('first_name',"Please enter the first name of user")
            ->add('first_name', 'validFormat',[ 'rule' => array('custom', '/^[a-zA-Z\s]*$/'), 'message' =>  __d('cake', 'Please enter texts only') ]);

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 64)
            ->requirePresence('last_name', 'create')
            ->notEmptyString('last_name',"Please enter the first name of user")
            ->add('last_name', 'validFormat',[ 'rule' => array('custom', '/^[a-zA-Z\s]*$/'), 'message' =>  __d('cake', 'Please enter texts only') ]);

        $validator
            ->scalar('mobile_number')
            ->maxLength('mobile_number', 15)
            ->requirePresence('mobile_number', 'create')
            ->notEmptyString('mobile_number',"Please enter the area code and mobile number of user")
            ->add('mobile_number', 'validFormat',[ 'rule' => array('custom', '/([0-9\s\-]{7,})(?:\s*(?:#|x\.?|ext\.?|extension)\s*(\d+))?$/'), 'message' =>  __d('cake', 'Please enter numbers and area code only') ]);


        $validator
            ->integer('street_number')
            ->requirePresence('street_number', 'create')
            ->notEmptyString('street_number',"Please enter the street number");

        $validator
            ->scalar('street_name')
            ->maxLength('street_name', 256)
            ->requirePresence('street_name', 'create')
            ->notEmptyString('street_name',"Please enter the street name");

        $validator
            ->scalar('suburb')
            ->maxLength('suburb', 64)
            ->requirePresence('suburb', 'create')
            ->notEmptyString('suburb',"Please enter the suburb");

        $validator
            ->scalar('city')
            ->maxLength('city', 64)
            ->requirePresence('city', 'create')
            ->notEmptyString('city',"Please enter the city")
            ->add('city', 'validFormat',[ 'rule' => array('custom', '/^[a-zA-Z\s]*$/'), 'message' =>  __d('cake', 'Please enter texts only') ]);

        $validator
            ->integer('postcode')
            ->requirePresence('postcode', 'create')
            ->notEmptyString('postcode',"Please enter the postcode")
            ->greaterThan('postcode',0,"Please enter a postcode greater than 0")
            ->lessThan('postcode',999999999,"Please enter a postcode less than 10 digits");

        $validator
            ->scalar('state')
            ->maxLength('state', 64)
            ->requirePresence('state', 'create')
            ->notEmptyString('state',"Please enter the state")
            ->add('state', 'validFormat',[ 'rule' => array('custom', '/^[a-zA-Z\s]*$/'), 'message' =>  __d('cake', 'Please enter texts only') ]);

        $validator
            ->scalar('country')
            ->maxLength('country', 64)
            ->requirePresence('country', 'create')
            ->notEmptyString('country',"Please enter the country")
            ->add('country', 'validFormat',[ 'rule' => array('custom', '/^[a-zA-Z\s]*$/'), 'message' =>  __d('cake', 'Please enter texts only') ]);

        $validator
            ->scalar('role')
            ->maxLength('role', 64)
            ->requirePresence('role', 'create')
            ->notEmptyString('role',"Please choose a role for the user");

        $validator
            ->scalar('token')
            ->maxLength('token', 256)
            ->requirePresence('token', 'create')
            ->notEmptyString('token');

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
        $rules->add($rules->isUnique(['email']), ['errorField' => 'email']);

        return $rules;
    }
}
