<?php

/**
 * DmsTools
 * 
 * @package   
 * @author CSJ
 * @copyright Tactics bvba
 * @version 2010
 * @access public
 */
class DmsTools
{
  /**
   * Geeft een filesystem safe versie van de opgegeven bestandsnaam terug
   * 
   * Verwijdert alle speciale characters en vertaalt de characters met accent etc eerst
   * 
   * @param string $filename
   * @return string
   */
  public static function safeFilename($filename)
  {
    // converteert é, à etc naar e, a etc
    $filename = ttTextTools::remove_accents($filename);
    $filename = mb_convert_encoding($filename,'ASCII');
    // lowercase
    $filename = strtolower($filename);    
    
    // Specifieke vertalingen voor een aantal characters
    $filename = str_replace("'","",$filename);
    $filename = str_replace('"',"",$filename);
    $filename = str_replace('´',"",$filename);
    $filename = str_replace('`',"",$filename);
    
    // Overige ongeldige characters naar underscore
    $filename = strtr($filename,
      ' ,;:?*#!§$%/(){}<>=|&',
      '_____________________');

    // meerdere underscores vervangen door één
    $filename = preg_replace('/_+/', '_', $filename);

    // Begint niet met . of _
    $filename = trim($filename, '_.');

    return $filename;
  }
}