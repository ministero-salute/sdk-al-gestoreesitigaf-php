<?php
namespace AccessLayerMdS;

class ResponseStateVerify extends BaseResponse
{
    public string $esitoServizio;
    public string $descrizioneEsitoServizio;
    public string $numeroAtto;
    public string $identificativoSoggettoAlimentante;
    public string $tipoEsito;
    public DettaglioType $dettagli;
} 
