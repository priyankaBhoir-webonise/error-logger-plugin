<?php
    print_r($posts);
    echo $this->Form->create('Post', array(
		'url' => array_merge(array('action' => 'find_data'), $this->params['pass'])
	));
	echo $this->Form->input('title', array('div' => false));
	echo $this->Form->submit(__('Search'), array('div' => false));
	echo $this->Form->end();