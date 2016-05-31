<?php
namespace Service;

class XMLDumper
{
    /**
     * @var array
     */
    private $data;

    /**
     * OrderDumper constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function dump()
    {
        $dirName = md5(date('Y-m-d'));
        $dir = $this->getXmlPath() . $dirName . DIRECTORY_SEPARATOR;
        if (!is_dir($dir)) {
            mkdir($dir);
        }
        $fileName = md5(serialize($this->data)) . '.xml';
        $xml = new \SimpleXMLElement('<root/>');
        array_walk($this->data, function ($item, $key) use($xml) {
            $xml->addChild($key, $item);
        });
        file_put_contents($dir . $fileName, $xml->asXML());
        return '/xml/' . $dirName . '/' . $fileName;
    }

    /**
     * @return string
     */
    private function getXmlPath()
    {
        return __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'xml' . DIRECTORY_SEPARATOR;
    }
}