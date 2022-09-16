<?php

interface NotificationInterface
{
    public function send(): string;
}

class Content implements NotificationInterface
{
    public function __construct(
        private string $text
    )
    {
    }

    public function send(): string
    {
        return $this->text;
    }
}

abstract class Decorator implements NotificationInterface
{
    public function __construct(
        protected NotificationInterface $content
    )
    {

    }
}

class Sms extends Decorator
{
    public function send(): string
    {
        mail('3855550168@vtext.com', '', $this->content->send());
        return $this->content->send();
    }
}

class Email extends Decorator
{
    public function send(): string
    {
        mail('user@example.com', 'some topic', $this->content->send());
        return $this->content->send();
    }
}

$sending = new Sms(
    new Email(
        new Content('some text')
    )
);
$sending->send();