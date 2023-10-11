<?php
namespace AccessLayerMdS;

require 'loader.php';

use AccessLayerMdS\Base;
use AccessLayerMdS\ResponseGetInfoMonitoraggio;
use AccessLayerMdS\RequestGetInfoMonitoraggio;
use AccessLayerMdS\ServiceGateway;
use Exception;
use HttpMethods;
use Parameters;
use ObjectName;

class AccessLayer extends Base
{
    private string $remotePath;
    private string $endpoint;

    public function getRemotePath() {
        return $this->remotePath;
    }

    private function setRemotePath($remotePath) {
        $this->remotePath = $remotePath->getParametersString();
        return $this;
    }

    public function getEndpoint(){
        return $this->endpoint;
    }

    private function setEndpoint($endpoint){
        $this->endpoint = $endpoint->getParametersString();
        return $this;
    }

    function __construct()
    {
        $this->remotePath = "http://localhost:8080";
        $this->endpoint = "v1/monitoraggio/flussi";
    }

    public function Init(string $host)
    {
        $this->remotePath = $host;
    }

    public function GetInfo(string $idsUpload, string $nomeFlusso, int $idRun) : ResponseGetInfoMonitoraggio
    {
        $response = null;

        try
        {
            $this->ValidateInit();

            $vars = array('{endpoint}' => $this->endpoint);
            $baseUri = strtr("{endpoint}", $vars);
            $queryparams = "idsUpload=" . $idsUpload . "&nomeFlusso=" . $nomeFlusso . "&idRun=" . $idRun;

            // $queryParams = [
            //     'idsUpload' => $idsUpload,
            //     'nomeFlusso' => $nomeFlusso,
            //     'idRun' => $idRun,
            // ];
            #echo 'endpoint=' . $this->remotePath . '; $baseUri='. $baseUri . '<br />';

            $service = new ServiceGateway();
            $responseApi = $service->callApiGateway($this->remotePath, $baseUri, 'GET', $queryparams);
            var_dump($responseApi);
            echo '<br />';

            if($responseApi != null) {
                $response = parent::cast("ResponseGetInfoMonitoraggio", $responseApi);
                var_dump($response);
            } else {
                throw new Exception("${baseUri} - response error.");
            }
        }
        catch(Exception $e)
        {
            var_dump($e);
            $response = new ResponseGetInfoMonitoraggio();
        }

        return $response;
    }

    private function ValidateInit()
    {
        if ($this->getRemotePath() == null) throw new Exception('Impostare AccessLayer::RemotePath.');
    }
}
