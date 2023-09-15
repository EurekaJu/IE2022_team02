<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BookImages Model
 *
 * @property \App\Model\Table\BooksTable&\Cake\ORM\Association\BelongsTo $Books
 *
 * @method \App\Model\Entity\BookImage newEmptyEntity()
 * @method \App\Model\Entity\BookImage newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\BookImage[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BookImage get($primaryKey, $options = [])
 * @method \App\Model\Entity\BookImage findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\BookImage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BookImage[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\BookImage|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BookImage saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BookImage[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\BookImage[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\BookImage[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\BookImage[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class BookImagesTable extends Table
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

        $this->setTable('book_images');
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


        $this->belongsTo('Books', [
            'foreignKey' => 'book_id',
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
//        $validator
//
//            ->add( 'image',[
//                'mimeType' => [
//                    'rule' => [ 'mimeType',[ 'name/jpg','name/png','name/jpeg']],
//                    'message' => 'Please Upload only jpg and png',
//                ],
//                'fileSize' => [
//                    'rule' => ['filesize','<=','10MB'],
//                    'message' => 'Image File must be lesser than 10MB'
//                ]])
//            ->scalar('image')
//            ->maxLength('image', 64)
//            ->requirePresence('image', 'create')
//            ->notEmptyFile('image');

        $validator
            ->scalar('description')
            ->maxLength('description', 256)
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->integer('book_id')
            ->requirePresence('book_id', 'create')
            ->notEmptyString('book_id');

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
