<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \Cake\ORM\Association\BelongsToMany $Skills
 * @property \Cake\ORM\Association\BelongsToMany $Stats
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null)
 */
class UsersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('users');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsToMany('Skills', [
            'foreignKey' => 'user_id',
            'targetForeignKey' => 'skill_id',
            'joinTable' => 'users_skills'
        ]);
        $this->belongsToMany('Stats', [
            'foreignKey' => 'user_id',
            'targetForeignKey' => 'stat_id',
            'joinTable' => 'users_stats'
        ]);

        // Add the behaviour and configure any options you want
        $this->addBehavior('Proffer.Proffer', [
            'photo' => [    // The name of your upload field
                'root' => WWW_ROOT . 'files', // Customise the root upload folder here, or omit to use the default
                'dir' => 'photo_dir',   // The name of the field to store the folder
                'thumbnailSizes' => [ // Declare your thumbnails
                    'square' => [   // Define the prefix of your thumbnail
                        'w' => 128, // Width
                        'h' => 128, // Height
                        'jpeg_quality'  => 100
                    ],
                ],
                'thumbnailMethod' => 'gd',   // Options are Imagick or Gd
                'crop' => true
            ]
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->uuid('id')
            ->allowEmpty('id', 'create');

        $validator
            ->email('username')
            ->requirePresence('username')
            ->notEmpty('username');

        $validator
            ->requirePresence('password')
            ->notEmpty('password');

        $validator
            ->notEmpty('role', 'A role is required')
            ->add('role', 'inList', [
                'rule' => ['inList', ['admin', 'user']],
                'message' => 'Please enter a valid role'
            ]);

        $validator->provider('proffer', 'Proffer\Model\Validation\ProfferRules');

        // Set the thumbnail resize dimensions
        $validator->add('photo', 'proffer', [
            'rule' => ['dimensions', [
                'min' => ['w' => 50, 'h' => 50],
                'max' => ['w' => 3000, 'h' => 3000],
            ]],
            'message' => 'Image is not correct dimensions.',
            'provider' => 'proffer',

        ]);

        $validator->requirePresence('photo', 'create')
            ->allowEmpty('photo', 'update');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email']));

        return $rules;
    }
}
