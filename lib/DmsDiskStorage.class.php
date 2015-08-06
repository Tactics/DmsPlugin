<?php

/**
 * @author Tactics bvba
 * @copyright 2009
 *
 * Deels gebaseerd op http://www.symfony-project.org/plugins/cleverFilesystemPlugin
 */

class DmsDiskStorage extends DmsStorage
{
  /**
   * Initializeert de diskstorage
   *
   * @throws sfException indien er iets mis is met de storage
   */
  public function initialize()
  {
    if (! @file_exists($this->root))
    {
      throw new sfException("DMS disk root folder '$this->root' bestaat niet");
    }

    if (! @is_dir($this->root))
    {
      throw new sfException("Dms disk root folder '$this->root' is geen geldige folder");
    }
  }

  /**
   * Maakt de opgegeven folder aan
   *
   * @param string $path
   * @throws sfException
   * @throws DmsFolderExistsException
   */
  public function mkdir($path)
  {
    // indien niet in productie maken we de dir recursive aan om exceptions te voorkomen
    if  (! @mkdir($this->root . '/' . $path, 0777, sfConfig::get('sf_omgeving') != 'productie'))
    {
      if (file_exists($this->root . '/' . $path))
      {
        throw new DmsFolderExistsException($path);
      }

      throw new sfException(sprintf('Cannot mkdir "%s".', $path));
    }
  }

  /**
   * Bestaat het opgegeven path in de storage
   *
   * @param string $path
   *
   * @return boolean
   */
  public function exists($path)
  {
    return file_exists($this->root . $path);
  }


  /**
   * Is het opgegeven path in de een directory
   *
   * @param string $path
   *
   * @return boolean
   */
  public function isDir($path)
  {
    return is_dir($this->root . $path);
  }

  /**
   * Is het opgegeven path in de een file
   *
   * @param string $path
   *
   * @return boolean
   */
  public function isFile($path)
  {
    return is_file($this->root . $path);
  }

  /**
   * Geeft de grootte van het opgegeven bestand
   *
   * @param string $path
   *
   * @return boolean
   */
  public function getSize($path)
  {
    $this->checkExists($path);
    return filesize($this->root . $path);
  }

  /**
   * Hernoemt een bestand of directory
   *
   * @param string $fromPath
   * @param string $toPath
   *
   * @return boolean true indien gelukt
   */
  public function rename($fromPath, $toPath)
  {
    if  (! @rename($this->root . $fromPath, $this->root . $toPath))
    {
      throw new sfException(sprintf('Cannot rename "%s" to "%s".', $fromPath, $toPath));
    }
  }

  /**
   * Kopieert een bestand of directory
   *
   * @param string $fromPath
   * @param string $toPath
   */
  public function copy($fromPath, $toPath)
  {
    if ($this->isDir($fromPath))
    {
      $contents = $this->listDir($fromPath, array('checkExistence' => false, 'force' => true));

      foreach ($contents as $item_from)
      {
        $item_to = $to.'/'.$item_from;

        if ('' != $fromPath)
        {
          $item_from = $fromPath.'/'.$item_from;
        }

        $this->copy($item_from, $item_to);
      }
    }
    else
    {
      copy($this->root . $fromPath, $this->root . $toPath);
    }
  }

  /**
   * array filter om  . en .. folders uit de lijst te verwijderen
   */
  protected function removeDirsFromList($item)
  {
    return (('.' !== $item) && ('..' !== $item));
  }

  /**
   * Geeft de inhoud van de opgegeven directory
   *
   * @param string $path
   *
   * @return array string
   */
  function listdir($path)
  {
    $this->checkExists($path);
    $this->checkIsDir($path);
    $return = scandir($this->root . $path);
    $return = array_filter($return, array($this, 'removeDirsFromList'));
    sort($return);
    return $return;
  }

  /**
   * Verwijdert heht opgegeven bestand of directory (recursief)
   *
   * @return string $path
   */
  public function unlink($path)
  {
    $item = $this->root . $path;

    if (!file_exists($item))
    {
      return true;
    }

    if (is_dir($item))
    {
      foreach (scandir($item) as $entry)
      {
        if ($entry == '.' || $entry == '..') continue;

        if (!$this->unlink($path . $entry))
        {
          chmod($item . $entry, 0777);
          return $this->unlink($path . $entry);
        }
      }

      return rmdir($item);
    }
    else
    {
      return unlink($item);
    }
  }

  /**
   * Geeft de inhoud van het opgegeven bestand
   *
   * @param string $path
   *
   * @return mixed
   */
  public function read($path)
  {
    if ($this->exists($path) && $this->isFile($path))
    {
      $return = file_get_contents($this->root . $path);
    }
    else
    {
      $return = null;
    }

    return $return;
  }

  /**
   * Schrijft de inhoud van het opgegeven bestand naar de output buffer
   *
   * @param string $path
   *
   * @return mixed
   */
  public function output($path)
  {
    if ($this->exists($path) && $this->isFile($path))
    {
      readfile($this->root . $path);
    }
  }

  /**
   * Schrijft naar het opgegeven bestand
   */
  public function write($path, $data)
  {
    file_put_contents($this->root . $path, $data);
  }

  /**
   * Verplaatst een geuploaded bestand naar de opgegeven locatie
   *
   * @param string $requestFileName de file name van het request
   * @param string $path
   */
  public function moveUploadedFile($requestFileName, $path)
  {
    sfContext::getInstance()->getRequest()->moveFile($requestFileName, $this->root . $path);
  }

  /**
   * Kopieert een bestand op schijf met $absoluteNativeFilepath naar
   * de storage locatie $storagePath
   *
   * (in geval van DmsDiskStorage staan ze beiden op disk)
   *
   * @param string $requestFileName de file name van het request
   * @param string $path
   */
  function loadFromFile($absoluteFilepath, $storagePath)
  {
    copy($absoluteFilepath, $this->root . $storagePath);
  }

  /**
   * Kopieert de storage locatie $storagePath naar een bestand op schijf
   * met $absoluteNativeFilepath naar
   *
   * (in geval van DmsDiskStorage staan ze beiden op disk)
   *
   * @param string $requestFileName de file name van het request
   * @param string $path
   */
  function saveToFile($storagePath, $absoluteFilepath)
  {
    copy($this->root . $storagePath, $absoluteFilepath);
  }


  /**
   * Geeft het mimetype van het bestand
   *
   * @param string $path
   */
  public function getMimeType($path)
  {
    $info = null;

    if (function_exists('finfo_open'))
    {
      static $fileInfoInstance;

      if (! $fileInfoInstance)
      {
        // Windows: download een magic file en zet MAGIC environment variable
        // Unix: gebruikt default /usr/share/file/magic
        $fileInfoInstance = finfo_open(FILEINFO_MIME);
      }

      $info = false !== $fileInfoInstance ? finfo_file($fileInfoInstance, $this->root . $path) : null;
    }

    // Only on unix
    if (!$info && (strtoupper (substr(PHP_OS, 0,3)) != 'WIN'))
    {
      $info = @exec("file -bi '" . $this->root . $path . "'");
    }

    if (! $info && function_exists('mime_content_type'))
    {
      $info = mime_content_type($this->root . $path);
    }

    if (strpos($info, ';') !== false)
    {
      $info = explode(';', $info);
      $info = $info[0];
    }

    // Hack: Met excel wil het al eens mislopen
    // met powerpoint ook
    // + office 2010 extensions compatible
    $extension = pathinfo($path, PATHINFO_EXTENSION);

    if (in_array($extension, array('xls', 'xla', 'xlc', 'xlm')))
    {
      return 'application/vnd.ms-excel';
    }
    else if ($extension == 'xlsx')
    {
      return 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
    }
    else if ($extension == 'ppt')
    {
      return 'application/vnd.ms-powerpoint';
    }
    else if ($extension == 'pptx')
    {
      return 'application/vnd.openxmlformats-officedocument.presentationml.presentation';
    }
    else if ($extension == 'docx')
    {
      return 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
    }

    return $info;
  }

}