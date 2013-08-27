<?php
/**
 * Created by JetBrains PhpStorm.
 * User: webonise
 * Date: 6/8/13
 * Time: 12:39 PM
 * To change this template use File | Settings | File Templates.
 */
CakePlugin::loadAll();

class PostsController extends AppController{
    public $helpers = array('Html','Form','Access','Js','Paginator');
    public $components = array('Search.Prg','Auth','Sendgrid');

    public $presetVars = true; // using the model configuration
    public $paginate=array('limit'=>2,'order'=>array('post.id'=>'asc'));

    public function find_data() {
        /*$this->Prg->commonProcess();
        $condition=array('conditions' =>$this->Prg->parsedParams());
        $post=$this->Post->find('first',$condition);*/
        $title=$_POST['data']['post']['title'];
        $title='%'.$title.'%';
        $post=$this->Post->find('all',array('conditions'=>array('title LIKE'=>$title)));

        $this->set('posts',$post);
    }
    public function index() {
        //$this->loadModel('user_view');
        //print_r($this->user_view->find('all'));
        $this->set('title_for_layout','posts');
        $this->set('posts', $this->paginate('Post'));
        //$post=$this->paginate('Post');                     //------------paginate
        //$this->set('posts',$post);
    }

    public function view($id=null){
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }
        $post = $this->Post->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }
        if (!$this->request->data) {
            $this->request->data = $post;
        }
        $this->set('post',$post);
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->request->data['Post']['user_id'] = $this->Auth->user('id');
            $this->Post->create();
            $data=array('title'=>'new','body'=>'hehehehehe');
            if ($this->Post->save($data)) {
                $this->getEventManager()->dispatch(new CakeEvent('Controller.Posts.afterPlace', $this, array(
                    'post' => $this->request->data
                )));
                $this->Session->setFlash('Your post has been saved.');

                $this->Sendgrid->delivery = 'sendgrid';
                $this->Sendgrid->from = 'priyanka.bhoir@weboniselab.com';
                $this->Sendgrid->to = 'priyanka.bhoir@weboniselab.com';
                $this->Sendgrid->subject = 'this is the subject';
                $messageBody = 'this is the message body';
                $this->Sendgrid->send($messageBody);

                $this->redirect(array('action' => 'index'));
            }
            else {
                $this->Session->setFlash('Unable to add your post.');
            }
        }
    }

    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $post=$this->Post->find('first',
                                array('conditions'=>array('id'=>$id)));

        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Post->id = $id;
            $user_id=$this->Auth->user('id');
            if ($this->Post->save($this->request->data)) {
                //CakeEmail::deliver('priyanka.bhoir@weboniselab.com', 'edit_data', "user number $user_id  edited the post", array('from' => 'priyanka.bhoir@weboniselab.com'));
                $this->Session->setFlash('Your post has been updated.');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to update your post.');
            }
        }
        if (!$this->request->data) {
            $this->request->data = $post;
        }
    }
    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        if ($this->Post->delete($id)) {
        $this->Session->setFlash('The post with id: ' . $id . ' has been deleted.');
        $this->redirect(array('action' => 'index'));
        }
    }
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add');

        $this->Auth->userModel = 'User';
        $this->Auth->allow(array('index', 'view'));

    }

    public function isAuthorized($user) {
        // All registered users can add posts
        if ($this->action === 'add') {
            return true;
        }

        // The owner of a post can edit and delete it
        if (in_array($this->action, array('edit', 'delete'))) {
            $postId = $this->request->params['pass'][0];
            if ($this->Post->isOwnedBy($postId, $user['id'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }

}
