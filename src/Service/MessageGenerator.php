<?php
// src/Service/MessageGenerator.php
namespace App\Service;

class MessageGenerator
{
    public function getHappyMessage()
    {
        $messages = [
            'You did it! You updated the system! Amazing!',
            'That was one of the coolest updates I\'ve seen all day!',
            'Great work! Keep going!',
            'Remember to eat sometimes :)',
            'Have you just farted?!',
            'You did it very well!!!!',
            'Ohh crap :(',
            'Sometimes thing go wrong.',
            'hello mr/mrs :)'
        ];

        $index = array_rand($messages);

        return $messages[$index];
    }
    public function getActionMessage(string $action = 'add')
    {
        $message = 'Please set an argument to: [add, edit or delete].';
        switch($action)
        {
            case 'new':
                $message = 'You successfuly created the post!';
                return $message;
                break;
            case 'delete':
                $message = 'You successfuly deleted the post!';
                return $message;
                break;
            case 'edit':
                $message = 'You successfuly edited the post!';
                return $message;
                break;
            default:
                return $message;

        }
    }
}
