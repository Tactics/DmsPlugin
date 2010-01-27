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
    $tree = array(
        'attributes' => array(
          'id' => 'node_' . $node->getId(),
          'rel' => 'folder',
          'node_id' => $node->getId(),
        ),
        'data' => array(
          'title' => $node->getName(),
        )
      );

    $c = new Criteria();
    $c->add(DmsNodePeer::IS_FOLDER, true);

    // Indien nog in de diepte: voeg children toe
    if ($depth > 1)
    {
      $children = array();
  
      foreach($node->getChildNodes($c) as $folder)
      {
        $children[] = self::getNodeTree($folder, $depth - 1);
      }
      
      $tree['children'] = $children;
    }
    // Anders indien er nog kinderen zijn: geeft dit aan met 'state=closed'
    // Dit zorgt er voor dat jsTree de node nog openvouwbaar (met +) aangeeft
    else if (count($node->getChildNodes($c)))
    {
      $tree['state'] = 'closed';
    }
  
    return $tree;
  }
}
