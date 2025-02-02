<?php
/**
 * @license MIT
 *
 * Modified by __root__ on 09-September-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

namespace Wenprise\Wechatpay\Http\Message\RequestMatcher;

use Wenprise\Wechatpay\Http\Message\RequestMatcher;
use Wenprise\Wechatpay\Psr\Http\Message\RequestInterface;

/**
 * Match a request with a callback.
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
final class CallbackRequestMatcher implements RequestMatcher
{
    /**
     * @var callable
     */
    private $callback;

    public function __construct(callable $callback)
    {
        $this->callback = $callback;
    }

    public function matches(RequestInterface $request)
    {
        return (bool) call_user_func($this->callback, $request);
    }
}
