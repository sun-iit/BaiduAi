<?php
namespace suniit\BaiduAi;

use suniit\BaiduAi\Service\AipNlp;
use suniit\BaiduAi\Service\AipSpeech;
use suniit\BaiduAi\Service\AipFace;
use suniit\BaiduAi\Service\AipImageCensor;
use suniit\BaiduAi\Service\AipImageClassify;
use suniit\BaiduAi\Service\AipKg;
use suniit\BaiduAi\Service\AipImageSearch;
use suniit\BaiduAi\Service\AipOcr;

class Ai
{
    const MAP = [
            'Nlp' => AipNlp::class,
            'Speech' => AipSpeech::class,
            'Face' => AipFace::class,
            'ImageCensor' => AipImageCensor::class,
            'ImageClassify' => AipImageClassify::class,
            'Kg' => AipKg::class,
            'ImageSearch' => AipImageSearch::class,
            'Ocr' => AipOcr::class,
    ];

    protected $driver;
    protected $app_id;
    protected $api_key;
    protected $api_secret;

    public function __construct($app_id, $api_key, $api_secret)
    {
        $this->app_id = $app_id;
        $this->api_key = $api_key;
        $this->api_secret = $api_secret;
    }
    /**
     * @param $name
     * @param $arguments
     *
     * @return mixed
     * @throws \Exception
     */
    public function __call($name, $arguments)
    {
        if (!key_exists($name, self::MAP)) {
            throw new \Exception('driver does not exists.');
        }
        $driver = self::MAP[$name];
        return new $driver($this->app_id, $this->api_key, $this->api_secret);
    }
}