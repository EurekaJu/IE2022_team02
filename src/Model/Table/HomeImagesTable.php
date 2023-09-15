<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * HomeImages Model
 *
 * @method \App\Model\Entity\HomeImage newEmptyEntity()
 * @method \App\Model\Entity\HomeImage newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\HomeImage[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\HomeImage get($primaryKey, $options = [])
 * @method \App\Model\Entity\HomeImage findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\HomeImage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\HomeImage[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\HomeImage|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\HomeImage saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\HomeImage[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\HomeImage[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\HomeImage[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\HomeImage[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class HomeImagesTable extends Table
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

        $this->setTable('home_images');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'image' => [
                'fields' => [
                    'dir' => 'image_dir', // defaults to dir
                ],
                'path' => 'webroot{DS}img{DS}',
            ],
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
        // $validator
        //     ->scalar('image')
        //     ->maxLength('image', 64)
        //     ->requirePresence('image', 'create')
        //     ->notEmptyFile('image');

        $validator
        ->scalar('title')
        ->maxLength('title', 64)
        ->allowEmptyString('title');

        $validator
            ->scalar('heading')
            ->maxLength('heading', 256)
            ->allowEmptyString('heading');

        $validator
            ->scalar('subheading')
            ->maxLength('subheading', 500)
            ->allowEmptyString('subheading');

        $validator
            ->scalar('body')
            ->maxLength('body', 500)
            ->allowEmptyString('body');

        $validator
            ->scalar('button_link')
            ->maxLength('button_link', 256)
            ->notEmptyString('button_link');

        $validator
            ->scalar('button_text')
            ->maxLength('button_text', 64)
            ->notEmptyString('button_text');

        return $validator;
    }
}
