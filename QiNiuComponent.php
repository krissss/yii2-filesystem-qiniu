<?php

namespace kriss\qiniu;

use Codeception\Exception\ConfigurationException;
use League\Flysystem\Filesystem;
use Overtrue\Flysystem\Qiniu\QiniuAdapter;
use yii\base\Component;

class QiNiuComponent extends Component
{
    /**
     * AK
     * @var string
     */
    public $access_key;
    /**
     * SK
     * @var string
     */
    public $secret_key;
    /**
     * bucket name
     * @var string
     */
    public $bucket;
    /**
     * xxxx.xx.com or host: https://xxxx.xx.com
     * @var string
     */
    public $domain;

    /**
     * @var bool|Filesystem
     */
    private $_flysystem = false;

    /**
     * use this to get disk instance
     * @return Filesystem
     */
    public function getDisk()
    {
        if ($this->_flysystem !== false) {
            return $this->_flysystem;
        }
        $this->configCanNotBeNull(['access_key', 'secret_key', 'bucket', 'domain']);
        $adapter = new QiniuAdapter($this->access_key, $this->secret_key, $this->bucket, $this->domain);
        return new Filesystem($adapter);
    }

    /**
     * @param $params array
     * @throws ConfigurationException
     */
    protected function configCanNotBeNull($params)
    {
        foreach ($params as $param) {
            if (!$this->$param) {
                throw new ConfigurationException($param . 'must be set');
            }
        }
    }
}