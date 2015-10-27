<?php

App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component'); // �R���|�[�l���g��ǉ�
/**
 * User Model
 *
 */

class User extends AppModel {

/**
 * �ۑ����Ƀp�X���[�h���n�b�V��������
 */
    public function beforeSave($options = array()) {

        if (isset($this->data[$this->alias]['password'])) {

            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        return true;
    }

}