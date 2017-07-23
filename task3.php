<?php

class fileServer
{
    const DIR_NAME = __DIR__.'/files';

    function head($filename)
    {
        $filePath = self::DIR_NAME . '/' . $filename;
        if(file_exists($filePath)){
            header('File-size: ' . filesize($filePath));
        }else{
            header("HTTP/1.0 404 Not Found");
        }
    }

    function get($filename)
    {
        $filePath = self::DIR_NAME . '/' . $filename;
        if(file_exists($filePath)){
            print_r(file_get_contents($filePath));
        }else{
            header("HTTP/1.0 404 Not Found");
        }
    }

    function delete($filename)
    {
        $filePath = self::DIR_NAME . '/' . $filename;
        if(file_exists($filePath)){
            unlink($filePath);
        }else{
            header("HTTP/1.0 404 Not Found");
        }
    }

    function post($filename)
    {
        $filePath = self::DIR_NAME . '/' . $filename;
        file_put_contents($filePath, file_get_contents('php://input'));
    }

    function patch($filename)
    {
        $filePath = self::DIR_NAME . '/' . $filename;
        file_put_contents($filePath, file_get_contents('php://input'), FILE_APPEND);
    }

    function handler()
    {
        if(empty($_GET['filename'])){
            header("HTTP/1.0 400 Bad request");
        }else {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    self::get($_GET['filename']);
                    break;
                case 'POST':
                    self::post($_GET['filename']);
                    break;
                case 'HEAD':
                    self::head($_GET['filename']);
                    break;
                case 'DELETE':
                    self::delete($_GET['filename']);
                    break;
                case 'PATCH':
                    self::patch($_GET['filename']);
                    break;
                default:
                    header("HTTP/1.0 400 Bad request");
                    break;
            }
        }        
    }
}

fileServer::handler();