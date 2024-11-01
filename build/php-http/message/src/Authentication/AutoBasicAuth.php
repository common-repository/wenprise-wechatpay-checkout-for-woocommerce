<?php
/**
 * @license MIT
 *
 * Modified by __root__ on 09-September-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

namespace Wenprise\Wechatpay\Http\Message\Authentication;

use Wenprise\Wechatpay\Http\Message\Authentication;
use Wenprise\Wechatpay\Psr\Http\Message\RequestInterface;

/**
 * Authenticate a PSR-7 Request using Basic Auth based on credentials in the URI.
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
final class AutoBasicAuth implements Authentication
{
    /**
     * Whether user info should be removed from the URI.
     *
     * @var bool
     */
    private $shouldRemoveUserInfo;

    /**
     * @param bool|true $shouldRremoveUserInfo
     */
    public function __construct($shouldRremoveUserInfo = true)
    {
        $this->shouldRemoveUserInfo = (bool) $shouldRremoveUserInfo;
    }

    public function authenticate(RequestInterface $request)
    {
        $uri = $request->getUri();
        $userInfo = $uri->getUserInfo();

        if (!empty($userInfo)) {
            if ($this->shouldRemoveUserInfo) {
                $request = $request->withUri($uri->withUserInfo(''));
            }

            $request = $request->withHeader('Authorization', sprintf('Basic %s', base64_encode($userInfo)));
        }

        return $request;
    }
}
