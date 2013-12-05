<?php
  $store = isset($store) ? $store : $node->getDmsStore();
  
  echo '//';
//  echo link_to($store->getName(), 'ttDmsBrowser/browse?store_id=' . $store->getId());
  echo $store->getName();
  echo '//';
  
  if (isset($node) && $node)
  {
    foreach ($node->getPath() as $pNode)
    {
//      echo link_to($pNode->getName(), 'ttDmsBrowser/browse?node_id=' . $pNode->getId());
      echo $pNode->getName();
      echo '/';
    }
    
    echo $node->getName();
  }
