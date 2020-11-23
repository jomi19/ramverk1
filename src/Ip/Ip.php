<?php

namespace Joakim\Ip;

class Ip
{
    public function getIp($ipAdress)
    {
        $api = "fae623e018fe3c86833523c261d71f73";
        $url = "http://api.ipstack.com/" .  $ipAdress . "?access_key=" . $api;

        $curl = curl_init();
        $valid = filter_var($ipAdress, FILTER_VALIDATE_IP);

        if (!$valid) {
            return ["type" => "Invalid ip", "ip" => $ipAdress];
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_URL, $url);

        $data = curl_exec($curl);

        curl_close($curl);

        $data = json_decode($data, true);

        if ($data["type"] === "ipv4") {
            $data["hostName"] = gethostbyaddr($ipAdress);
        } else {
            $data["hostName"] = false;
        }

        return $data;
    }

    public function getClientIp()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ipAddress = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ipAddress = $_SERVER['REMOTE_ADDR'];
        }
        return $ipAddress;
    }
}
