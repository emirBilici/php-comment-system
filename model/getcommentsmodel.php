<?php

use JetBrains\PhpStorm\NoReturn;

require __DIR__ . './postmodel.php';

class GetCommentsModel extends PostModel
{

    /**
     * @param int $id
     * @return bool|array
     */
    #[NoReturn] public function Get(int $id): bool|array
    {
        $comments = $this->getPostComments($id);
        $isEmpty = count($comments) === 0 ?? false;

        if ($isEmpty) { // empty..
            $errMsg = [
                'error' => 1,
                'message' => 'No comments..'
            ];
            $this->JsonOutput((object) $errMsg, 404);

            exit();
        }

        $this->JsonOutput((object) $comments);
        exit();
    }

    /**
     * @param object $data
     * @param int $status_code
     * @return void
     */
    private function JsonOutput(object $data, int $status_code = 200)
    {
        http_response_code($status_code);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

}