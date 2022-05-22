<?php

class Comment extends Controller
{

    /**
     * @return bool
     */
    public function create(): bool
    {
        $data = $this->getContent();

        if ($data->create) {

            $comment = $data->comment;
            $model = $this->model('commentModel');
            $createComment = $model->Create($comment);

            if ($createComment) {
                echo 'Created..';
            } else {
                echo 'error!';
            }

        }

        return false;
    }

    public function delete(int $id)
    {
        $model = $this->model('commentModel');
        $getComment = $model->getComment($id);

        if (!$getComment) {
            $err = [
                'error' => 1,
                'message' => 'No comment..'
            ];

            $this->JsonOutput((object) $err);
            exit();
        }

        $errMsg = [
            'error' => 1,
            'message' => 'An error occurred..'
        ];

        $scsMsg = [
            'success' => 1,
            'message' => 'Comment deleted successfully!'
        ];

        $delete = $model->Delete($id);

        if ($delete)
            return $this->JsonOutput((object) $scsMsg);
        return $this->JsonOutput((object) $errMsg);
    }

    public function get()
    {
        $data = $this->getContent();
        $postId = $data->postId ?? false;

        if (!$postId) {
            http_response_code(502);

            $err = [
                'error' => 1,
                'message' => 'PostID is required!'
            ];
            $this->JsonOutput((object) $err);

            return exit();
        }

        $model = $this->model('getCommentsModel');
        return $model->Get($postId);
    }

    public function getComments()
    {
        $this->view('post/comment');
    }

    public function newComment()
    {
        $data = $this->getContent();

        if ($data->newComment) {

            $commentData = htmlspecialchars(trim($data->data));

            if (strlen($commentData) === 0) {
                $this->JsonOutput((object) [
                    'error' => 1,
                    'message' => 'Comment data is empty!'
                ]);

                exit();
            }

            $model = $this->model('commentModel');
            $createComment = $model->Create((object) [
                'content' => $commentData,
                'userID' => 5,
                'postID' => 20
            ]);

            if ($createComment)
                return $this->JsonOutput((object) [
                    'success' => 1,
                    'message' => 'Comment created successfully!'
                ]);
            return false;
        }

        return false;
    }

}