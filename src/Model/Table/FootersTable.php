<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Footers Model
 *
 * @method \App\Model\Entity\Footer newEmptyEntity()
 * @method \App\Model\Entity\Footer newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Footer[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Footer get($primaryKey, $options = [])
 * @method \App\Model\Entity\Footer findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Footer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Footer[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Footer|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Footer saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Footer[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Footer[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Footer[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Footer[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class FootersTable extends Table
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

        $this->setTable('footers');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');
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
            ->scalar('title')
            ->maxLength('title', 256)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('body')
            ->maxLength('body', 16777215)
            ->requirePresence('body', 'create')
            ->notEmptyString('body');

        return $validator;
    }
}
