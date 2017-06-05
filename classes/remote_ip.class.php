<?php
namespace Classes;

class RemoteAddress
{
    private $useProxy = false;
    private $trustedProxies = array();
    private $proxyHeader = 'HTTP_X_FORWARDED_FOR';

    public function getIpAddress()
    {
        $ip = $this->getIpAddressFromProxy();
        if ($ip) {
            return $ip;
        }

        if (isset($_SERVER['REMOTE_ADDR'])) {
            return $_SERVER['REMOTE_ADDR'];
        }

        return '';
    }

    private function getIpAddressFromProxy()
    {
        if (!$this->useProxy
            || (isset($_SERVER['REMOTE_ADDR']) && !in_array($_SERVER['REMOTE_ADDR'], $this->trustedProxies))
        ) {
            return false;
        }

        $header = $this->proxyHeader;
        if (!isset($_SERVER[$header]) || empty($_SERVER[$header])) {
            return false;
        }

        $ips = explode(',', $_SERVER[$header]);
        $ips = array_map('trim', $ips);
        $ips = array_diff($ips, $this->trustedProxies);

        if (empty($ips)) {
            return false;
        }

        $ip = array_pop($ips);
        return $ip;
    }
}