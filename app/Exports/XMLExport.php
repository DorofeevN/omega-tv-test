<?php
namespace App\Exports;

/**
 *
 */
class XMLExport
{

  protected $array;
  protected $name;

  function __construct($array,$filename)
  {
    $this->data = $array;
    $this->name = $filename;
  }

  function array_to_xml($array, &$xml_data) {
    foreach($array as $key => $value) {
        if(is_array($value)) {
            if(!is_numeric($key)){
                $subnode = $xml_data->addChild("$key");
                $this->array_to_xml($value, $subnode);
            }else{
                $subnode = $xml_data->addChild("item$key");
                $this->array_to_xml($value, $subnode);
            }
        }else {
            $xml_data->addChild("$key",htmlspecialchars("$value"));
        }
    }
}

function xmlexport(){
  // initializing or creating array
$data = $this->data;
$filename = $this->name;
// creating object of SimpleXMLElement
$xml_data = new \SimpleXMLElement('<?xml version="1.0"?><data></data>');

// function call to convert array to xml
$this->array_to_xml($data,$xml_data);

//saving generated xml file;
$result = $xml_data->asXML($filename);

return $xml_data;
}
}

 ?>
