<?php

namespace App\Http\Controllers;

use App\Models\Export;
use Illuminate\Http\Request;
use SimpleXMLElement;

class ExportXMLController extends ExportController
{

    public function GenerateExport($data)
    {
        $fileName = 'ExportXML.xml';
        $xml = new SimpleXMLElement('<news/>');
        array_walk_recursive($data, function ($value, $key) use ($xml) {
            $xml->addChild($key, '<![CDATA[' . $value . ']]>');
        });
        $xml->saveXML(storage_path() . "/export/" . $fileName);

        Export::firstOrCreate(
            ['file_name' => $fileName],
            ['format' => 'xml', 'updated_at' => time()]
        );

        return $fileName;
    }
}
