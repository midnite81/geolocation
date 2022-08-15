<?php

declare(strict_types=1);

namespace Midnite81\GeoLocation\Responses\Ip2Location;

use Midnite81\Core\Responses\BaseResponse;

class ProxyResponse extends BaseResponse
{
    /**
     * Proxy last seen in days.
     *
     * @var string|int|mixed|null
     */
    public readonly string|int|null $lastSeen;

    /**
     * Type of proxy.
     * (VPN) Anonymizing VPN services
     * (TOR) Tor Exit Nodes
     * (DCH) Hosting Provider, Data Center or Content Delivery Network
     * (PUB) Public Proxies
     * (WEB) Web Proxies
     * (SES) Search Engine Robots
     * (RES) Residential proxies
     *
     * @var string|mixed|null
     */
    public readonly ?string $proxyType;

    /**
     * Security threat reported.
     * (SPAM) Email and forum spammers
     * (SCANNER) Network security scanners
     * (BOTNET) Malware infected devices
     *
     * @var string|mixed|null
     */
    public readonly ?string $threat;

    /**
     * Name of VPN provider if available.
     *
     * @var string|mixed|null
     */
    public readonly ?string $provider;

    public function __construct(string|array $data)
    {
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
        $this->lastSeen = $data['last_seen'] ?? null;
        $this->proxyType = $data['proxy_type'] ?? null;
        $this->threat = $data['threat'] ?? null;
        $this->provider = $data['provider'] ?? null;
        parent::__construct();
    }
}
