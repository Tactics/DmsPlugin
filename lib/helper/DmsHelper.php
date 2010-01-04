<?php


/**
 * Geeft bestandsgrootte weer in een compact formaat
 * 
 * @param integer $filesize
 * 
 * @return string
 */
function format_filesize($size)
{
  // Adapted from: http://www.php.net/manual/en/function.filesize.php

  $mod = 1024;

  $units = explode(' ','B KB MB GB TB PB');
  
  for ($i = 0; $size > $mod; $i++)
  {
      $size /= $mod;
  }

  return round($size, 2) . ' ' . $units[$i];  
}

/**
 * Geeft het icoontje voor de opgegeven extensie
 */
function filetype_image_path($extensie)
{
  $fileiconspath = '/ttDms/images/fileicons/';
  static $fileicons;

  if (! $fileicons)
  {
    $fileicons = array();
    
    foreach(glob(sfConfig::get('sf_web_dir') . $fileiconspath . '*.png') as $iconfile)
    {
      $p = pathinfo($iconfile);
      $fileicons[$p['filename']] = $p['basename'];
    }
  }
  
  if (isset($fileicons[$extensie]))
  {
    $icon = $fileicons[$extensie];
  }
  else
  {
    $icon = 'file.png';
  }
  
  return $fileiconspath . $icon; 
}