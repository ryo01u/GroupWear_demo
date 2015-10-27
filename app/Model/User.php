<?php

App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component'); // コンポーネントを追加
/**
 * User Model
 *
 */

class User extends AppModel {

/**
 * 保存時にパスワードをハッシュ化する
 */
    public function beforeSave($options = array()) {

        if (isset($this->data[$this->alias]['password'])) {

            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        return true;
    }

}