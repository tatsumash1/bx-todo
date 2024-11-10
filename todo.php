<?php

//php todo.php list
//php todo.php list 2022-10-22
//php todo.php list yesterday
//php todo.php add "WAKE UP"
//php todo.php add "Drink coffee"
//php todo.php complete 1 2
//php todo.php remove 1 (rm)

function main(array $arguments): void
{
    array_shift($arguments);
    $command = array_shift($arguments);

    switch ($command)
    {
        case 'list':
            listCommand($arguments);
            break;
        case 'remove':
        case 'rm':
            removeCommand($arguments);
            break;
        case 'add':
            addCommand($arguments);
            break;
        case 'complete':
            completeCommand($arguments);
            break;
        default:
            echo "Unknown command: $command\n";
            exit(1);
    }
    exit(0);
}


function completeCommand(array $arguments)/// X
{

}

function addCommand(array $arguments) //done
{
    $title = array_shift($arguments);

    $todo = [
        'id' => uniqid(),
        'title' => $title,
        'complete'  => false,
    ];

    $fileName = date('Y-m-d') . '.txt';
    $filePath = __DIR__ . '/data/' . $fileName;

    if (file_exists($filePath))
    {
        $content = file_get_contents($filePath);
        $todos = unserialize($content, [
        'allowed_classes' => false
        ]);
        $todos[] = $todo;
        file_put_contents($filePath, serialize($todos));
    }
    else
    {
        $todos = [ $todo ];
        file_put_contents( $filePath,serialize($todos));
    }
    file_put_contents($filePath, $title. "\n", FILE_APPEND);

}

function removeCommand(array $arguments) // X
{

}

function listCommand(array $arguments) //done
{
    $fileName = date('Y-m-d') . '.txt';
    $filePath = __DIR__ . '/data/' . $fileName;
    if (!file_exists($filePath))
    {
        echo "No todos found for today.\n";
        return;
    } 

    $content = file_get_contents($filePath);
        $todos = unserialize($content, [
        'allowed_classes' => false
        ]);
        
        if (empty($todos))
        {
            echo "No todos found.\n";
            return;
        }

        // $result = array_map(function($todo) {
        //     return $todo['title'];  
        // }, $todos);

        // echo implode("\n", $result);

        foreach ($todos as $index  => $todo)

        {
            echo sprintf("%s. [%s] %s \n",
            ($index+1),
            $todo['completed'] ? 'X': ' ', 
            $todo ['title']);
            //echo ($index +1) . " " .$todo['title'] . PHP_EOL;
        }

        // var_dump($todos);
}

main($argv);