<!-- File: /app/View/Posts/index.ctp
(edit links added) -->
<?php $this->set('title_for_layout','Posts');?>
<p><?php if($this->access->isLoggedin()){ echo $this->Html->link("Log out", array('controller'=>'users','action' => 'logout')); }
         else { echo $this->Html->link("Log in", array('controller'=>'users','action' => 'login')); }?></p>
<p><?php echo $this->Html->link("Add Post", array('action' => 'add')); ?></p>
<?php echo $this->element('searchbox');?>
<div id='sidebar'>
<?php echo $this->Form->create(null, array(
          'url' => 'http://www.google.com/search',
          'type' => 'get'
      ));
      echo $this->Form->input('q');
      echo $this->Form->end('google search');
?>
</div>

<!-- using Jshelper <?php
    echo '<script>'.$this->Js->alert('hello');
    $this->Js->get('#first');
    $this->Js->event('click','alert("you click on para");',array('stop' => false));
    //$this->Js->domReady();
    $this->Js->writeBuffer();
    echo '</script>';
    //$this->Js->each('$(this).hide();');
    $this->Js->get('#first');
     echo '<script>'.$this->Js->each('$(this).css({color: "red"});').'</script>';
?>
-->

<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <?php
        if($this->access->isLoggedin()){
        echo '<th>Action</th>';
        }
        ?>
        <th>Created</th>
        <th>Author</th>
    </tr>
    <!-- Here's where we loop through our $posts array, printing out post info -->

    <?php foreach ($posts as $post): ?>

    <tr>
        <td>
            <?php echo $post['Post']['id']; ?>
        </td>
        <td>
            <?php echo $this->Html->link($post['Post']['title'],
            array('controller' => 'posts', 'action' => 'view', $post['Post']['id'])); ?>
        </td>

            <?php
            if($this->access->isLoggedin()){
                echo '<td>';
            echo $this->Form->postLink(
            'Delete',
            array('action' => 'delete', $post['Post']['id']),
            array('confirm' => 'Are you sure?'));

             echo $this->Html->link('Edit', array('action' => 'edit', $post['Post']['id']));
             echo '</td>';
            }?>

        <td>
            <?php echo $post['Post']['created']; ?>
        </td>
        <td>
            <?php echo $post['User']['username'];?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php echo $this->Paginator->numbers(array('first' => 'First page')); ?>