<?php
namespace AccessLayerMdS;

class ResponseSendFile extends BaseResponse
{
    public string $esito;
    public string $esitoServizio;
    public string $descrizioneEsitoServizio;
    public string $tipoEsito;
    public DettaglioType $dettagli;
    public array $esitiValidazione;
}
