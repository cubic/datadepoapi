<?php
namespace Datadepo\Api\Structures;

/**
 * @property-read string|FALSE @codeMoved
 * @property-read bool $deleted
 * @property-read string $project
 * @property-read string $name
 * @property-read string $nameSub
 * @property-read string $pairValue
 * @property-read string $ean
 * @property-read string $isbn
 * @property-read string $description
 * @property-read integer $categoryId
 * @property-read string $jsonImages
 * @property-read string $checksumImages
 * @property-read string $jsonParameters
 * @property-read string $checksumParameters
 * @property-read string $jsonRelated
 * @property-read string $checksumRelated
 */
class DataLine extends AbstractStructure
{
  
  /**
   * @return string
   */
  public function getPrimary()
  {
    return $this->data->code;
  }
  
  /**
   * @return string|FALSE
   */
  public function getCodeMoved()
  {
    return property_exists($this->data, 'codeMoved') ? $this->data->codeMoved : FALSE;
  }
  
  /**
   * @return bool
   */
  public function getDeleted()
  {
    return $this->getCodeMoved() !== FALSE;
  }
  
  /**
   * @return array
   */
  public function getData()
  {
    if ($this->getDeleted()) {
      $data = array('code' => $this->getPrimary(),
                    'json' => $this->json,
                    'checksum' => $this->getChecksum(),
                    'deleted' => 1);
    }
    else {
      $data = array('project' => $this->getProject(),
                    'code' => $this->getPrimary(),
                    'name' => $this->getName(),
                    'name_sub' => $this->getNameSub(),
                    'pair_value' => $this->getPairValue(),
                    'ean' => $this->getEan(),
                    'isbn' => $this->getIsbn(),
                    'description' => $this->getDescription(),
                    'category_id' => $this->getCategoryId(),
                    'json' => $this->json,
                    'deleted' => 0,
          
                    //checksums
                    'checksum' => $this->getChecksum(),
                    'checksum_images' => $this->getChecksumImages(),
                    'checksum_parameters' => $this->getChecksumParameters(),
                    'checksum_related' => $this->getChecksumRelated());
    }
    return $data;
  }
  
  /**
   * @return string
   */
  public function getProject()
  {
    return $this->data->project;
  }
  
  /**
   * @return string
   */
  public function getName()
  {
    return $this->data->name;
  }
  
  /**
   * @return string
   */
  public function getNameSub()
  {
    return $this->data->nameSub;
  }
  
  /**
   * @return string
   */
  public function getPairValue()
  {
    return $this->data->pairValue;
  }
  
  /**
   * @return string
   */
  public function getEan()
  {
    return $this->data->ean;
  }
  
  /**
   * @return string
   */
  public function getIsbn()
  {
    return $this->data->isbn;
  }
  
  /**
   * @return string
   */
  public function getDescription()
  {
    return $this->data->description;
  }
  
  /**
   * @return integer
   */
  public function getCategoryId()
  {
    return $this->data->categoryId;
  }
  
  /**
   * @return string
   */
  public function getJsonImages()
  {
    static $json = FALSE;
    if ($json === FALSE) {
      $json = property_exists($this->data, 'images') ? json_encode($this->data->images) : NULL;
    }
    return $json;
  }
  
  /**
   * @return string
   */
  public function getChecksumImages()
  {
    return $this->getJsonImages() !== NULL ? md5($this->getJsonImages()) : NULL;
  }
  
  /**
   * @return string
   */
  public function getJsonParameters()
  {
    static $json = FALSE;
    if ($json === FALSE) {
      $json = property_exists($this->data, 'parameters') ? json_encode($this->data->parameters) : NULL;
    }
    return $json;
  }
  
  /**
   * @return string
   */
  public function getChecksumParameters()
  {
    return $this->getJsonParameters() !== NULL ? md5($this->getJsonParameters()) : NULL;
  }
  
  /**
   * @return string
   */
  public function getJsonRelated()
  {
    static $json = FALSE;
    if ($json === FALSE) {
      $json = property_exists($this->data, 'related') ? json_encode($this->data->related) : NULL;
    }
    return $json;
  }
  
  /**
   * @return string
   */
  public function getChecksumRelated()
  {
    return $this->getJsonRelated() !== NULL ? md5($this->getJsonRelated()) : NULL;
  }

  
}