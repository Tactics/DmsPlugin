<?php

/**
 * Subclass for performing query and update operations on the 'dms_node' table.
 *
 * 
 *
 * @package plugins.ttDmsPlugin.lib.model
 */ 
class DmsNodePeer extends BaseDmsNodePeer
{
  /**
   * Geeft een boomstructuur met subnodes met het opgegeven aantal niveaus
   * 
   * @param DmsNode $node
   * @param integer optional $depth
   * 
   * @return array
   */
  public static function getNodeTree($node, $depth = 2)
  {
    $c = new Criteria();
    $c->add(DmsNodePeer::IS_FOLDER, true);
    
    $tree = array();
    
    foreach($node->getChildNodes($c) as $folder)
    {
      $folderInfo = array(
          'attributes' => array(
            'id' => 'node_' . $folder->getId(),
            'rel' => 'folder',
            'node_id' => $folder->getId(),
          ),
          'data' => array(
            'title' => $folder->getName(),
          ),
          'state' => 'closed'
        );
        
      if ($depth > 1)
      {
        $children = self::getNodeTree($folder, $depth - 1);
        $folderInfo['children'] = $children;
      }
      
      $tree[] = $folderInfo;
    }
    
    return $tree;
  }
}
