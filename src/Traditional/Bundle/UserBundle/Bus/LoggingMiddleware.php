<?php
/**
 * Created by PhpStorm.
 * User: dennisdegreef
 * Date: 29/01/15
 * Time: 10:46
 */

namespace Traditional\Bundle\UserBundle\Bus;


use Psr\Log\LoggerInterface;
use SimpleBus\Message\Bus\Middleware\MessageBusMiddleware;
use SimpleBus\Message\Message;

class LoggingMiddleware implements MessageBusMiddleware
{
    private $logger;

    public function __construct(LoggerInterface $loggerInterface)
    {
        $this->logger = $loggerInterface;
    }

    /**
     * @return mixed
     */
    public function getLogger()
    {
        return $this->logger;
    }

    /**
     * The provided $next callable should be called whenever the next middleware should start handling the message.
     * Its only argument should be a Message object (usually the same as the originally provided message).
     *
     * @param Message  $message
     * @param callable $next
     *
     * @return void
     */
    public function handle(Message $message, callable $next)
    {
        $type = get_class($message);

        $this->logger->debug('start', ['type' => $type]);

        $next($message);
    }
}