<?php

// register behavior hooks
sfPropelBehavior::registerHooks('storage', array(
  ':save:post'   => array('ttDmsStorageBehavior', 'postSave'),
  ':delete:pre' => array('ttDmsStorageBehavior', 'preDelete'),  
));

// ttRelatedObjectBehavior:  register behavior hooks
sfPropelBehavior::registerMethods('storage', array (
  array ('ttDmsStorageBehavior', 'getDmsStorageFolder'),
  array ('ttDmsStorageBehavior', 'hasDmsStorageFolder'),
  array ('ttDmsStorageBehavior', 'renameDmsStorageFolder')
));
