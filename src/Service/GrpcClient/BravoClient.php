<?php

namespace App\Service\GrpcClient;

use \Grpc\BaseStub;
use Service\GrpcClient\Bravo\EmptyRequest;
use Service\GrpcClient\Bravo\SettingsReply;

class BravoClient extends BaseStub
{
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    public function getSettings(): ?SettingsReply
    {
        $reply = $this->requestSettings(
            new EmptyRequest()
        );

        if ($reply instanceof SettingsReply) {
            return $reply;
        }
        return null;
    }

    private function requestSettings(
        EmptyRequest $argument,
        $metadata = [],
        $options = []
    ): \Google\Protobuf\Internal\Message
    {
        return $this->_simpleRequest('/bravo.Settings/GetSettings',
            $argument,
            ['\Bravo\SettingsReply', 'decode'],
            $metadata, $options);
    }

}