<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DmsNodeExistsException
 *
 * @author taco
 */
class DmsNodeExistsException extends sfException
{
  //put your code here
  protected $node = null;
  
  public function setNode($dms_node)
  {
    $this->node = $dms_node;
  }

  public function getNode()
  {
    return $this->node;
  }
}
?>
