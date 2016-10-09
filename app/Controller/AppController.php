<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');
// Folder と File ユーティリティ
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

  public function beforeFilter(){
   $this->set('currentUser', $this->Auth->user());
 }

  public $helpers = array(
  'Session',
  'Html' => array('className' => 'TwitterBootstrap.BootstrapHtml'),
  'Form' => array('className' => 'TwitterBootstrap.BootstrapForm'),
  'Paginator' => array('className' => 'TwitterBootstrap.BootstrapPaginator'),
  );

  public $layout = 'TwitterBootstrap.default';

  public $components = [
    'DebugKit.Toolbar',
    'Flash',
    'Auth' => [
      'loginAction' => [
        'controller' => 'users',
        'action' => 'login',
      ],

      'authenticate' => [
        'Form' => [
          'UserModel' => 'User',
          'fields' => [
            'username' => 'email',
            'password' => 'encrypted_password',
          ],
          'passwordHasher' => 'Blowfish',
        ]
      ],

      'loginRedirect' => [
        'controller' => 'contents',
        'action' => 'index'
      ],

      'logoutRedirect' => [
        'controller' => 'contents',
        'action' => 'index'
      ],

      'authError' => 'ログインしてください',
    ]
  ];

}
