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
   * @param DmsNodeMetadata $metadata
   *
   * @throws DmsFolderExistsException
   * @throws sfException
   */
  public function mkdir(DmsNodeMetadata $metadata)
  {
    // indien niet in productie maken we de dir recursive aan om exceptions te voorkomen
    if  (! @mkdir($this->root . '/' . $metadata->getPath(), 0777, sfConfig::get('sf_omgeving') != 'productie'))
    {
      if (file_exists($this->root . '/' . $metadata->getPath()))
      {
        throw new DmsFolderExistsException($metadata->getPath());
      }

      throw new sfException(sprintf('Cannot mkdir "%s".', $metadata->getPath()));
    }
  }

  /**
   * Bestaat het opgegeven path in de storage
   *
   * @param DmsNodeMetadata $metadata
   *
   * @return bool
   */
  public function exists(DmsNodeMetadata $metadata)
  {
    return file_exists($this->root . $metadata->getPath());
  }


  /**
   * Is het opgegeven path in de een directory
   *
   * @param DmsNodeMetadata $metadata
   *
   * @return bool
   */
  public function isDir(DmsNodeMetadata $metadata)
  {
    return is_dir($this->root . $metadata->getPath());
  }

  /**
   * Is het opgegeven path in de een file
   *
   * @param DmsNodeMetadata $metadata
   *
   * @return bool
   */
  public function isFile(DmsNodeMetadata $metadata)
  {
    return is_file($this->root . $metadata->getPath());
  }

  /**
   * Geeft de grootte van het opgegeven bestand
   *
   * @param DmsNodeMetadata $metadata
   *
   * @return bool
   */
  public function getSize(DmsNodeMetadata $metadata)
  {
    $this->exists($metadata);
    return filesize($this->root . $metadata->getPath());
  }

  /**
   * Hernoemt een bestand of directory
   *
   * @param DmsNodeMetadata $oldMetadata
   * @param DmsNodeMetadata $newMetadata
   *
   * @throws sfException
   */
  public function rename(DmsNodeMetadata $oldMetadata, DmsNodeMetadata $newMetadata)
  {
    if  (! @rename($this->root . $oldMetadata->getPath(), $this->root . $newMetadata->getPath()))
    {
      throw new sfException(sprintf('Cannot rename "%s" to "%s".', $oldMetadata->getPath(), $newMetadata->getPath()));
    }
  }

  /**
   * Kopieert een bestand of directory
   *
   * @param DmsNodeMetadata $oldMetadata
   * @param DmsNodeMetadata $newMetadata
   *
   */
  public function copy(DmsNodeMetadata $oldMetadata, DmsNodeMetadata $newMetadata)
  {
    if ($this->isDir($oldMetadata))
    {
      $contents = $this->listDir($oldMetadata);

      foreach ($contents as $item_from)
      {
        $item_to = new DmsNodeMetadata(null, '', $newMetadata->getPath().'/'.$item_from, null);

        if ('' != $oldMetadata->getPath())
        {
          $item_from = new DmsNodeMetadata(null, '', $oldMetadata->getPath().'/'.$item_from, null);
        }

        $this->copy($item_from, $item_to);
      }
    }
    else
    {
      copy($this->root . $oldMetadata->getPath(), $this->root . $newMetadata->getPath());
    }
  }

  /**
   * array filter om  . en .. folders uit de lijst te verwijderen
   *
   * @param $item
   *
   * @return bool
   */
  protected function removeDirsFromList($item)
  {
    return (('.' !== $item) && ('..' !== $item));
  }

  /**
   * Geeft de inhoud van de opgegeven directory
   *
   * @param DmsNodeMetadata $metadata
   *
   * @return array string
   */
  function listdir(DmsNodeMetadata $metadata)
  {
    $this->checkExists($metadata);
    $this->checkIsDir($metadata);
    $return = scandir($this->root . $metadata->getPath());
    $return = array_filter($return, array($this, 'removeDirsFromList'));
    sort($return);
    return $return;
  }

  /**
   * Verwijdert heht opgegeven bestand of directory (recursief)
   *
   * @param DmsNodeMetadata $metadata
   *
   * @return string $path
   */
  public function unlink(DmsNodeMetadata $metadata)
  {
    $item = $this->root . $metadata->getPath();

    if (!file_exists($item))
    {
      return true;
    }

    if (is_dir($item))
    {
      foreach (scandir($item) as $entry)
      {
        if ($entry == '.' || $entry == '..') continue;
        $itemMedata = new DmsNodeMetadata(1, 'item', $metadata->getPath(). $entry, '');
        if (!$this->unlink($itemMedata))
        {
          chmod($item . $entry, 0777);
          return $this->unlink($itemMedata);
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
   * @param DmsNodeMetadata $metadata
   *
   * @return mixed
   */
  public function read(DmsNodeMetadata $metadata)
  {
    if ($this->exists($metadata) && $this->isFile($metadata))
    {
      $return = file_get_contents($this->root . $metadata->getPath());
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
   * @param DmsNodeMetadata $metadata
   */
  public function output(DmsNodeMetadata $metadata)
  {
    if ($this->exists($metadata) && $this->isFile($metadata))
    {
      readfile($this->root . $metadata->getPath());
    }
  }

  /**
   * Schrijft naar het opgegeven bestand
   *
   * @param DmsNodeMetadata $metadata
   * @param $data
   */
  public function write(DmsNodeMetadata $metadata, $data)
  {
    file_put_contents($this->root . $metadata->getPath(), $data);
  }

  /**
   * Verplaatst een geuploaded bestand naar de opgegeven locatie
   *
   * @param string $requestFileName de file name van het request
   * @param DmsNodeMetadata $metadata
   */
  public function moveUploadedFile($requestFileName, DmsNodeMetadata $metadata)
  {
    sfContext::getInstance()->getRequest()->moveFile($requestFileName, $this->root . $metadata->getPath());
  }

  /**
   * Kopieert een bestand op schijf met $absoluteNativeFilepath naar
   * de storage locatie $storagePath
   *
   * (in geval van DmsDiskStorage staan ze beiden op disk)
   *
   * @param $absoluteFilepath
   * @param DmsNodeMetadata $metadata
   */
  function loadFromFile($absoluteFilepath, DmsNodeMetadata $metadata)
  {
    copy($absoluteFilepath, $this->root . $metadata->getPath());
  }

  /**
   * Kopieert de storage locatie $storagePath naar een bestand op schijf
   * met $absoluteNativeFilepath naar
   *
   * (in geval van DmsDiskStorage staan ze beiden op disk)
   *
   * @param DmsNodeMetadata $metadata
   * @param $absoluteFilepath
   */
  function saveToFile(DmsNodeMetadata $metadata, $absoluteFilepath)
  {
    copy($this->root . $metadata->getPath(), $absoluteFilepath);
  }


  /**
   * Geeft het mimetype van het bestand
   *
   * @param DmsNodeMetadata $metadata
   *
   * @return array|mixed|null|string
   */
  public function getMimeType(DmsNodeMetadata $metadata)
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

      $info = false !== $fileInfoInstance ? finfo_file($fileInfoInstance, $this->root . $metadata->getPath()) : null;
    }

    // Only on unix
    if (!$info && (strtoupper (substr(PHP_OS, 0,3)) != 'WIN'))
    {
      $info = @exec("file -bi '" . $this->root . $metadata->getPath() . "'");
    }

    if (! $info && function_exists('mime_content_type'))
    {
      $info = mime_content_type($this->root . $metadata->getPath());
    }

    if (strpos($info, ';') !== false)
    {
      $info = explode(';', $info);
      $info = $info[0];
    }

    // Hack: Met excel wil het al eens mislopen
    // met powerpoint ook
    // + office 2010 extensions compatible
    $extension = pathinfo($metadata->getPath(), PATHINFO_EXTENSION);

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